<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Category;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TransactionService
{
    public function createTransaction(array $data): Transaction
    {
        return DB::transaction(function () use ($data) {
            $this->validateTransactionData($data);

            $transaction = Transaction::create($data);
            $this->applyFinancialEffects($transaction);
            return $transaction;
        });
    }

    public function updateTransaction(Transaction $transaction, array $newData): Transaction
    {
        return DB::transaction(function () use ($transaction, $newData) {

            $this->revertFinancialEffects($transaction);
            $transaction->update($newData);
            $transaction->refresh();
            $this->applyFinancialEffects($transaction);
            return $transaction;
        });
    }

    public function deleteTransaction(Transaction $transaction): bool
    {
        return DB::transaction(function () use ($transaction) {
            $this->revertFinancialEffects($transaction);
            return $transaction->delete();
        });
    }

    private function validateTransactionData(array $data): void
    {

        $wallet = Wallet::find($data['wallet_id']);

        if (isset($data['category_id']) && $data['category_id']) {
            $category = Category::find($data['category_id']);

            if ($category->type !== $data['type']) {
                throw ValidationException::withMessages([
                    'category_id' => "Category type ({$category->type}) does not match transaction type ({$data['type']})"
                ]);
            }
        }

        if ($data['type'] === 'transfer') {
            $this->validateTransferTransaction($data, $wallet);
        }

        if (in_array($data['type'], ['expense', 'transfer'])) {
            $this->validateSufficientBalance($data, $wallet);
        }

        $this->validateCurrencyConsistency($data, $wallet);

        if (isset($data['transaction_date'])) {
            $transactionDate = Carbon::parse($data['transaction_date']);
            $futureLimit = now();

            if ($transactionDate->gt($futureLimit)) {
                throw ValidationException::withMessages([
                    'transaction_date' => 'Transaction date cannot be in the future'
                ]);
            }
        }
    }

    private function validateTransferTransaction(array $data, Wallet $sourceWallet): void
    {

        $destinationWallet = Wallet::find($data['destination_id']);

        if ($data['wallet_id'] === $data['destination_id']) {
            throw ValidationException::withMessages([
                'destination_id' => 'Cannot transfer to the same wallet'
            ]);
        }

        if ($destinationWallet->user_id !== $data['user_id']) {
            throw ValidationException::withMessages([
                'destination_id' => 'You do not have permission to transfer to this wallet'
            ]);
        }

        if (isset($data['transfer_fee']) && $data['transfer_fee'] < 0) {
            throw ValidationException::withMessages([
                'transfer_fee' => 'Transfer fee cannot be negative'
            ]);
        }

    }

    private function validateSufficientBalance(array $data, Wallet $wallet): void
    {
        $requiredAmount = $data['amount'];

        if ($data['type'] === 'transfer' && isset($data['transfer_fee'])) {
            $requiredAmount += $data['transfer_fee'];
        }

        if ($wallet->balance < $requiredAmount) {
            $shortfall = $requiredAmount - $wallet->balance;
            throw ValidationException::withMessages([
                'amount' => "Insufficient balance. Wallet balance: {$wallet->balance}, Required: {$requiredAmount}, Shortfall: {$shortfall}"
            ]);
        }
    }

    private function validateCurrencyConsistency(array $data, Wallet $wallet): void
    {

        if ($data['type'] === 'transfer' && isset($data['destination_id'])) {
            $destinationWallet = Wallet::find($data['destination_id']);

            if ($destinationWallet && $wallet->currency !== $destinationWallet->currency) {
                throw ValidationException::withMessages([
                    'destination_id' => "Currency mismatch: Source wallet ({$wallet->currency}) and destination wallet ({$destinationWallet->currency}) have different currencies"
                ]);
            }
        }
    }

    private function applyFinancialEffects($transaction): void
    {
        switch ($transaction->type) {
            case 'expense':
                $wallet = Wallet::lockForUpdate()->find($transaction->wallet_id);

                if ($wallet->balance < $transaction->amount) {
                    throw ValidationException::withMessages([
                        'amount' => 'Insufficient balance at time of transaction execution'
                    ]);
                }

                $wallet->balance -= $transaction->amount;
                $wallet->save();
                break;

            case 'income':
                $wallet = Wallet::lockForUpdate()->find($transaction->wallet_id);


                $newBalance = $wallet->balance + $transaction->amount;
                if ($newBalance > PHP_INT_MAX) {
                    throw ValidationException::withMessages([
                        'amount' => 'Transaction would cause wallet balance overflow'
                    ]);
                }

                $wallet->balance += $transaction->amount;
                $wallet->save();
                break;

            case 'transfer':

                $sourceWallet = Wallet::lockForUpdate()->find($transaction->wallet_id);
                $destinationWallet = Wallet::lockForUpdate()->find($transaction->destination_id);

                if (!$destinationWallet) {
                    throw ValidationException::withMessages([
                        'destination_id' => 'Destination wallet not found during transaction execution'
                    ]);
                }

                $totalDeduction = $transaction->amount + ($transaction->transfer_fee ?? 0);

               if ($sourceWallet->balance < $totalDeduction) {
                    throw ValidationException::withMessages([
                        'amount' => 'Insufficient balance at time of transfer execution'
                    ]);
                }

                $newDestinationBalance = $destinationWallet->balance + $transaction->amount;
                if ($newDestinationBalance > PHP_INT_MAX) {
                    throw ValidationException::withMessages([
                        'amount' => 'Transfer would cause destination wallet balance overflow'
                    ]);
                }

                $sourceWallet->balance -= $totalDeduction;
                $destinationWallet->balance += $transaction->amount;

                $sourceWallet->save();
                $destinationWallet->save();
                break;
        }

        $this->updateAccountBalances($transaction);
    }

    private function revertFinancialEffects(Transaction $transaction): void
    {
        switch ($transaction->type) {
            case 'expense':
                $wallet = Wallet::lockForUpdate()->find($transaction->wallet_id);
                if ($wallet) {
                    $wallet->balance += $transaction->amount;
                    $wallet->save();
                }
                break;

            case 'income':
                $wallet = Wallet::lockForUpdate()->find($transaction->wallet_id);
                if ($wallet) {

                    if ($wallet->balance < $transaction->amount) {
                        throw ValidationException::withMessages([
                            'revert' => 'Cannot revert transaction: would result in negative wallet balance'
                        ]);
                    }
                    $wallet->balance -= $transaction->amount;
                    $wallet->save();
                }
                break;

            case 'transfer':
                $sourceWallet = Wallet::lockForUpdate()->find($transaction->wallet_id);
                $destinationWallet = Wallet::lockForUpdate()->find($transaction->destination_id);

                if ($sourceWallet && $destinationWallet) {
                    $totalDeduction = $transaction->amount + ($transaction->transfer_fee ?? 0);

                    if ($destinationWallet->balance < $transaction->amount) {
                        throw ValidationException::withMessages([
                            'revert' => 'Cannot revert transfer: destination wallet has insufficient balance'
                        ]);
                    }

                    $sourceWallet->balance += $totalDeduction;
                    $destinationWallet->balance -= $transaction->amount;

                    $sourceWallet->save();
                    $destinationWallet->save();
                }
                break;
        }

        $this->updateAccountBalances($transaction);
    }

    private function updateAccountBalances(Transaction $transaction): void
    {

        $sourceWallet = Wallet::find($transaction->wallet_id);
        if ($sourceWallet && $sourceWallet->account) {
            $accountBalance = Wallet::where('account_id', $sourceWallet->account_id)->sum('balance');
            $sourceWallet->account->update(['balance' => $accountBalance]);
        }


        if ($transaction->type === 'transfer' && $transaction->destination_id) {
            $destinationWallet = Wallet::find($transaction->destination_id);
            if ($destinationWallet && $destinationWallet->account &&
                $destinationWallet->account_id !== $sourceWallet->account_id) {
                $accountBalance = Wallet::where('account_id', $destinationWallet->account_id)->sum('balance');
                $destinationWallet->account->update(['balance' => $accountBalance]);
            }
        }
    }




}

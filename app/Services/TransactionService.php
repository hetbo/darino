<?php

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class TransactionService {

    public function createTransaction(array $data): Transaction
    {
        return DB::transaction(function () use ($data) {
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

    public function findTransactionById(User $user, int $id): ?Transaction
    {
        return $user->transactions()->find($id);
    }

    public function getTransactions(User $user, array $filters = [])
    {
        $query = $user->transactions()->latest();

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        if (isset($filters['wallet_id'])) {
            $query->where('wallet_id', $filters['wallet_id']);
        }

        return $query->paginate(20);
    }

    private function applyFinancialEffects($transaction)
    {
        switch ($transaction->type) {
            case 'expense':
                $wallet = Wallet::find($transaction->wallet_id);
                $wallet->balance -= $transaction->amount;
                $wallet->save();
                // Later: Invalidate account balance cache for $wallet->account_id
                break;
            case 'income':
                $wallet = Wallet::find($transaction->wallet_id);
                $wallet->balance += $transaction->amount;
                $wallet->save();
                // Later: Invalidate account balance cache
                break;
            case 'transfer':
                $sourceWallet = Wallet::find($transaction->wallet_id);
                $destinationWallet = Wallet::find($transaction->destination_id);

                $sourceWallet->balance -= ($transaction->amount + ($transaction->transfer_fee ?? 0));
                $destinationWallet->balance += $transaction->amount;

                $sourceWallet->save();
                $destinationWallet->save();
                // Later: Invalidate caches for both accounts
                break;
        }
    }

    private function revertFinancialEffects(Transaction $transaction)
    {
        switch ($transaction->type) {
            case 'expense':
                $wallet = Wallet::find($transaction->wallet_id);
                $wallet->balance += $transaction->amount;
                $wallet->save();
                break;
            case 'income':
                $wallet = Wallet::find($transaction->wallet_id);
                $wallet->balance -= $transaction->amount;
                $wallet->save();
                break;
            case 'transfer':
                $sourceWallet = Wallet::find($transaction->wallet_id);
                $destinationWallet = Wallet::find($transaction->destination_id);

                $sourceWallet->balance += ($transaction->amount + ($transaction->transfer_fee ?? 0));
                $destinationWallet->balance -= $transaction->amount;

                $sourceWallet->save();
                $destinationWallet->save();
                break;
        }
    }
}

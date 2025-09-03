<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;
use App\Models\Category;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class NewSeeder extends Seeder
{
    public function run()
    {
        // Drop all data except users
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Transaction::truncate();
        Wallet::truncate();
        Category::truncate();
        Account::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Use existing users
        $allUsers = User::all();

        foreach ($allUsers as $user) {
            // Create 1-4 accounts per user
            $accountCount = rand(1, 4);
            $accounts = Account::factory($accountCount)->create(['user_id' => $user->id]);

            foreach ($accounts as $account) {
                // Create 4-7 categories for each type (income, expense, transfer)
                $types = ['income', 'expense', 'transfer'];
                foreach ($types as $type) {
                    $categoryCount = rand(4, 7);
                    Category::factory($categoryCount)->create([
                        'user_id' => $user->id,
                        'account_id' => $account->id,
                        'type' => $type,
                    ]);
                }

                // Create 2-5 wallets per account
                $walletCount = rand(2, 5);
                $wallets = Wallet::factory($walletCount)->create([
                    'user_id' => $user->id,
                    'account_id' => $account->id,
                    'initial_balance' => rand(100, 1000) * 10000, // 1M to 10M
                ]);

                // Set wallet balances to initial_balance
                foreach ($wallets as $wallet) {
                    $wallet->balance = $wallet->initial_balance;
                    $wallet->save();
                }

                foreach ($wallets as $wallet) {
                    // Create 5-15 transactions per wallet
                    $transactionCount = rand(5, 15);

                    // Get categories for this account
                    $incomeCategories = Category::where('account_id', $account->id)->where('type', 'income')->pluck('id');
                    $expenseCategories = Category::where('account_id', $account->id)->where('type', 'expense')->pluck('id');
                    $transferCategories = Category::where('account_id', $account->id)->where('type', 'transfer')->pluck('id');

                    // Get all wallets in this account for transfers
                    $accountWallets = Wallet::where('account_id', $account->id)->where('id', '!=', $wallet->id)->pluck('id');

                    for ($i = 0; $i < $transactionCount; $i++) {
                        $transactionType = ['income', 'expense', 'transfer'][rand(0, 2)];

                        $transactionData = [
                            'user_id' => $user->id,
                            'type' => $transactionType,
                            'wallet_id' => $wallet->id,
                            'transaction_date' => now()->subDays(rand(0, 365)),
                        ];

                        switch ($transactionType) {
                            case 'income':
                                $amount = rand(10, 500) * 10000; // 100K to 5M
                                $transactionData['amount'] = $amount;
                                $transactionData['category_id'] = $incomeCategories->random();
                                $wallet->balance += $amount;
                                break;

                            case 'expense':
                                $maxExpense = floor($wallet->balance / 10000) * 10000;
                                if ($maxExpense >= 10000) {
                                    $amount = rand(1, min(50, $maxExpense / 10000)) * 10000;
                                    $transactionData['amount'] = $amount;
                                    $transactionData['category_id'] = $expenseCategories->random();
                                    $wallet->balance -= $amount;
                                } else {
                                    // Skip this transaction if wallet can't afford minimum expense
                                    continue 2;
                                }
                                break;

                            case 'transfer':
                                if ($accountWallets->isNotEmpty()) {
                                    $transferFee = rand(1, 10) * 1000; // 1K to 10K
                                    $maxTransfer = floor(($wallet->balance - $transferFee) / 10000) * 10000;

                                    if ($maxTransfer >= 10000) {
                                        $amount = rand(1, min(100, $maxTransfer / 10000)) * 10000;
                                        $transactionData['amount'] = $amount;
                                        $transactionData['category_id'] = $transferCategories->random();
                                        $transactionData['destination_id'] = $accountWallets->random();
                                        $transactionData['transfer_fee'] = $transferFee;

                                        // Subtract from source wallet (including fee)
                                        $wallet->balance -= ($amount + $transferFee);

                                        // Add to destination wallet
                                        $destinationWallet = Wallet::find($transactionData['destination_id']);
                                        $destinationWallet->balance += $amount;
                                        $destinationWallet->save();
                                    } else {
                                        // Skip this transaction if wallet can't afford minimum transfer + fee
                                        continue 2;
                                    }
                                } else {
                                    // Skip transfer if no other wallets available
                                    continue 2;
                                }
                                break;
                        }

                        Transaction::factory()->create($transactionData);
                    }

                    $wallet->save();
                }

                // Calculate and update account balance
                $accountBalance = 0;
                $accountWallets = Wallet::where('account_id', $account->id)->get();

                foreach ($accountWallets as $wallet) {
                    if (!$wallet->exclude) {
                        // Convert to account currency if different
                        $walletBalance = $wallet->balance;
                        if ($wallet->currency === 'IRR' && $account->currency === 'IRT') {
                            $walletBalance = $walletBalance / 10;
                        } elseif ($wallet->currency === 'IRT' && $account->currency === 'IRR') {
                            $walletBalance = $walletBalance * 10;
                        }
                        $accountBalance += $walletBalance;
                    }
                }

                $account->balance = $accountBalance;
                $account->save();
            }
        }
    }
}

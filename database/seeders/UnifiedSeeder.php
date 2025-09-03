<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;
use App\Models\Category;
use App\Models\Wallet;
use App\Models\Transaction;

class UnifiedSeeder extends Seeder
{
    public function run()
    {
        // Create 4 users (1 admin, 3 users)
        $admin = User::factory()->create([
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        $users = User::factory(3)->create([
            'role' => 'user',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        $allUsers = collect([$admin])->merge($users);

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
                $wallets = Wallet::factory($walletCount)->create(['user_id' => $user->id, 'account_id' => $account->id]);

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

                        // Make amount divisible by 10000
                        $baseAmount = rand(1, 500) * 10000;

                        $transactionData = [
                            'user_id' => $user->id,
                            'type' => $transactionType,
                            'amount' => $baseAmount,
                            'wallet_id' => $wallet->id,
                            'transaction_date' => now()->subDays(rand(0, 365)),
                        ];

                        switch ($transactionType) {
                            case 'income':
                                $transactionData['category_id'] = $incomeCategories->random();
                                $wallet->balance += $baseAmount;
                                break;

                            case 'expense':
                                $transactionData['category_id'] = $expenseCategories->random();
                                $wallet->balance -= $baseAmount;
                                break;

                            case 'transfer':
                                if ($accountWallets->isNotEmpty()) {
                                    $transactionData['category_id'] = $transferCategories->random();
                                    $transactionData['destination_id'] = $accountWallets->random();
                                    $transactionData['transfer_fee'] = rand(0, 10) * 1000; // Fee divisible by 1000

                                    // Subtract from source wallet (including fee)
                                    $wallet->balance -= ($baseAmount + $transactionData['transfer_fee']);

                                    // Add to destination wallet
                                    $destinationWallet = Wallet::find($transactionData['destination_id']);
                                    $destinationWallet->balance += $baseAmount;
                                    $destinationWallet->save();
                                } else {
                                    // If no other wallets available, make it an expense instead
                                    $transactionType = 'expense';
                                    $transactionData['type'] = 'expense';
                                    $transactionData['category_id'] = $expenseCategories->random();
                                    $wallet->balance -= $baseAmount;
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

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use App\Models\Wallet;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            $admin = User::factory()->admin()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);

            $users = User::factory()->count(3)->create();
            $allUsers = collect([$admin])->concat($users);

            foreach ($allUsers as $user) {
                $this->command->info("Creating data for user: {$user->name}");

                $accountCount = rand(0, 3);

                if ($accountCount === 0) {
                    $this->command->info("  No accounts created for {$user->name}");
                    continue;
                }

                for ($a = 0; $a < $accountCount; $a++) {
                    $account = Account::factory()->create([
                        'user_id' => $user->id,
                    ]);

                    $this->command->info("  Created account: {$account->name}");

                    $walletCount = rand(0, 6);
                    $wallets = [];

                    for ($w = 0; $w < $walletCount; $w++) {
                        $wallet = Wallet::factory()->create([
                            'user_id' => $user->id,
                        ]);
                        $wallets[] = $wallet;
                        $this->command->info("    Created wallet: {$wallet->name}");
                    }

                    if (empty($wallets)) {
                        $this->command->info("    No wallets created for account: {$account->name}");
                        continue;
                    }


                    $categories = [
                        'income' => [],
                        'expense' => [],
                        'transfer' => []
                    ];

                    foreach (['income', 'expense', 'transfer'] as $type) {
                        $categoryCount = rand(3, 7);

                        for ($c = 0; $c < $categoryCount; $c++) {
                            $category = Category::factory()->create([
                                'user_id' => $user->id,
                                'account_id' => $account->id,
                                'type' => $type,
                            ]);
                            $categories[$type][] = $category;
                        }

                        $this->command->info("    Created {$categoryCount} {$type} categories");
                    }

                    foreach ($categories as $type => $typeCategories) {
                        foreach ($typeCategories as $category) {
                            $transactionCount = rand(5, 10);

                            for ($t = 0; $t < $transactionCount; $t++) {
                                $sourceWallet = $wallets[array_rand($wallets)];

                                $transactionData = [
                                    'user_id' => $user->id,
                                    'type' => $type,
                                    'category_id' => $category->id,
                                    'wallet_id' => $sourceWallet->id,
                                ];


                                if ($type === 'transfer' && count($wallets) > 1) {

                                    $destinationWallets = array_filter($wallets, function($w) use ($sourceWallet) {
                                        return $w->id !== $sourceWallet->id;
                                    });

                                    if (!empty($destinationWallets)) {
                                        $destinationWallet = $destinationWallets[array_rand($destinationWallets)];
                                        $transactionData['destination_id'] = $destinationWallet->id;
                                    }
                                }

                                $transaction = Transaction::factory()
                                    ->{$type}()
                                    ->create($transactionData);


                                $this->updateWalletBalances($transaction);
                            }

                            $this->command->info("      Created {$transactionCount} transactions for {$category->name}");
                        }
                    }


                    $totalAccountBalance = collect($wallets)->sum('balance');
                    $account->update(['balance' => $totalAccountBalance]);
                }
            }

            DB::commit();
            $this->command->info('Database seeded successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            $this->command->error('Error seeding database: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update wallet balances based on transaction type
     */
    private function updateWalletBalances(Transaction $transaction): void
    {
        $sourceWallet = Wallet::find($transaction->wallet_id);

        switch ($transaction->type) {
            case 'income':

                $sourceWallet->increment('balance', $transaction->amount);
                break;

            case 'expense':

                $sourceWallet->decrement('balance', $transaction->amount);
                break;

            case 'transfer':
                if ($transaction->destination_id) {
                    $destinationWallet = Wallet::find($transaction->destination_id);

                    $totalDeduction = $transaction->amount + ($transaction->transfer_fee ?? 0);
                    $sourceWallet->decrement('balance', $totalDeduction);

                    $destinationWallet->increment('balance', $transaction->amount);
                }
                break;
        }
    }
}

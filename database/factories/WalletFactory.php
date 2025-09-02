<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $walletTypes = [
            'Cash Wallet',
            'Digital Wallet',
            'Credit Card',
            'Debit Card',
            'Investment Wallet',
            'Savings Wallet',
            'Emergency Fund',
            'Travel Fund',
        ];

        $colors = [
            'red', 'orange', 'amber', 'yellow', 'lime',
            'green', 'emerald', 'teal', 'cyan', 'sky',
            'blue', 'indigo', 'violet', 'purple', 'fuchsia',
            'pink', 'rose', 'slate', 'gray', 'zinc',
            'neutral', 'stone'
        ];

        $icons = [
            'wallet', 'credit-card', 'banknote', 'coins', 'piggy-bank',
            'safe', 'vault', 'money-bill', 'dollar-sign', 'euro-sign',
            'pound-sign', 'yen-sign', 'bitcoin', 'ethereum', 'paypal'
        ];

        $initialBalance = fake()->numberBetween(0, 1000000);

        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement($walletTypes) . ' - ' . fake()->word(),
            'currency' => fake()->randomElement(['IRT', 'IRR']),
            'initial_balance' => $initialBalance,
            'balance' => $initialBalance,
            'color' => fake()->randomElement($colors),
            'icon' => fake()->randomElement($icons),
            'exclude' => fake()->boolean(20),
        ];
    }
}

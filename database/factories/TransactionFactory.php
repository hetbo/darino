<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $incomeDescriptions = [
            'Monthly salary payment',
            'Freelance project payment',
            'Bonus received',
            'Investment dividend',
            'Rental income',
            'Side job payment',
            'Commission earned',
            'Gift money received',
            'Interest payment',
            'Business profit'
        ];

        $expenseDescriptions = [
            'Grocery shopping',
            'Restaurant dinner',
            'Gas station fill-up',
            'Online shopping',
            'Movie tickets',
            'Coffee shop visit',
            'Utility bill payment',
            'Phone bill payment',
            'Insurance premium',
            'Medical appointment',
            'Gym membership',
            'Book purchase',
            'Clothing purchase',
            'Home repair'
        ];

        $transferDescriptions = [
            'Transfer between wallets',
            'Moving funds to savings',
            'Account rebalancing',
            'Internal fund transfer',
            'Wallet consolidation'
        ];

        $type = fake()->randomElement(['income', 'expense', 'transfer']);

        $description = match($type) {
            'income' => fake()->randomElement($incomeDescriptions),
            'expense' => fake()->randomElement($expenseDescriptions),
            'transfer' => fake()->randomElement($transferDescriptions),
        };

        $amount = match($type) {
            'income' => fake()->numberBetween(50000, 2000000),
            'expense' => fake()->numberBetween(10000, 500000),
            'transfer' => fake()->numberBetween(100000, 1000000),
        };

        $notes = fake()->optional(0.3)->sentence();

        return [
            'user_id' => User::factory(),
            'type' => $type,
            'amount' => $amount,
            'description' => $description,
            'notes' => $notes,
            'transaction_date' => fake()->dateTimeBetween('-6 months'),
            'category_id' => Category::factory(),
            'wallet_id' => Wallet::factory(),
            'destination_id' => null,
            'transfer_fee' => null,
        ];
    }

    public function income(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'income',
            'amount' => fake()->numberBetween(50000, 2000000),
        ]);
    }

    public function expense(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'expense',
            'amount' => fake()->numberBetween(10000, 500000),
        ]);
    }

    public function transfer(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'transfer',
            'amount' => fake()->numberBetween(100000, 1000000),
            'transfer_fee' => fake()->optional(0.3)->numberBetween(1000, 10000),
        ]);
    }
}

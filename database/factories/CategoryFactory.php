<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $incomeCategories = [
            'Salary', 'Freelance Work', 'Business Income', 'Investment Returns',
            'Rental Income', 'Side Hustle', 'Bonus', 'Commission', 'Dividends',
            'Interest Income', 'Royalties', 'Gifts Received'
        ];

        $expenseCategories = [
            'Food & Dining', 'Transportation', 'Shopping', 'Entertainment',
            'Bills & Utilities', 'Healthcare', 'Education', 'Travel',
            'Insurance', 'Groceries', 'Gas & Fuel', 'Internet',
            'Phone Bill', 'Rent', 'Mortgage', 'Clothing', 'Books',
            'Gym Membership', 'Subscriptions', 'Personal Care'
        ];

        $transferCategories = [
            'Account Transfer', 'Wallet Transfer', 'Internal Transfer',
            'Between Accounts', 'Balance Transfer', 'Fund Movement'
        ];

        $colors = [
            'red', 'orange', 'amber', 'yellow', 'lime',
            'green', 'emerald', 'teal', 'cyan', 'sky',
            'blue', 'indigo', 'violet', 'purple', 'fuchsia',
            'pink', 'rose', 'slate', 'gray', 'zinc',
            'neutral', 'stone'
        ];

        $incomeIcons = [
            'dollar-sign', 'trending-up', 'briefcase', 'award', 'gift',
            'credit-card', 'banknote', 'coins', 'piggy-bank'
        ];

        $expenseIcons = [
            'shopping-cart', 'utensils', 'car', 'home', 'heart',
            'book', 'plane', 'phone', 'wifi', 'zap', 'shield',
            'graduation-cap', 'coffee', 'shirt', 'fuel'
        ];

        $transferIcons = [
            'arrow-right', 'exchange', 'shuffle', 'repeat', 'move'
        ];

        $type = fake()->randomElement(['income', 'expense', 'transfer']);

        $categoryName = match($type) {
            'income' => fake()->randomElement($incomeCategories),
            'expense' => fake()->randomElement($expenseCategories),
            'transfer' => fake()->randomElement($transferCategories),
        };

        $icon = match($type) {
            'income' => fake()->randomElement($incomeIcons),
            'expense' => fake()->randomElement($expenseIcons),
            'transfer' => fake()->randomElement($transferIcons),
        };

        return [
            'user_id' => User::factory(),
            'account_id' => Account::factory(),
            'name' => $categoryName,
            'type' => $type,
            'color' => fake()->randomElement($colors),
            'icon' => $icon,
        ];
    }

    public function income(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'income',
        ]);
    }

    public function expense(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'expense',
        ]);
    }

    public function transfer(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'transfer',
        ]);
    }
}

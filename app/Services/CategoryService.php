<?php

namespace App\Services;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Collection;

class CategoryService {

    public function createCategory(User $user, array $data): Category
    {
        return $user->categories()->create([
            'name' => $data['name'],
            'type' => $data['type'],
            'color' => $data['color'],
            'icon' => $data['icon'],
        ]);
    }

    public function getUserCategories(User $user, ?string $type = null): Collection
    {
        $query = $user->categories();

        if ($type) {
            $query->where('type', $type);
        }

        return $query->orderBy('name')->get();

    }

    public function getCategory(int $categoryId): ?Category
    {
        return Category::find($categoryId);
    }

    public function updateCategory(Category $category, array $data): Category
    {
        $category->update([
            'name' => $data['name'],
            'color' => $data['color'],
            'icon' => $data['icon'],
        ]);

        return $category->fresh();
    }

    public function deleteCategory(Category $category): bool {
        return $category->delete();
    }

    public function getCategoryByType(User $user, string $type): Collection
    {
        return $user->categories()->where('type', $type)->orderBy('name')->get();
    }

    public function getAvailableColors(): array
    {
        return [
            'red',
            'orange',
            'amber',
            'yellow',
            'lime',
            'green',
            'emerald',
            'teal',
            'cyan',
            'sky',
            'blue',
            'indigo',
            'violet',
            'purple',
            'fuchsia',
            'pink',
            'rose',
            'slate',
            'gray',
            'zinc',
            'neutral',
            'stone',
        ];
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct(private CategoryService $categoryService) {}

    public function index(Request $request): JsonResponse
    {
        $type = $request->query('type');
        $categories = $this->categoryService->getUserCategories($request->user(), $type);
        return response()->json([
            'data' => $categories,
        ]);
    }

    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->createCategory(
            $request->user(),
            $request->validated()
        );

        return response()->json([
            'data' => $category,
            'message' => 'Category created successfully',
        ], 201);
    }

    public function show(Request $request, Category $category): JsonResponse
    {
        if ($category->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Category Not Found',
            ], 404);
        }

        return response()->json([
            'data' => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse {
        if ($category->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Category Not Found',
            ], 404);
        }

        $updatedCategory = $this->categoryService->updateCategory($category, $request->validated());

        return response()->json([
            'data' => $updatedCategory,
            'message' => 'Category updated successfully',
        ]);
    }

    public function destroy(Request $request, Category $category): JsonResponse {
        if ($category->user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'Category Not Found',
            ], 404);
        }

        $this->categoryService->deleteCategory($category);

        return response()->json([
            'message' => 'Category deleted successfully',
        ]);

    }

    public function getByType(Request $request, string $type): JsonResponse
    {
        if (!in_array($type, ['income', 'expense', 'transfer'])) {
            return response()->json([
                'message' => 'Invalid category type',
            ], 400);
        }

        $categories = $this->categoryService->getCategoryByType($request->user(), $type);

        return response()->json([
            'data' => $categories,
        ]);
    }

    public function getAvailableColors(): JsonResponse
    {
        $colors = $this->categoryService->getAvailableColors();

        return response()->json([
            'data' => $colors,
        ]);
    }

}

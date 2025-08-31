<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {

        $availableColors = [
            'red', 'orange', 'amber', 'yellow', 'lime',
            'green', 'emerald', 'teal', 'cyan', 'sky',
            'blue', 'indigo', 'violet', 'purple', 'fuchsia',
            'pink', 'rose', 'slate', 'gray', 'zinc',
            'neutral', 'stone'
        ];

        return [
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense,transfer',
            'color' => 'required|in:' . implode(',', $availableColors),
            'icon' => 'required|string|max:50',
        ];
    }

    public function messages(): array {
        return [
            'color.in' => 'The color must be a valid Tailwind CSS color (e.g., red-500, blue-500).',
            'type.in' => 'The type must be one of: income, expense, transfer.',
        ];
    }
}

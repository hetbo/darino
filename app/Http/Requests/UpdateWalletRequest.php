<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWalletRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'color' => 'sometimes|required|string|max:10',
            'icon' => 'sometimes|required|string|max:20',
            'exclude' => 'sometimes|boolean'
        ];

    }

    public function prepareForValidation(): void
    {
        if ($this->has('exclude')) {
            $this->merge(['exclude' => $this->boolean('exclude')]);
        }
    }
}

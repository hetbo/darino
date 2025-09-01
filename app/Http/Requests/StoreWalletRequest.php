<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWalletRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'currency' => 'required|in:IRT,IRR',
            'initial_balance' => 'sometimes|integer|min:0',
            'balance' => 'sometimes|integer|min:0',
            'color' => 'required|string|max:10',
            'icon' => 'required|string|max:20',
            'exclude' => 'sometimes|boolean'
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'exclude' => $this->boolean('exclude'),
            'initial_balance' => $this->input('initial_balance', 0),
        ]);

        if (!$this->has('balance')) {
            $this->merge(['balance' => $this->input('initial_balance', 0)]);
        }
    }
}

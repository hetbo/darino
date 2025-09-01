<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'type' => 'required|in:income,expense,transfer',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
            'wallet_id' => 'required|exists:wallets,id',
            'destination_id' => 'required_if:type,transfer|exists:wallets,id',
            'transfer_fee' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'transaction_date' => 'nullable|date',
        ];
    }

    public function prepareForValidation()
    {
        if (empty($this->transaction_date)) {
            $this->merge([
                'transaction_date' => now(),
            ]);
        }
    }

}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'type' => 'sometimes|in:income,expense,transfer',
            'amount' => 'sometimes|numeric|min:1',
            'description' => 'nullable|string|max:255',
            'wallet_id' => 'sometimes|exists:wallets,id',
            'destination_id' => 'required_if:type,transfer|exists:wallets,id',
            'transfer_fee' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'nullable|date',
        ];
    }
}

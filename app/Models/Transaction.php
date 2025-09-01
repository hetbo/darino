<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'description',
        'notes',
        'transaction_date',
        'category_id',
        'wallet_id',
        'destination_id',
        'transfer_fee',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'amount' => 'integer',
        'transfer_fee' => 'integer',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function destinationWallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'destination_id');
    }

    // Accessors
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount / 100, 2);
    }

    public function getFormattedTransferFeeAttribute(): string
    {
        return $this->transfer_fee ? number_format($this->transfer_fee / 100, 2) : '0.00';
    }

    public function getTotalAmountAttribute(): int
    {
        return $this->amount + ($this->transfer_fee ?? 0);
    }

    // Scopes
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeByWallet($query, int $walletId)
    {
        return $query->where('wallet_id', $walletId);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('transaction_date', [$startDate, $endDate]);
    }

    public function scopeByCategory($query, int $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }


}

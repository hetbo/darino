<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    /** @use HasFactory<\Database\Factories\WalletFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'currency',
        'initial_balance',
        'balance',
        'color',
        'icon',
        'exclude'
    ];

    protected $casts = [
        'initial_balance' => 'integer',
        'balance' => 'integer',
        'exclude' => 'boolean',
        'user_id' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function outgoingTransfers(): HasMany
    {
        return $this->hasMany(Transaction::class, 'wallet_id')->where('type', 'transfer');
    }

    public function incomingTransfers(): HasMany
    {
        return $this->hasMany(Transaction::class, 'destination_id')->where('type', 'transfer');
    }

    // Accessors
    public function getFormattedBalanceAttribute(): string
    {
        return number_format($this->balance / 100, 2);
    }

    // Helper methods
    public function getTotalExpenses(): int
    {
        return $this->transactions()->where('type', 'expense')->sum('amount');
    }

    public function getTotalIncome(): int
    {
        return $this->transactions()->where('type', 'income')->sum('amount');
    }

    public function getMonthlyTransactions($month = null, $year = null)
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        return $this->transactions()
            ->whereMonth('transaction_date', $month)
            ->whereYear('transaction_date', $year);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

}

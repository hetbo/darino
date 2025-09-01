<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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


}

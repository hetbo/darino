<?php

namespace App\Services;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class WalletService {

    public function create(User $user, array $data): Wallet
    {
        $data['user_id'] = $user->id;
        $data['balance'] = $data['initial_balance'];

        return Wallet::create($data);
    }

    public function update(Wallet $wallet, array $data): Wallet
    {
        $wallet->update($data);
        return $wallet->fresh();
    }

    public function delete(Wallet $wallet): bool
    {
        return $wallet->delete();
    }

    public function findById(int $walletId): ?Wallet
    {
        return Wallet::find($walletId);
    }

    public function adjustBalance(Wallet $wallet, int $amount, string $reason = 'Manual adjustment')
    {
        /** @todo use transactions to adjust balance **/
    }

    public function validateOwnership(User $user, Wallet $wallet): void
    {
        if ($wallet->user_id !== $user->id) {
            throw new InvalidArgumentException('Wallet not found');
        }
    }

    public function findByUser(User $user): Collection
    {
        $query = $user->wallets();

        return $query->orderBy('created_at', 'desc')->get();
    }
}

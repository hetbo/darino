<?php

namespace App\Services;

use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Collection;

class AccountService {

    public function createAccount(User $user, array $data) : Account
    {
        return $user->accounts()->create([
            'name' => $data['name'],
            'currency' => $data['currency'] ?? 'IRT',
            'balance' => 0
        ]);
    }

    public function getUserAccounts(User $user): Collection
    {
        return $user->accounts()->get();
    }

    public function getAccount(int $accountId): ?Account
    {
        return Account::find($accountId);
    }

    public function updateAccount(Account $account, array $data) : Account
    {
        $account->update([
            'name' => $data['name'],
        ]);

        return $account->fresh();
    }

    public function deleteAccount(Account $account) : bool {
        return $account->delete();
    }

    public function adjustBalance(Account $account, int $amount, string $description = '') : void
    {
        /** @todo make a transaction **/
    }

}

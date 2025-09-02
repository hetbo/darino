<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\User;

class AccountPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct(){}

    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }

    public function view(User $user, Account $account): bool {

        return $account->user_id === $user->id;

    }



}

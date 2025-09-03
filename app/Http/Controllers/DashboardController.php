<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller {


    public function dashboard()
    {
        $last_used_account = auth()->user()->profile->last_used_account;

        if ($last_used_account) {
            return redirect()->route('dashboard.account', $last_used_account);
        }
        $user = User::with('profile', 'accounts')->where('id', auth()->id())->first();
        return view('user.new-account', compact('user'));

    }

    public function index(Account $account)
    {
        $profile = auth()->user()->profile;
        $profile->last_used_account = $account->id;
        $profile->save();

        $user = User::with('profile', 'accounts')->where('id', auth()->id())->first();
        return view('user.dashboard', compact('user'));
    }

}

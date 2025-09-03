<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller {

    use AuthorizesRequests;


    /** @final check for last used account to redirect accordingly **/
    /** @route dashboard **/
    /** @API GET /dashboard **/
    public function dashboard()
    {
        $last_used_account = auth()->user()->profile->last_used_account;

        if ($last_used_account) {
            return redirect()->route('dashboard.account', $last_used_account);
        }
        $user = User::with('profile', 'accounts')->where('id', auth()->id())->first();
        return view('user.new-account', compact('user'));

    }

    /** @final opens dashboard/{account} and set the last_used_account for future returns **/
    /** @route dashboard.account **/
    /** @API GET /dashboard/{account} **/
    public function index(Account $account)
    {

        $this->authorize('view', $account);

        $profile = auth()->user()->profile;
        $profile->last_used_account = $account->id;
        $profile->save();

        $user = User::with('profile', 'accounts')->where('id', auth()->id())->first();
        return view('user.dashboard', compact('user'));
    }

    /** @final sets last_used_account to NULL and opens dashboard route [list of accounts + ability to create new account] **/
    /** @route create-new-account **/
    /** @API GET /new-account **/
    public function newAccount()
    {
        $profile = auth()->user()->profile;
        $profile->last_used_account = null;
        $profile->save();

        return redirect()->route('dashboard');

    }

    /** @route panel.wallets **/
    /** @API GET /dashboard/{account}/wallets **/
    public function viewWallets(Account $account)
    {
        $this->authorize('view', $account);

        $wallets = $account->wallets;

        return view('user.wallets', compact('wallets'));
    }

}

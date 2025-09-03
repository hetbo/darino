<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function __construct(private AccountService $accountService){}

    public function index(Request $request): JsonResponse
    {
        $accounts = $this->accountService->getUserAccounts($request->user());

        return response()->json([
            'data' => $accounts
        ]);
    }

    /** @final creates a new account and redirects to dashboard/{account} **/
    public function store(CreateAccountRequest $request)
    {

        $account = $this->accountService->createAccount($request->user(), $request->validated());

        return redirect()->route('dashboard.account', $account);

    }

    public function show(Request $request, Account $account): JsonResponse
    {
        if ($account->user_id != $request->user()->id) {
            return response()->json([
                'message' => 'Account not found'
            ], 404);
        }

        return response()->json([
            'data' => $account
        ]);
    }

    public function update(UpdateAccountRequest $request, Account $account): JsonResponse
    {
        if ($account->user_id != $request->user()->id) {
            return response()->json([
                'message' => 'Account not found'
            ], 404);
        }

        $updatedAccount = $this->accountService->updateAccount($account, $request->validated());

        return response()->json([
            'data' => $updatedAccount,
            'message' => 'Account updated successfully.'
        ]);

    }

    public function destroy(Request $request, Account $account): JsonResponse {
        if ($account->user_id != $request->user()->id) {
            return response()->json([
                'message' => 'Account not found'
            ], 404);
        }

        $this->accountService->deleteAccount($account);

        return response()->json([
            'message' => 'Account deleted successfully.'
        ]);
    }

}

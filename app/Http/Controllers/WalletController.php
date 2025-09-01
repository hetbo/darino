<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;

class WalletController extends Controller
{
    public function __construct(protected WalletService $walletService) {}

    public function index(Request $request): JsonResponse
    {
        $wallets = $this->walletService->findByUser($request->user());

        return response()->json([
            'data' => $wallets,
            'message' => 'Wallets retrieved successfully.'
        ]);
    }

    public function store(StoreWalletRequest $request): JsonResponse
    {
        $wallet = $this->walletService->create($request->user(), $request->validated());

        return response()->json([
            'data' => $wallet,
            'message' => 'Wallet created successfully.'
        ], 201);
    }

    public function show(Request $request, Wallet $wallet): JsonResponse
    {
        try {
            $this->walletService->validateOwnership($request->user(), $wallet);

            return response()->json([
                'data' => $wallet,
                'message' => 'Wallet retrieved successfully.'
            ]);
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'message' => 'Something went wrong while retrieving wallet.',
            ], 404);
        }
    }

    public function update(UpdateWalletRequest $request, Wallet $wallet): JsonResponse
    {
        try {
            $this->walletService->validateOwnership($request->user(), $wallet);

            $updatedWallet = $this->walletService->update($wallet, $request->validated());

            return response()->json([
                'data' => $updatedWallet,
                'message' => 'Wallet updated successfully.'
            ]);
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'message' => 'Something went wrong while updating wallet.',
            ], 404);
        }
    }

    public function destroy(Request $request, Wallet $wallet): JsonResponse
    {
        try {
            $this->walletService->validateOwnership($request->user(), $wallet);

            $this->walletService->delete($wallet);

            return response()->json([
                'message' => 'Wallet deleted successfully.'
            ]);
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'message' => 'Something went wrong while deleting wallet.',
            ], 404);
        }
    }

/*    public function adjustBalance(AdjustBalanceRequest $request, Wallet $wallet): JsonResponse
    {}*/



}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    protected TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of transactions for the authenticated user.
     */
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['type', 'wallet_id']);
        $transactions = $this->transactionService->getTransactions(auth()->user(), $filters);

        return response()->json($transactions);
    }

    /**
     * Store a newly created transaction.
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->id();

            $transaction = $this->transactionService->createTransaction($data);

            return response()->json([
                'message' => 'Transaction created successfully',
                'transaction' => $transaction
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create transaction',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified transaction.
     */
    public function show(int $id): JsonResponse
    {
        $transaction = $this->transactionService->findTransactionById(auth()->user(), $id);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json($transaction);
    }

    /**
     * Update the specified transaction.
     */
    public function update(UpdateTransactionRequest $request, int $id): JsonResponse
    {
        $transaction = $this->transactionService->findTransactionById(auth()->user(), $id);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $updatedTransaction = $this->transactionService->updateTransaction(
                $transaction,
                $request->validated()
            );

            return response()->json([
                'message' => 'Transaction updated successfully',
                'transaction' => $updatedTransaction
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update transaction',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy(int $id): JsonResponse
    {
        $transaction = $this->transactionService->findTransactionById(auth()->user(), $id);

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], Response::HTTP_NOT_FOUND);
        }

        try {
            $this->transactionService->deleteTransaction($transaction);

            return response()->json([
                'message' => 'Transaction deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete transaction',
                'error' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}

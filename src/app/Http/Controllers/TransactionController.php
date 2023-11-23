<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionsService;

class TransactionController extends Controller
{
    protected TransactionsService $transactionsService;

    public function __construct(TransactionsService $transactionsService)
    {
        $this->transactionsService = $transactionsService;
    }

    public function submitTransaction(Request $request)
    {
        $transaction = $this->transactionsService->handleTransaction($request->paymentMethod, $request->all());

        if ($transaction) {
            return view('transaction.success', ['transaction' => $transaction] );
        }
    }
}

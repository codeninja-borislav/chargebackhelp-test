<?php

namespace App\Services;

use App\Factories\TransactionFactory;
use App\Http\Controllers\CashMachine;

class TransactionsService
{
    private CashMachine $cashMachine;

    public function __construct(CashMachine $cashMachine)
    {
        $this->cashMachine = $cashMachine;
    }

    public function handleTransaction(string $paymentMethod, $request)
    {
        $transaction = TransactionFactory::make($paymentMethod, $request);
        $validationResult = $transaction->validate();

        if ($validationResult !== true) {
            $errorMessages = $validationResult->toArray();
            \Log::error('Transaction validation failed', $errorMessages);

            // TODO - custom InvalidTransactionException
            throw new \Exception('Validation failed '. $validationResult);
        }

        return $this->cashMachine->store($transaction);
    }
}

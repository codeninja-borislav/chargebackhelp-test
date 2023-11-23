<?php

namespace App\Factories;

use App\Contracts\Transaction;
use App\Transactions\CashTransaction;
use App\Transactions\CardTransaction;
use App\Transactions\BankTransaction;

class TransactionFactory
{
    public static function make($transaction, $request): Transaction
    {
        return match($transaction) {
            'cash' => New CashTransaction($request),
            'card' => New CardTransaction($request),
            'bank' => New BankTransaction($request),
            default => throw new \InvalidArgumentException('Please, provide a valid transaction type')
        };
    }
}

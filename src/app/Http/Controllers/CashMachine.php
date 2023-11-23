<?php

namespace App\Http\Controllers;

use App\Contracts\Transaction;
use App\Models\TransactionModel;
use Illuminate\Support\Facades\Validator;

class CashMachine extends Controller
{
    public function store(Transaction $transaction)
    {
        // Check if amount limit is exceeded
        $current_amount = collect(TransactionModel::all())->sum('amount');
        if($transaction->amount() + $current_amount < 20000) {
            // Store the transaction in the database
            $record = new TransactionModel();
            $record->amount = $transaction->amount();
            $record->inputs = $transaction->inputs();
            $record->type = $transaction->getType();
            $record->save();

            return $record;
        } else {
            return false;
        }
    }
}

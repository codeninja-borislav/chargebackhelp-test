<?php

namespace App\Transactions;

use App\Contracts\Transaction;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BankTransaction implements Transaction
{
    private $transferDate;
    private $customerName;
    private $accountNumber;
    private $amount;

    public function __construct($requestData)
    {
        $this->transferDate = $requestData['transferDate'];
        $this->customerName = $requestData['customerName'];
        $this->accountNumber = $requestData['accountNumber'];
        $this->amount = $requestData['amount'];
    }

    public function validate()
    {
        $validator = Validator::make([
            'transferDate' => $this->transferDate,
            'customerName' => $this->customerName,
            'accountNumber' => $this->accountNumber,
            'amount' => $this->amount
        ], [
            'transferDate' => 'required|date_format:Y-m-d|before_or_equal:today',
            'customerName' => 'required|string',
            'accountNumber' => 'required|alpha_num|size:6',
            'amount' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            // Handle validation failure
            return $validator->errors();
        }

        // Validation success
        return true;
    }

    public function amount()
    {
        return $this->amount;
    }

    public function inputs()
    {
        return json_encode([
            'transferDate' => $this->transferDate,
            'customerName' => $this->customerName,
            'accountNumber' => $this->accountNumber,
            'amount' => $this->amount
        ]);
    }

    public function getType()
    {
        return 'bank';
    }
}

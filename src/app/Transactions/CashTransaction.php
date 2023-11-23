<?php

namespace App\Transactions;

use App\Contracts\Transaction;
use Illuminate\Support\Facades\Validator;

class CashTransaction implements Transaction
{
    private $requestData;
    private $banknoteValues = [1, 5, 10, 50, 100];
    private $maxAmount = 10000;

    public function __construct($requestData)
    {
        $this->requestData = $requestData;
    }

    public function validate()
    {
        // Validate each banknote's quantity
        $validator = Validator::make($this->requestData, [
            'banknote1' => 'required|integer|min:0',
            'banknote5' => 'required|integer|min:0',
            'banknote10' => 'required|integer|min:0',
            'banknote50' => 'required|integer|min:0',
            'banknote100' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            dd('Validation failed', $validator->errors());
        }

        // Validate total amount
        if ($this->amount() > $this->maxAmount) {
            dd('Total amount exceeds limit');
        }

        return true;
    }

    public function amount()
    {
        $totalAmount = 0;
        foreach ($this->banknoteValues as $value) {
            $totalAmount += $value * ($this->requestData['banknote'.$value] ?? 0);
        }
        return $totalAmount;
    }

    public function inputs()
    {
        $banknotes = [
            'banknote1' => $this->requestData['banknote1'],
            'banknote5' => $this->requestData['banknote5'],
            'banknote10' => $this->requestData['banknote10'],
            'banknote50' => $this->requestData['banknote50'],
            'banknote100' => $this->requestData['banknote100']
        ];

        return json_encode(['banknotes' => $banknotes]);
    }

    public function getType()
    {
        return 'cash';
    }
}

<?php
namespace App\Transactions;

use App\Contracts\Transaction;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CardTransaction implements Transaction
{
    private $requestData;
    private $cardNumber;
    private $expirationDate;
    private $cardholder;
    private $cvv;
    private $amount;

    public function __construct($requestData)
    {
        $this->cardNumber = $requestData['cardNumber'];
        $this->expirationDate = $requestData['expirationDate'];
        $this->cardholder = $requestData['cardholder'];
        $this->cvv = $requestData['cvv'];
        $this->amount = $requestData['amount'];
    }

    public function validate()
    {
        $validator = Validator::make([
            'cardNumber' => $this->cardNumber,
            'expirationDate' => $this->expirationDate,
            'cvv' => $this->cvv,
            'amount' => $this->amount
        ], [
            'cardNumber' => 'required|digits:16|starts_with:4',
            'expirationDate' => ['required', 'date', 'date_format:Y-m-d', function($attribute, $value, $fail) {
                $expiration = Carbon::createFromFormat('Y-m-d', $value)->startOfMonth();
                $twoMonthsAhead = Carbon::now()->addMonths(2)->startOfMonth();
                if ($expiration->lt($twoMonthsAhead)) {
                    $fail('The expiration date must be at least two months from now.');
                }
            }],
            'cvv' => 'required|digits:3',
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
            'cardNumber' => $this->cardNumber,
            'expirationDate' => $this->expirationDate,
            'cardholder' => $this->cardholder,
            'cvv' => $this->cvv,
            'amount' => $this->amount
        ]);
    }

    public function getType()
    {
        return 'card';
    }
}

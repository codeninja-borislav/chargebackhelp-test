<?php

use Tests\TestCase;
use App\Transactions\CashTransaction;

class CashTransactionTest extends TestCase
{
    /** @test */
    public function it_calculates_total_amount_correctly()
    {
        $requestData = [
            'banknote1' => 3,
            'banknote5' => 2,
            'banknote10' => 1,
            'banknote50' => 1,
            'banknote100' => 1
        ];

        $transaction = new CashTransaction($requestData);
        $this->assertEquals(173, $transaction->amount());
    }

    /** @test */
    public function it_validates_input_correctly()
    {
        $validRequestData = [
            'banknote1' => 5,
            'banknote5' => 5,
            'banknote10' => 5,
            'banknote50' => 5,
            'banknote100' => 5
        ];

        $transaction = new CashTransaction($validRequestData);
        $this->assertTrue($transaction->validate());

        $invalidRequestData = [
            'banknote1' => -1,   // invalid value
            'banknote5' => 5,
            'banknote10' => 5,
            'banknote50' => 5,
            'banknote100' => 5
        ];

        $this->expectException(\Exception::class);
        $invalidTransaction = new CashTransaction($invalidRequestData);
        $invalidTransaction->validate();
    }

    /** @test */
    public function it_converts_inputs_to_json_correctly()
    {
        $requestData = [
            'banknote1' => 5,
            'banknote5' => 5,
            'banknote10' => 5,
            'banknote50' => 5,
            'banknote100' => 5
        ];

        $transaction = new CashTransaction($requestData);
        $expectedJson = json_encode(['banknotes' => $requestData]);
        $this->assertEquals($expectedJson, $transaction->inputs());
    }
}

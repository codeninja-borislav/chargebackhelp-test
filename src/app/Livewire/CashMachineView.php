<?php

namespace App\Livewire;

use App\Services\TransactionsService;
use Livewire\Component;

class CashMachineView extends Component
{
    public string $paymentMethod = 'none';
    // cash payments
    public int $banknote1 = 0;
    public int $banknote5 = 0;
    public int $banknote10 = 0;
    public int $banknote50 = 0;
    public int $banknote100 = 0;

    // card payments

    // bank payments

    public function updateSelectedPaymentMethod(){}

    public function submitTransaction()
    {
        $transactionsService = app(TransactionsService::class);

        if ($this->paymentMethod === 'cash') {
            $cashData = [
                'banknote1' => $this->banknote1,
                'banknote1' => $this->banknote2,
                'banknote1' => $this->banknote3,
                'banknote1' => $this->banknote4,
                'banknote5' => $this->banknote5,
            ];
            $transactionsService->handleTransaction($this->paymentMethod);
        }
    }

    public function render()
    {
        return view('livewire.cash-machine-view');
    }
}

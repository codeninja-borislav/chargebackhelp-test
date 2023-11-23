<div>
    <h3>Cash Machine</h3>

    <h4>Select Payment Method</h4>
        <select wire:model="paymentMethod" wire:change="updateSelectedPaymentMethod">
            <option value="none">- select payment method -</option>
            <option value="cash">Cash</option>
            <option value="card">Credit Card</option>
            <option value="bank">Bank Transfer</option>
        </select>

        @if(!$paymentMethod || $paymentMethod === 'none')
            <p>No payment method selected</p>
        @elseif($paymentMethod === 'cash')

            <p>Cash payments</p>
            <form wire:submit.prevent="submitTransaction">

                <label for="banknote1">1 banknote quantity:</label>
                <input type="number" id="banknote1" name="banknote1" min="0"><br>

                <label for="banknote5">5 banknote quantity:</label>
                <input type="number" id="banknote5" name="banknote5" min="0"><br>

                <label for="banknote10">10 banknote quantity:</label>
                <input type="number" id="banknote10" name="banknote10" min="0"><br>

                <label for="banknote50">50 banknote quantity:</label>
                <input type="number" id="banknote50" name="banknote50" min="0"><br>

                <label for="banknote100">100 banknote quantity:</label>
                <input type="number" id="banknote100" name="banknote100" min="0"><br>

                <br>

                <button type="submit">Submit Cash</button>
            </form>

        @elseif($paymentMethod === 'card')

            <p>Credit Card payments</p>
            <form wire:submit.prevent="submitTransaction">
                <button type="submit">Submit</button>
            </form>

        @elseif($paymentMethod === 'bank')

            <p>Bank Transfer payments</p>
            <form wire:submit.prevent="submitTransaction">

                <button type="submit">Submit</button>
            </form>

        @else
            <p>Unknown payment method.</p>
        @endif

</div>

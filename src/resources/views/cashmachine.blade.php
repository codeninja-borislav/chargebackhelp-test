<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Machine</title>
    <style>
        .hidden { display: none; }
    </style>
</head>
<body>

<div>
    <h3>Cash Machine</h3>

    <h4>Select Payment Method</h4>
    <select id="paymentMethod">
        <option value="none">- select payment method -</option>
        <option value="cash">Cash</option>
        <option value="card">Credit Card</option>
        <option value="bank">Bank Transfer</option>
    </select>

    <div id="cashForm" class="hidden">
        <p>Cash payments</p>
        <form action="{{ route('submit.transaction') }}" method="post">
            @csrf

            <label for="banknote1">1 banknote quantity:</label>
            <input type="number" id="banknote1" name="banknote1" min="0" value="0"><br>

            <label for="banknote5">5 banknote quantity:</label>
            <input type="number" id="banknote5" name="banknote5" min="0" value="0"><br>

            <label for="banknote10">10 banknote quantity:</label>
            <input type="number" id="banknote10" name="banknote10" min="0" value="0"><br>

            <label for="banknote50">50 banknote quantity:</label>
            <input type="number" id="banknote50" name="banknote50" min="0" value="0"><br>

            <label for="banknote100">100 banknote quantity:</label>
            <input type="number" id="banknote100" name="banknote100" min="0" value="0"><br>

            <input type="hidden" value="cash" name="paymentMethod">
            <br>

            <button type="submit">Submit Cash Payment</button>
        </form>
    </div>

    <div id="cardForm" class="hidden">
        <p>Credit Card payments</p>
        <form action="{{ route('submit.transaction') }}" method="post">
            @csrf

            <label for="cardNumber">Credit Card Number</label>
            <input type="number" id="cardNumber" name="cardNumber"><br>

            <label for="expirationDate">Expiration Date</label>
            <input type="date" id="expirationDate" name="expirationDate"><br>

            <label for="cardholder">Credit Card Holder Full Name</label>
            <input type="text" id="cardholder" name="cardholder"><br>

            <label for="cvv">CVV 3-digits</label>
            <input type="number" id="cvv" name="cvv"><br>

            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount"><br>

            <input type="hidden" value="card" name="paymentMethod">
            <br>
            <button type="submit">Submit Card Payment</button>
        </form>
    </div>

    <div id="bankForm" class="hidden">
        <p>Bank Transfer</p>
        <form action="{{ route('submit.transaction') }}" method="post">
            @csrf

            <label for="transferDate">Transfer Date</label>
            <input type="date" id="transferDate" name="transferDate"><br>

            <label for="customerName">Customer Name</label>
            <input type="text" id="customerName" name="customerName"><br>

            <label for="accountNumber">Account Number</label>
            <input type="text" id="accountNumber" name="accountNumber"><br>

            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount"><br>

            <input type="hidden" value="bank" name="paymentMethod">
            <br>
            <button type="submit">Submit Bank Transfer</button>
        </form>
    </div>

</div>

<script>
    document.getElementById('paymentMethod').addEventListener('change', function() {
        // Hide all forms initially
        document.getElementById('cashForm').classList.add('hidden');
        document.getElementById('cardForm').classList.add('hidden');
        document.getElementById('bankForm').classList.add('hidden');

        // Show the selected form
        var selectedMethod = this.value;
        if(selectedMethod === 'cash') {
            document.getElementById('cashForm').classList.remove('hidden');
        } else if(selectedMethod === 'card') {
            document.getElementById('cardForm').classList.remove('hidden');
        } else if(selectedMethod === 'bank') {
            document.getElementById('bankForm').classList.remove('hidden');
        }
    });
</script>

</body>
</html>


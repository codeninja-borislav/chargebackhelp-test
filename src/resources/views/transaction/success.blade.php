@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Transaction Successful</h1>
        <p>Transaction ID: {{ $transaction->id }}</p>
        <p>Total Amount: {{ $transaction->amount }}</p>
        <p>Inputs: {{ $transaction->inputs }}</p>
    </div>
@endsection

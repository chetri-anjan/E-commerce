@extends('layout')
@section('content')
<style>
.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.billing-info {
    margin-bottom: 20px;
}

.info-group {
    margin-bottom: 10px;
}

.info-group label {
    font-weight: bold;
}

.info-group p {
    margin: 5px 0;
}

.button-container {
    text-align: center;
}

.home-button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.home-button:hover {
    background-color: #0056b3;
}

</style>
<p id="user-name">{{ $user->name }}</p>
<p id="user-address">{{ $user->address }}</p>
<p id="delivery-address">{{ $deliveryAddress->full_address }}</p> <!-- Adjust if needed -->
<p id="total-payment">${{ number_format($totalPayment, 2) }}</p>
<p id="currency">{{ $selectedCurrency }}</p>

                    <div class="button-container">
                        <a href="{{ url('/') }}" class="home-button">Back to Home</a>
                    </div>
                </div>
@endsection

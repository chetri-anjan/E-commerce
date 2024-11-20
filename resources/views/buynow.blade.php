@extends('layout')
@section('content')
<link rel="stylesheet" href="/css/buynow.css">

<div class="main-content">
    <div class="left-column">
        <div style="color: #0066cc;">
            @if($addresses->isEmpty())
                <a href="{{ route('add_addresses') }}">Add Address</a>
            @endif
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="product">
            @if($product->image)
                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->product_name }}" height="200" />
            @endif
            <h2>{{ $product->product_name }}</h2><br>
            <div class="product-info">
                <div><strong>Description:</strong> {{ $product->description }}</div>
            </div>
        </div>
    </div>

    <div class="right-column">
        <h3>Order Summary</h3>
        <p>Product Name: <span id="product-name">{{ $product->product_name }}</span></p>
        <p>Price: <span id="product-price">Rs. {{ $product->price }}</span></p>
        <p>Shipping Charge: <span id="delivery-fee">Rs. {{ $shippingCharge }}</span></p>
        <p>Total Payment: <span id="total-payment">Rs. {{ $product->price + $shippingCharge }}</span></p>
        
        <h5>All taxes included</h5>

        <form action="{{ route('checkout', $product->id) }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="delivery_date" value="2024-07-30">
            <input type="hidden" id="currency-hidden" name="currency" value="{{ old('currency') ?? 'NPR' }}">
            <input type="hidden" id="hidden-delivery-fee" name="delivery_fee" value="{{ $shippingCharge }}">


            <div id="address-selection">
                <label for="delivery_address">Delivery Address:</label>
                <select id="delivery_address" name="delivery_address">
                    <option value="">Select Address</option>
                    @foreach($addresses as $address)
                        <option value="{{ $address->id }}">
                            {{ $address->location }} - {{ $address->house_no }}, {{ $address->street_no }}, {{ $address->city }}, {{ $address->state }}, {{ $address->country }} - {{ $address->postal_code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="">Select Payment Method</option>
                    <option value="stripe">Credit Card (Visa/Mastercard)</option>
                    @if($selectedCountry == 'Nepal')
                        <option value="cod">Cash on Delivery</option>
                    @endif
                </select>
            </div>

            <div>
                <label for="delivery">Delivery:</label>
                <select id="delivery" name="delivery" required>
                    <option value="">Select Delivery Way</option>
                    <option value="">Standard</option>
                    <option value="">Gift</option>
                </select>
            </div>

            <div>
                <input type="checkbox" id="use-alternative-address" name="use_alternative_address" value="1">
                <label for="use-alternative-address">Use Alternative Delivery Address</label>
            </div>

            <!-- Alternative Address Form -->
            <div id="alternative-address-form" name ="use_alternative_address" style="display: none; margin-top: 10px;">
                <h4>Alternative Address</h4>
                <div>
                    <label for="alt_house_no">Name:</label>
                    <input type="text" id="alt_name" name="alt_name">
                </div>
                <div>
                    <label for="alt_house_no">House No:</label>
                    <input type="text" id="alt_house_no" name="alt_house_no">
                </div>
                <div>
                    <label for="alt_street_no">Street No:</label>
                    <input type="text" id="alt_street_no" name="alt_street_no">
                </div>
                <div>
                    <label for="alt_city">City:</label>
                    <input type="text" id="alt_city" name="alt_city">
                </div>
                <div>
                    <label for="alt_state">State:</label>
                    <input type="text" id="alt_state" name="alt_state">
                </div>
                <div>
                    <label for="alt_country">Select Country:</label>
                    <select id="alt_currency" name="alt_currency">
                        <option value="NPR" {{ old('alt_currency') == 'NPR' ? 'selected' : '' }}>Nepal</option>
                        <option value="USD" {{ old('alt_currency') == 'USD' ? 'selected' : '' }}>United State America </option>
                        <option value="GBP" {{ old('alt_currency') == 'GBP' ? 'selected' : '' }}>United Kingdom</option>
                        <option value="CAD" {{ old('alt_currency') == 'CAD' ? 'selected' : '' }}>Canada</option>
                        <option value="EUR" {{ old('alt_currency') == 'EUR' ? 'selected' : '' }}>Europ</option>
                    </select>
                </div>
                <div>
                    <label for="alt_postal_code">Postal Code:</label>
                    <input type="text" id="alt_postal_code" name="alt_postal_code">
                </div>
            </div>

            <label for="quantity">Quantity:</label>
            <input id="quantity" name="quantity" type="number" min="1" value="1">

                <!-- Currency Selection -->
                <div>
                <label for="currency">Select Currency:</label>
                <select id="currency" name="currency">
                    <option value="NPR" {{ old('currency') == 'NPR' ? 'selected' : '' }}>Nepalese Rupee (NPR)</option>
                    <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>US Dollar (USD)</option>
                    <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>British Pound (GBP)</option>
                    <option value="CAD" {{ old('currency') == 'CAD' ? 'selected' : '' }}>Canadian Dollar (CAD)</option>
                    <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                </select>
            </div>

            <button type="submit" class="place-order">Place Order</button>
        </form>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Event listener for the main currency selector
    document.getElementById('currency').addEventListener('change', function() {
        var currency = this.value; // Get the selected currency value
        console.log("Currency changed in main selector");
        updatePrice(currency); // Pass the currency to updatePrice
    });
    
    // Event listener for the alternative address currency selector
    document.getElementById('alt_currency').addEventListener('change', function() {
        var currency = this.value; // Get the selected currency value
        console.log("Currency changed in alternative address selector");
        updatePrice(currency); // Pass the currency to updatePrice
    });

    // Event listener for quantity input
    document.getElementById('quantity').addEventListener('input', function() {
        console.log("Quantity changed");
        var currency = document.getElementById('currency').value; // Get the current selected currency
        updatePrice(currency); // Pass the currency to updatePrice
    });

    // Event listener for alternative address checkbox
    document.getElementById('use-alternative-address').addEventListener('change', function() {
        var alternativeAddressForm = document.getElementById('alternative-address-form');
        var addressSelection = document.getElementById('address-selection');
        if (this.checked) {
            console.log("Alternative address selected");
            alternativeAddressForm.style.display = 'block';
            addressSelection.style.display = 'none';
        } else {
            console.log("Alternative address deselected");
            alternativeAddressForm.style.display = 'none';
            addressSelection.style.display = 'block';
        }

        // Update price when alternative address checkbox changes
        var currency = document.getElementById('currency').value; // Get the current selected currency
        updatePrice(currency); // Pass the currency to updatePrice
    });

    function updatePrice(currency) {
    // Check if the alternative address is being used
    var useAltAddress = document.getElementById('use-alternative-address').checked;

    // Get the selected currency from the appropriate selector
    var country = useAltAddress ? document.getElementById('alt_currency').value : currency;
    var quantity = parseInt(document.getElementById('quantity').value);
    var price = {{ $product->price }};
    
    // Delivery fees based on currency
    var deliveryFees = {
        'NPR': {{ $shippingCharge }},
        'USD': 2500,  // Example delivery fee in USD
        'GBP': 2000,  // Example delivery fee in GBP
        'CAD': 2800,  // Example delivery fee in CAD
        'EUR': 3000   // Example delivery fee in EUR
    };
    
    // Conversion rates (Example, you may want to use a dynamic approach)
    var rates = {
        'USD': 0.0076,
        'GBP': 0.0061,
        'CAD': 0.010,
        'NPR': 1.00,
        'EUR': 0.0072
    };

    // Select the correct delivery fee
    var deliveryFee = deliveryFees[country];

    // Calculate total payment based on selected currency and quantity
    var convertedPrice = (price * quantity * rates[currency]).toFixed(2);
    var convertedDeliveryFee = (deliveryFee * rates[currency]).toFixed(2);
    deliveryFee = deliveryFee * rates[currency];
    var totalPayment = (parseFloat(convertedPrice) + parseFloat(convertedDeliveryFee)).toFixed(2);

    // Update display
    document.getElementById('product-price').textContent = currency + ' ' + convertedPrice;
    document.getElementById('delivery-fee').textContent = currency + ' ' + convertedDeliveryFee;
    document.getElementById('total-payment').textContent = currency + ' ' + totalPayment;

    // Update hidden input for form submission
    document.getElementById('currency-hidden').value = currency;
    document.getElementById('hidden-delivery-fee').value = deliveryFee;

}

    // Initialize the price calculation on page load
    var initialCurrency = document.getElementById('currency').value;
    updatePrice(initialCurrency); // Pass the initial currency to updatePrice
});

</script>

@endsection

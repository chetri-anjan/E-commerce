@extends('layout')

@section('content')
<link rel="stylesheet" href="/css/cart.css">

<div class="cart-container">
    <!-- Display Success and Error Messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

<div class="cart-container">
    @if ($cartItems->isNotEmpty())
        @foreach ($cartItems as $cartItem)
            <div class="cart-item">
                @if($cartItem->product->image)
                    <img src="{{ asset('uploads/' . $cartItem->product->image) }}" 
                         alt="{{ $cartItem->product->product_name }}" />
                @endif
                <div class="cart-item-details">
                    <p><strong>Product:</strong> {{ $cartItem->product->product_name }}</p>
                    <p><strong>Price:</strong> Rs{{ $cartItem->product->price }}</p>
                    <!-- <p><strong>Quantity:</strong> {{ $cartItem->quantity }}</p> -->
                </div>
                <div class="cart-item-actions">
                    <a href="{{ route('buyproduct', $cartItem->product->id) }}" class="btn-buy-now">Buy Now</a>
                    <!-- Delete form -->
                    <form action="{{ route('cart.delete', $cartItem->product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p class="empty-cart">Cart is empty.</p>
    @endif
</div>

@endsection

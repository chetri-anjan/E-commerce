@extends('layout')
@section('content')
<link rel="stylesheet" href="/css/home.css">


<div class="search-bar">
    <form action="{{ route('products') }}" method="GET">
        <input type="text" name="query" placeholder="Search for categories" value="{{ request('query') }}">
         <!-- Price Range Filter -->
         <div class="price-filter">
            <label for="min_price">Min Price:</label>
            <input type="number" name="min_price" id="min_price" value="{{ request('min_price') }}" placeholder="0">
            
            <label for="max_price">Max Price:</label>
            <input type="number" name="max_price" id="max_price" value="{{ request('max_price') }}" placeholder="1000">
        </div>

        <button type="submit">🔍</button>
    </form>
</div>

<div class="product-container">
    <h2>All Products</h2>
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->product_name }}" />
                <div class="product-info">
                    <h3>{{ $product->product_name }}</h3>
                    <p>Rs.{{ $product->price }}</p>

                    <form action="{{ route('cart.add') }}" method="post" class="cart-form">
                         @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1" min="1" class="quantity-input">
                        <button type="submit" class="">Add to Cart</button>
                    <!-- <a href="" class="btn-add-to-cart">Add Cart</a> -->
                    </form>
                    <a href="{{route('show_product', $product->id)}}" class="btn-add-to-cart">Buy Now</a>
                    <!-- <a href="{{route('cart.index')}}" class="btn-add-to-cart">Add Cart</a> -->
                   
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection

@extends('layout')
@section('content')
<link rel="stylesheet" href="/css/singleproduct.css">

<div class="product-details">
    @if($product->image)
    <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->product_name }}" class="product-image" />
    @endif
    <h2 class="product-name">{{$product->product_name}}</h2>

    <div class="product-info">
        <p><strong>Description:</strong> {{$product->description}}</p>
        <p><strong>Price:</strong> ${{$product->price}}</p>
        <p><strong>Available Items:</strong> {{$product->stock}} piece</p>
        
    </div>

     <!-- Check if the product is in stock -->
     @if($product->stock > 0)
        <a href="{{ route('buyproduct', $product->id) }}" class="btn-buy-now">BUY NOW</a>
  
    <!-- <a href="{{route('buyproduct', $product->id)}}" class="btn-buy-now">BUY NOW</a> -->

    <form action="{{ route('cart.add') }}" method="post" class="cart-form">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <!-- You can uncomment these lines if you want to allow adding to cart when the stock is greater than 0 -->
        <!-- @if($product->stock > 0) -->
            <!-- <input type="number" name="quantity" value="1" min="1" class="quantity-input"> -->
            <!-- <button type="submit" class="btn-add-to-cart">Add to Cart</button> -->
        <!-- @endif -->
    </form>
    @else
        <p class="out-of-stock-message">Out of Stock</p>
    @endif
</div>



 <!-- Display Ratings -->
<!-- Display Ratings -->
<h3 class="ratings-heading">Ratings & Reviews</h3>
<div class="reviews-section">
    @if($ratings->isEmpty())
        <p class="no-ratings-message">No ratings yet. Be the first to rate this product!</p>
    @else
        @foreach ($ratings as $rating)
            <div class="review-item">
                <strong class="reviewer-name">User Name:{{ $rating->user->name }}</strong>
                <h4 class="reviewer-name">Review Time:{{ $rating->created_at }}</h4>
                <div class="star-rating">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="star {{ $i < $rating->rating ? 'filled' : '' }}">&#9733;</span>
                    @endfor
                    <!-- <span class="rating-score">{{ $rating->rating }} / 5</span> -->
                </div>
                <p class="review-text">{{ $rating->review }}</p>
            </div>
        @endforeach
    @endif
</div>


<!-- Rating Form -->
@auth
    <form action="{{ route('ratings.store', $product->id) }}" method="POST" class="rating-form">
        @csrf
        <div class="form-group">
            <label for="rating">Your Rating:</label>
            <div class="star-rating-input">
                @for ($i = 1; $i <= 5; $i++)
                    <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}" required>
                    <label for="rating-{{ $i }}" class="star">&#9733;</label>
                @endfor
            </div>
        </div>
        <div class="form-group">
            <label for="review">Your Review:</label>
            <textarea name="review" id="review" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn-submit">Submit Review</button>
    </form>
@else
    <p>Please <a href="{{ route('login') }}">login</a> to leave a review.</p>
@endauth


@endsection
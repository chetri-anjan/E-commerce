@extends('layout')
@section('content')


<link rel="stylesheet" href="/css/home.css">

@if(session('error'))
    <div class="alert alert-danger" color="red">
        {{ session('error') }}
    </div>
    @endif

    @if(session('message'))
    <div class="alert alert-success" color="green">
        {{ session('message') }}
    </div>
    @endif
    
<section class="hero">
  <div class="hero-content">
    <h1>Discover the best deals on the latest trends </h1>
    <h2>Where quality meets affordability</h2>
    <a href="{{route('products')}}" class="cta-button">Shop Now</a>
  </div>
</section>



<div class="product-container">
    <h2>New Products</h2>
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('uploads/' . $product->image) }}" alt="{{ $product->product_name }}" />
                <div class="product-info">
                    <h3>{{ $product->product_name }}</h3>
                    <h4>Rs:{{ $product->price }}</h4>
                      <!-- Display the average rating as stars -->
                      @if($product->rating->count() > 0)
                        <div class="star-rating">
                            @php
                                $averageRating = $product->averageRating();
                                $fullStars = floor($averageRating); // Number of full stars
                                $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0; // Number of half stars
                                $emptyStars = 5 - $fullStars - $halfStar; // Number of empty stars
                            @endphp

                            <!-- Full stars -->
                            @for ($i = 0; $i < $fullStars; $i++)
                                <span class="fa fa-star checked"></span>
                            @endfor

                            <!-- Half star -->
                            @if($halfStar)
                                <span class="fa fa-star-half-alt checked"></span>
                            @endif

                            <!-- Empty stars -->
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <span class="fa fa-star"></span>
                            @endfor
                        </div>
                    @else
                        <h4>Rating Not Available</h4>
                    @endif


                    <!-- Conditional Add to Cart Button -->
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add') }}" method="post" class="cart-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1" min="1" class="quantity-input">
                            <button type="submit" class="btn-add-to-cart">Add to Cart</button>
                        </form>
                    @else
                        <p class="out-of-stock-message">Out of Stock</p>
                    @endif
                    <a href="{{route('show_product', $product->id)}}" class="btn-add-to-cart">Buy Now</a>
                    <!-- <a href="{{route('cart.index')}}" class="btn-add-to-cart">Add Cart</a> -->
                </div>
            </div>
        @endforeach
    </div>
</div>




<div class="why-choose-us">
    <h2>Why choose us</h2>
    <div class="features-grid">
        <div class="feature-item">
            <div class="feature-icon">
                <img src="../photos/log.jpg" alt="Reasonable prices">
            </div>
            <h3>Reasonable prices</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod.</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <img src="../photos/logss.jpg" alt="Best quality">
            </div>
            <h3>Best quality</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod.</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <img src="../photos/logsssssss.png" alt="Worldwide shipping">
            </div>
            <h3>Worldwide shipping</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod.</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <img src="path_to_your_icon_4.png" alt="Customer satisfaction">
            </div>
            <h3>Customer satisfaction</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod.</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <img src="../photos/logsssss.webp" alt="Happy customers">
            </div>
            <h3>Happy customers</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod.</p>
        </div>
        <div class="feature-item">
            <div class="feature-icon">
                <img src="../photos/logs.jpg" alt="Fast shipping">
            </div>
            <h3>Fast Shipping</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod.</p>
        </div>
    </div>
</div>



<div class="blog-section">
        <h1>Latest Blog Posts</h1>
        <div class="blog-list">
            <div class="blog-post">
                <img src="../photos/success3.webp" alt="Blog Post 1">
                <div class="blog-content">
                    <h2>The Future of E-Commerce</h2>
                    <p>Stay ahead of the curve by learning about emerging trends and technologies shaping the future of online shopping....</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
            </div>

            <div class="blog-post">
                <img src="../photos/success2.jpg" alt="Blog Post 2">
                <div class="blog-content">
                    <h2>Why Customer Reviews Matter</h2>
                    <p>Understand the importance of customer reviews and how they can help you make informed purchasing decisions....</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
            </div>

            <div class="blog-post">
                <img src="../photos/success1.jpg" alt="Blog Post 3">
                <div class="blog-content">
                    <h2>Eco-Friendly Shopping</h2>
                    <p>Discover ways to shop sustainably and make eco-friendly choices when purchasing products online....</p>
                    <a href="#" class="read-more">Read More</a>
                </div>
            </div>
        </div>
    </div>



@endsection




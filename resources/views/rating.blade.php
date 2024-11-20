@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>

    <!-- Display Ratings -->
    <h3>Ratings & Reviews</h3>
    @foreach ($ratings as $rating)
        <div>
            <strong>{{ $rating->user->name }}</strong>
            <span>{{ $rating->rating }} / 5</span>
            <p>{{ $rating->review }}</p>
        </div>
    @endforeach

    <!-- Rating Form -->
    @auth
        <form action="{{ route('ratings.store', $product->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="rating">Rating</label>
                <select name="rating" id="rating" class="form-control" required>
                    <option value="">Choose a rating</option>
                    <option value="1">1 - Very Bad</option>
                    <option value="2">2 - Bad</option>
                    <option value="3">3 - Average</option>
                    <option value="4">4 - Good</option>
                    <option value="5">5 - Excellent</option>
                </select>
            </div>
            <div class="form-group">
                <label for="review">Review</label>
                <textarea name="review" id="review" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to leave a review.</p>
    @endauth
</div>
@endsection

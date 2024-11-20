@extends('layout')
@section('content')
<link rel="stylesheet" href="/css/applyproduct.css">
<div class="container">
    <form method="POST" action="{{ route('add_products') }}" enctype="multipart/form-data" class="add-job-form">
        @csrf
        <div class="row">
            <div class="col-25">
                <label for="name">Name</label>
            </div>
            <div class="col-75">
                <input type="text" name="product_name" id="product_name" placeholder="product name" required>
            </div>
        </div>


        <div class="row">
             <div class="col-25">
                <label for="category">Category</label>
            </div>
            <div class="col-75">
                <select id="category" name="category" required>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->product_title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="image">Photo</label>
            </div>
            <div class="col-75">
                <input type="file" name="image" id="image">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="description">Description</label>
            </div>
            <div class="col-75">
                <textarea name="description" id="description" placeholder="Write something about product..."></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="price">Price</label>
            </div>
            <div class="col-75">
                <input type="text" name="price" id="price" placeholder="Enter product amount...">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label for="quantity">Quantity</label>
            </div>
            <div class="col-75">
                <input type="number" name="quantity" id="quantity" min="1" max="10">
            </div>
        </div>

        <div class="row">
            <div class="form_submit">
                <!-- <button type="submit" class="add-job-button">Add Product</button> -->
                 <input type="submit" value="submit">
            </div>
        </div>
    </form>
</div>
@endsection

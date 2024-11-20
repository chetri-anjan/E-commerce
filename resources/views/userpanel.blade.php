@extends('layout')
@section('content')
<link rel="stylesheet" href="/css/userpanel.css">

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="profile-container">
    <h1>User Profile</h1>

    <div class="user-info">
        <h4>Name: {{ Auth::user()->name }}</h4>
        <h4>Email: {{ Auth::user()->email }}</h4>
        <h4>Role: {{ Auth::user()->role == 1 ? 'Customer' : (Auth::user()->role == 2 ? 'Company User' : 'Super Admin') }}</h4>
    </div>

    <div class="user-section">
        <h2>My Address</h2>
        @foreach($addresses as $address)
            <p>House No: {{ $address->house_no }}, Street No: {{ $address->street_no }}, City: {{ $address->city }}, State: {{ $address->state }}, Country: {{ $address->country }}, Address: {{ $address->postal_code }}</p>
        @endforeach
        <li><a href="{{ route('add_addresses') }}">Add Address</a></li>
    </div>

    <div class="user-section">
        <h3>My Purchased Products</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Purchase Date</th>
                    <th>Status</th>
                    <th>Courier Office</th>
                    <th>Consignment Number</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                    <tr>
                        <td><img src="{{ asset('uploads/' . $purchase->product->image) }}" alt="{{ $purchase->product->product_name }}" /></td>
                        <td>{{ $purchase->product->product_name }}</td>
                        <td>{{ $purchase->product->price }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ $purchase->created_at }}</td>
                        <td>{{ $purchase->status}}</td>
                        <td>{{ $purchase->courier_office ? $purchase->courier_office : 'Null' }}</td>
                        <td>{{ $purchase->consignment_number ? $purchase->consignment_number : 'Null' }}</td>
                        <!-- <td>
                            <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">Cancel Order</button>
                            </form>
                        </td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="user-section">
        <h3>My Cart Products</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <td><img src="{{ asset('uploads/' . $cartItem->product->image) }}" alt="{{ $cartItem->product->product_name }}" /></td>
                        <td>{{ $cartItem->product->product_name }}</td>
                        <td>{{ $cartItem->product->price }}</td>
                        <td>{{ $cartItem->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

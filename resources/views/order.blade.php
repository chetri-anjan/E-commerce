@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Orders</h2>
   
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Payment</th>
                <th>Delivery Date</th>
                <th>Address</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->product->product_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ $order->delivery_date }}</td>
                <td>{{ $order->delivery_address }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

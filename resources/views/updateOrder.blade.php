@extends('layout')

@section('content')

<style>
    .form-container {
        max-width: 500px;
        margin: auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input, .form-group select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-group select {
        height: 40px;
    }

    .btn-submit {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #45a049;
    }
</style>

<div class="form-container">
    <form action="{{ route('updateOrder') }}" method="POST">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">

        <div class="form-group">
            <label for="consignment_number">Consignment Number</label>
            <input type="text" id="consignment_number" name="consignment_number">
        </div>

        <div class="form-group">
            <label for="courier_service">Courier Service</label>
            <select id="courier_service" name="courier_service">
                <option value="">Select a courier service</option>
                <option value="DHL">DHL</option>
                <option value="FedEx">FedEx</option>
                <option value="UPS">UPS</option>
                <option value="USPS">USPS</option>
            </select>
        </div>

        <div class="form-group">
            <label for="courier_office">Courier Office</label>
            <input type="text" name="courier_office" >
        </div>

        <div class="form-group">
            <label for="order_status">Order Status</label>
            <select id="order_status" name="order_status">
                <option value="shipping">Shipping</option>
                <option value="delivered">Delivered</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Update Order</button>
    </form>
</div>

@endsection

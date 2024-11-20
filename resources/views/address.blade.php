@extends('layout')
@section('content')

<link rel="stylesheet" href="/css/address.css">
<div class="container">

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <form method="POST" action="{{ route('add_addresses') }}" enctype="multipart/form-data" class="add-address-form">
        @csrf

        <div class="form-group">
            <label for="country">Country</label>
            <select id="country" name="country" required>
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->country_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input type="text" name="state" id="state" placeholder="State" required>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" placeholder="City" required>
        </div>

        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="text" name="postal_code" id="postal_code" placeholder="Postal Code" required>
        </div>

        <div class="form-group">
            <label for="street_no">Street Number</label>
            <input type="text" name="street_no" id="street_no" placeholder="Street Number" required>
        </div>

        <div class="form-group">
            <label for="house_no">House Number</label>
            <input type="text" name="house_no" id="house_no" placeholder="House Number" required>
        </div>

        <div class="form-group location-group">
            <label>Location</label>
            <label>
                <input type="radio" value="home" name="location"> Home
            </label>
            <label>
                <input type="radio" value="office" name="location"> Office
            </label>
        </div>

        <div class="form-group">
            <input type="submit" value="Add Address" class="submit-button">
        </div>
    </form>
</div>
@endsection

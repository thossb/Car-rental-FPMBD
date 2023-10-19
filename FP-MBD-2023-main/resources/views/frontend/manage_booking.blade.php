@extends('layouts.user_main')

@section('content')
<div class="head  row">
    <div class="text-center">
        <h3>Manage Booking</h3>
        <a href="{{ route('booking_history') }}" class="btn btn-primary"> Booking List </a>
    </div>
</div>
<form action="{{ route('payment_details') }}" method="post">
@csrf
<div class="container" style="margin-top:20px;">
    <div class="main-container">
        <h4>{{ $data->name }}</h4>
        <div class="row">
            <div class="col">
                <img src={{ asset("vehicle/image/" . $data->image ) }} alt="Foto Image" width="250px">
            </div>
            <div class="col"> 
                <p>{{ $data->capacities }} People</p>
                <p>Automatic</p>
            </div>
            <div class="col">
                <div class="container">
                    <p class="badge" style="font-size:15px; text-align: right;">{{ session('new_pickup') }} - {{ session('new_dropoff') }}</p>
                    <p style="text-align: right; padding:0px; 20px 0px 30px;" class="font-bold">@if(session('duration'))  {{ session('duration')  }}  @endif Day(s)</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="col-1">
        </div>
        <div class="col">
            <div class="form-goup">
                <label for="">Pick Up Location</label>
                <input type="text" class="form-control form-booking" name="pickup_location" required>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-1">
        </div>
        <div class="col">
            <div class="form-goup">
                <label for="">Drop Off Location</label>
                <input type="text" name="dropoff_location" class="form-control form-booking" required>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row main-container">
        <div class="col">
            <h5 style="">Total rental for @if(session('duration'))  {{ session('duration')  }}  @endif Days</h5>
            <p class="price-font">
                Rp.
                @if(session('duration'))
                    @if(session('with_driver'))
                        {{number_format(($data->rent_price+$data->driver_price)*session('duration'),2,',','.');}}/Day
                    @else
                        {{number_format(($data->rent_price*session('duration')),2,',','.');}}
                    @endif
                @endif
            </p>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-main" style="padding:10px 30px 10px 30px; float: right; margin-top:20px;">Booking Confirmation</button>
        </div>
    </div>
</div>
</form>
@endsection
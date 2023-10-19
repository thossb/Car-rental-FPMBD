@extends('layouts.user_main')

@section('content')
<div class="head  row">
    <div class="text-center">
        <h3>Payment Details</h3>
        <a href="{{ route('booking_history') }}" class="btn btn-primary"> Booking List </a>
    </div>
</div>
<form action="{{ route('booking.finish') }}" method="post">
<div class="container" style="margin-top:20px;">
        @csrf
        <div class="row">
           <div class="col main-container">
                <h5>{{$data->name}}</h5>
                <div class="row">
                    <div class="col-8">
                        <img src={{ asset("vehicle/image/" . $data->image ) }} alt="Foto Image" width="300px">
                    </div>
                    <div class="col">
                        <p>{{ $data->capacities }} People</p>
                        <p>Automatic</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-7">
                        <p class="badge2" style="font-size:15px;">{{ session('new_pickup') }} - {{ session('new_dropoff') }}</p>
                    </div>
                    <div class="col-3">
                        <p class="font-bold badge2">@if(session('duration')) {{session('duration')}} @endif Day(s)</p>
                        <input type="hidden" name="duration" value="@if(session('duration')) {{session('duration')}} @endif">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Pick Up location
                    </div>
                    <div class="col">
                        <p class="badge2" style="font-size:15px;">@if(session('pickup_location')) {{session('pickup_location')}} @endif</p>
                        <input type="hidden" name="pickup_location" value="@if(session('pickup_location')) {{session('pickup_location')}} @endif">
                        <input type="hidden" name="id_car" value="@if(session('id_car')) {{session('id_car')}} @endif">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Drop-off location
                    </div>
                    <div class="col">
                        <p class="badge2" style="font-size:15px;">@if(session('dropoff_location')) {{session('dropoff_location')}} @endif</p>
                        <input type="hidden" name="dropoff_location" value="@if(session('dropoff_location')) {{session('dropoff_location')}} @endif">
                        <input type="hidden" name="pickup_date" value="@if(session('pickup_date')) {{session('pickup_date')}} @endif">
                        <input type="hidden" name="pickup_time" value="@if(session('pickup_time')) {{session('pickup_time')}} @endif">
                        <input type="hidden" name="branch" value="@if(session('branch')) {{session('branch')}} @endif">
                        
                    </div>
                </div>
           </div>
           <div class="col">
                <div class="container" style="margin-top:50px;">
                    <p class="font-bold">Total Rental For @if(session('duration')) {{session('duration')}} @endif Day(s)</p>
                    <p class="price-font">Rp.
                        @if(session('duration'))
                            @if(session('with_driver'))
                                {{number_format(($data->rent_price+$data->driver_price)*session('duration'),2,',','.');}}/Day
                            @else
                                {{number_format(($data->rent_price*session('duration')),2,',','.');}}
                            @endif
                        @endif
                    </p>
                    <div class="form-group">
                        <select name="payments_method" id="payments_method" class="form-control form-booking2" required>
                            <option value="">Select Payment Methods</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                </div>
                <div style="bottom:0; float: right;">
                    <div class="row">
                        <div class="col">
    
                        </div>
                        <div class="col" >
                            <button type="submit" class="btn btn-main" style="padding:10px 30px 10px 30px; margin-top:20px; margin-right:20px;">Confirm</button>
                        </div>
                    </div>
                </div>
           </div>
        </div>
</div>
</form>
@endsection
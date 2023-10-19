@extends('layouts.user_main')

@section('content')
<div class="head  row">
    <div class="text-center">
        <h3>Payment Receipt</h3>
        <a href="{{ route('booking_history') }}" class="btn btn-primary"> Booking List </a>
    </div>
</div>
<div class="container bg-grey" style="margin-top:20px;">
    <div class="row">
        <div class="col-4 form-booking2">
            <div class="row" style="border-radius:10px; padding-top:20px;">
                <div class="col">
                    <p style="font-weight:900; text-align:right; ">Transaction ID</p>
                </div>
                <div class="col">
                    <p class="font-bold" style="font-size:30px;">{{$data->id}}</p>
                </div>
            </div>
        </div>
        <div class="col"> 
            <h1 class="font-bold text-center mt-3">
                ONG  CAR RENTAL
            </h1>
        </div>
    </div>
    <div class="container">
        <div class="row mt-3">
            <div class="col"><h3 class="font-bold">{{ $vehicle->name }}</h3></div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <p class="font-bold">Client name</p>
            </div>
            <div class="col">
                <p class="font-bold">Booking ID</p>
            </div>
        </div>
        <div class="row">
            <div class="col"><h3 class="font-bold">{{$user->name}}</h3></div>
            <div class="col"><h3 class="font-bold">{{$data->id}}</h3></div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <p >Booking Date</p>
            </div>
            <div class="col">
                <p >Booking Date</p>
            </div>
        </div>
        <div class="row">
            <div class="col"><p class="font-bold">{{ session('new_pickup') }} - {{ session('new_dropoff') }}</p></div>
            <div class="col"><h5 class="font-bold">{{ session('new_dropoff') }}</h5></div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <p >Pick-up Location</p>
            </div>
            <div class="col">
                <p >Payment Method</p>
            </div>
        </div>
        <div class="row">
            <div class="col"><p class="font-bold">{{ session('pickup_location') }}</p></div>
            <div class="col"><h3 class="font-bold">Cash</h3></div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <p >Drop Off Location</p>
            </div>
        </div>
        <div class="row">
            <div class="col"><p class="font-bold">{{ session('dropoff_location') }}</p></div>
        </div>
    </div>
    <div class="container pb-5" style="text-align:right;">
        <h2 class="font-bold">TOTAL PRICE</h2>
        <p class="price-font">
            Rp.{{number_format($data->booking_amount,2,',','.');}}
        </p>
        <button class="btn btn-main" data-toggle="modal" data-target="#addData" data-id='{{ $data->id }}' >Feedback</button>
    </div>
</div>
<div class="modal fade" id="addData" tabindex="-1" role="dialog" aria-labelledby="addDataLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addDataLabel">Add Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('feedback')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Feedback Type</label>
                    <select name="type_id" id="type_id" class="form-control">
                        <option value="">Select Type Feedback</option>
                        @foreach($type as $t)
                            <option value="{{$t->id}}">{{ $t->categories }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Feedback Description</label>
                    <textarea name="description" class="form-control" placeholder="Location"> </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
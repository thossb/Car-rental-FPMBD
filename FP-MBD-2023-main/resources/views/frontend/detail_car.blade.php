@extends('layouts.user_main')

@section('content')
<div class="head  row">
    <div class="text-center">
        <h3>{{ $data->name }}</h3>
        <p>{{ session('new_pickup') }} - {{ session('new_dropoff') }}</p>
    </div>
</div>
<div class="container mt-5 row mb-2">
    <div class="col" style="margin-left:100px;">
        <img src={{ asset("vehicle/image/" . $data->image ) }} alt="Foto Image" width="500px">
    </div>
    <div class="col">
        <div class="row">
            <div class="col-sm">{{ $data->capacities }} People</div>
            <div class="col-sm">Automatic</div>
            <div class="col-sm"></div>
        </div>
        @foreach($data_review as $dr)
        <div class="review mt-3">
            <b>{{ $dr->name }}</b>
            <p class="review-desc">
                {{$dr->description}}
            </p>
        </div>
        @endforeach
        <div class="form-group">
            <a href="#" class="btn form-control btn-main">See Other review</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row main-container">
        <div class="col">
            <h5 style="">Basic Rental</h5>
            <p class="price-font">
                @if(session('with_driver'))
                    Rp.{{number_format($data->rent_price+$data->driver_price,2,',','.');}}/Day
                @else
                    Rp.{{number_format($data->rent_price,2,',','.');}}/Day
                @endif
            </p>
        </div>
        <div class="col">
            <a href="{{ route('book',$data->id) }}" class="btn btn-main" style="padding:10px 80px 10px 80px; float: right; margin-top:20px;">Continue</a>
        </div>
    </div>
</div>
@endsection
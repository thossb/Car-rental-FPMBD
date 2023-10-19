@extends('layouts.user_main')

@section('content')
<div class="head  row">
    <div class="col">
        <p style="margin-left:100px;">Cars In Jakarta</p>
        <p style="margin-left:100px;">{{ session('new_pickup') }} - {{ session('new_dropoff') }}</p>
    </div>
    <div class="col">

    </div>
    <div class="col">
        <div class="container mt-1">
            <a href="{{ route('booking_history') }}" class="btn btn-primary"> Booking List </a>
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </div>
</div>
@foreach($data as $d)
    <a href="{{ route('detail_car',$d->id) }}" style="text-decoration:none;color:black;">
        <div class="list-car" style="background-color:#EBEBEB;">
            <h3>{{ $d->name }}</h3>
            <div class="row">
                <div class="col-4">
                    @if($d->image)
                        <img src={{ asset("vehicle/image/" . $d->image ) }} alt="Foto Image" width="250px">
                    @endif
                </div>
                <div class="col-2">
                    <p>8 People</p>
                    <p>Automatic</p>
                </div>
                <div class="col text-center">
                    <p style="font-size:30px; text-align:center;" class="badge">
                        @if(session('with_driver'))
                            Rp.{{number_format($d->rent_price+$d->driver_price,2,',','.');}}/Day
                        @else
                            Rp.{{number_format($d->rent_price,2,',','.');}}/Day
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </a>
@endforeach
<script>
    @if( session('success'))
        Swal.fire({
            title: "{{ session('success') }}",
            icon: 'success',
            confirmButton: false,
        })
    @endif
    @if( session('error'))
        Swal.fire({
         title: "{{ session('error') }}",
         icon: 'error',
         confirmButton: false,
        })
    @endif    
</script>
@endsection
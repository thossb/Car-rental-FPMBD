@extends('layouts.user_main')

@section('content')

<div class="head  row">
    <div class="col">
        <p style="margin-left:100px;">Booking History</p>
    </div>
    <div class="col">

    </div>
    <div class="col">
        <div class="container mt-1">
            <a href="{{ route('search_car') }}" class="btn btn-primary"> Search Car </a>
            <a href="{{ route('customer.logout') }}" class="btn btn-primary"> Logout </a>
        </div>
    </div>
</div>
@foreach($data as $d)
<a href="{{ route('payment_receipt',$d->id) }}" style="text-decoration:none;color:black;">
<div class="container bg-grey" style="margin-top:20px;">
    <div class="row">
        <div class="col-4 form-booking2">
            <div class="row" style="border-radius:10px; padding-top:20px; color:white;">
                <div class="col">
                    <p style="font-weight:900; text-align:right; ">Transaction ID</p>
                </div>
                <div class="col">
                    <p class="font-bold" style="font-size:30px;">{{$d->id}}</p>
                </div>
            </div>
        </div>
        <div class="col"> 
            <h1 style="font-weight:900; text-align:right; margin-right:50px; margin-top:40px">Total Price</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row" style="border-radius:10px; padding-top:20px;">
                <div class="col">
                    <p style="font-weight:900; font-size:25px; text-align:center; ">{{$d->vehicle_name}}</p>
                    <p style="font-weight:900; font-size:25px; text-align:center; ">{{$d->booking_date}}</p>
                </div>
                <div class="col" style="text-align:right; margin-right:50px;">

                    @if($d->fine !== 0)
                    <h1 class="price-font">Rp.{{number_format($d->booking_amount+$d->fine,2,',','.');}}</h1>
                    <h1 class="price-font">(Fine : Rp.{{number_format($d->fine,2,',','.');}})</h1>
                    @else
                    <h1 class="price-font">Rp.{{number_format($d->booking_amount,2,',','.');}}</h1>
                    @endif
                </div>
            </div>
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
@extends('layouts.user_main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-5">
            <p style="font-size:50px; font-weight:900;">ONG CAR RENTAL</p>
            <div class="mt-5">
                <h3 style="font-size:30px; font-weight:900;">Hello,</h3>
                <h3 style="font-size:30px; font-weight:900;">Looking to save more on you rental car?</h3>
            </div>
            <div class="mt-4">
                <hr style="height:10px; background-color:#2D325C; width:300px;">
            </div>
            <div class="mt-2" style="color:#666666;">
                <h5 style="font-size:20px; font-weight:900;">Discover Ong Car Rental options in Surabaya, Denpasar, and Jakarta.</h5>
                <h5 style="font-size:20px; font-weight:900;">Select From a range of car options and get a special deals!</h5>
            </div>
            <div class="mt-2">
                <a href="{{ route('register_custom') }}" class="btn btn-main" style="padding:10px 30px 10px 30px; margin-top:20px; margin-right:20px;">Register</a>
            </div>
        </div>
        <div class="col mt-5">
            <img src={{ asset("image/jeep.png" ) }} alt="Foto Image" width="600px">
        </div>
        <div class="col"></div>
    </div>
</div>
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
@extends('layouts.main_front')

@section('content')
<div class="container main-color text-center margin-top">
    <h2 class="font-one">ONG CAR RENTAL</h2>
    <h3>WELCOME BACK!</h3>
    <p class="font-two">Please Enter Your Personal Data Info Down Below!</p>
</div>
<div class="container" style="width:415px; color:white !important;">
    <form action="{{ route('action_register') }}" method="POST">
        @csrf
        <div class="form-grup">
            <label for="">Full-name</label>
            <input type="text" name="full_name" class="form-display form-control" placeholder="Enter Your full name based on ID card" required>
        </div>
        <div class="row mt-2">
            <label for="">Identity Number</label>
            <div class="col">
                <input type="number" name="identity_number" class="form-display form-control" placeholder="Enter Your identity number based on ID card" required>
            </div>
            <div class="col">
                <select name="gender" id="" class="form-display form-control" required>
                    <option value="M">Man</option>
                    <option value="W">Woman</option>
                </select>
            </div>
        </div>
        <div class="row mt-2">
            
            <div class="col">
                <label for="">Address</label>
                <textarea type="text" name="address" class="form-display form-control" placeholder="Enter Your Address based on ID card" required></textarea>
            </div>
            <div class="col">
                <label for="">Phone Number</label>
                <input type="number" style="height:45px;" name="phone_number" class="form-display form-control" placeholder="Enter Your Phone Number" required>
            </div>

        </div>
        <div class="row mt-2">
            <div class="col">
                <label for="">Email</label>
                <input type="email" style="height:45px;" name="email" class="form-display form-control" placeholder="email" required>
            </div>
            <div class="col">
                <label for="">Password</label>
                <input type="password" style="height:45px;" name="password" class="form-display form-control" placeholder="password" required>
            </div>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="form-control button-color">Register</button>
            <a href="{{ route('customer.login') }}" type="submit" class="btn btn-secondary form-control">Login</a>
        </div>
    </form>
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
@extends('layouts.main_front')

@section('content')
<div class="container main-color text-center margin-top">
    <h2 class="font-one">ONG CAR RENTAL</h2>
    <h3>WELCOME BACK!</h3>
    <p class="font-two">Please Login First</p>
</div>
<div class="container" style="width:415px; color:white !important;">
    <form action="{{ route('customer.post.login') }}" method="POST">
        @csrf
        <div class="row mt-2">
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" style="height:45px;" name="email" class="form-display form-control" placeholder="email" required>
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" style="height:45px;" name="password" class="form-display form-control" placeholder="password" required>
            </div>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="form-control button-color">Login</button>
            <a href="{{ route('register_custom') }}" type="submit" class="btn btn-secondary form-control">Register</a>
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
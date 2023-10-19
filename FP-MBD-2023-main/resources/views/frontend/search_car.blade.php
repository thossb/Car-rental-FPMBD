@extends('layouts.main_front')

@section('content')
<div class="container main-color text-center margin-top">
    <h1 class="font-one">ONG CAR RENTAL</h1>
</div>
<div class="container" style="width:415px;">
    <div class="row text-center mb-2">
        <div class="col">
            <button class="form-control button-color" id="with_driver" style="height:50px; font-size:15px;">
                With Driver
            </button>
        </div>
        <div class="col">
            <button class="form-control button-color-non" id="without_driver"  style="height:50px; font-size:15px;">
                Without Driver
            </button>
        </div>
    </div>
    <form action="{{ route('searching_car') }}" method="POST" class="white" style="visibility:visible;" id="form_1">
        @csrf
        <input type="hidden" name="with_driver" value="true">
        <div class="form-grup">
            <label for="" style="font-size:10px;">Rental Branch Location</label>
            <select name="branch" class="form-display form-control" id="">
                <option value="">Select Branch Location</option>
                @foreach($data_branch as $db)
                    <option value="{{ $db->id }}">{{ $db->location }}</option>
                @endforeach
           </select>
        </div>
        <div class="row mt-2">
            <div class="col">
                <label for="" style="font-size:10px;">Pick Up Date</label>
                <input type="date" name="pickup_date" class="form-display form-control" placeholder="Enter Pick Up Date">
            </div>
            <div class="col">
                <label for="" style="font-size:10px;">Duration</label>
                <input type="number" name="duration" class="form-display form-control" placeholder="Enter Duration">
            </div>
        </div>
        <div class="form-grup">
            <label for="" style="font-size:10px;">Pick Up Time</label>
           <input type="time" name="pickup_time" class="form-display form-control" placeholder="enter pickup time">
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="form-control button-color">Search Car</button>
        </div>
    </form>
    <form action="{{ route('searching_car') }}" class="white" method="POST" style="display:none;" id="form_2">
        @csrf
        <div class="form-grup">
            <label for="" style="font-size:10px;">Rental Branch Location</label>
            <select name="branch" class="form-display form-control" id="">
                <option value="">Select Branch Location</option>
                @foreach($data_branch as $db)
                    <option value="{{ $db->id }}">{{ $db->location }}</option>
                @endforeach
           </select>
        </div>
        <div class="form-group">
            <label for="" style="font-size:10px;">Pick Up Date & Time</label>
            <input type="date" name="pickup_date" class="form-display form-control" placeholder="Enter Pick Up Date">
        </div>
        <div class="form-group">
            <label for="" style="font-size:10px;">Drop-off Date & Time</label>
            <input type="date" name="drop_off" class="form-display form-control" placeholder="Enter Pick Up Date">
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="form-control button-color">Search Car</button>
        </div>
    </form>
</div>

<script>
    $( document ).ready(function() {
        $('#with_driver').on('click',function(){
            $('#form_1').show();
            $('#form_2').hide();
        })
        $('#without_driver').on('click',function(){
            $('#form_1').hide();
            $('#form_2').show();
        })
    });

</script>
@endsection
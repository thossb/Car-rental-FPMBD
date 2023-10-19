@extends('layouts.main')

@section('content')
    <div class="container"> 
        {{-- <div class="row">
            <div class="col"><h1>Daftar Booking</h1></div>
            <div class="col" style="text-align:right;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFine">Add Data</button>
            </div>
        </div> --}}
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>Client Name</th>
                    <th>Booking Date</th>
                    <th>Booking Amount</th>
                    <th>Vehicle Name</th>
                    <th>Fine</th>
                    <th>Action</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d )
                <tr>
                    <td>{{ $d->client_name }}</td>
                    <td>{{ $d->booking_date }}</td>
                    <td>{{ $d->booking_amount }}</td>
                    <td>{{ $d->vehicle_name }}</td>
                    <td>{{ $d->fine }}</td>
                    <td>
                        <button data-id="{{$d->id}}" class="btn btn-warning text-white addFine" >
                            Update Fine
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

      <div class="modal fade" id="addFine" tabindex="-1" role="dialog" aria-labelledby="addFineLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addFineLabel">Add Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('admin.booking.addFine')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_booking" name="id_booking">
                    <div class="form-group">
                        <label for="">Add Fine</label>
                        <input type="number" name="fine" id="fine" class="form-control" placeholder="Add Fine">
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Branch</label>
                        <select name="branch_id" id="branch_id" class="form-control" required>
                            <option value="">Select Branch</option>
                            @foreach($branch as $b)
                                <option value="{{ $b->id }}"> {{ $b->location }} </option>
                            @endforeach
                        </select>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
        </div>
      </div>

      <script>
        let table = new DataTable('#table');

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

            $('.delete').on('click',function(e){
                e.preventDefault();
                let url = $(this).data('url');
                Swal.fire({
                    title: 'HAPUS DATA ?',
                    icon: 'warning',
                    iconColor: "#FD7600",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if(result.isConfirmed){
                        location.href = url;
                    }
                })
            })

            $('.addFine').on('click',function(e){
                let id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.booking.getDetail') }}",
                    data: {id:id, "_token": $('#token').val()},
                    success: function (data) {
                        $('#id_booking').val(id);
                        $('#fine').val(data.booking.fine);
                        $('#addFine').modal('toggle');
                    }         
                });
            })
      </script>
@endsection
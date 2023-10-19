@extends('layouts.main')

@section('content')
    <div class="container"> 
        <div class="row">
            <div class="col"><h1>Daftar Driver</h1></div>
            <div class="col" style="text-align:right;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addData">Add Data</button>
            </div>
        </div>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Commission</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d )
                <tr>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->age }}</td>
                    <td>{{ $d->phone_number }}</td>
                    <td>{{ $d->address }}</td>
                    <td>{{ $d->commission }}</td>
                    <td>
                        <button data-url="{{route('admin.driver.destroy',$d->id)}}" class="btn btn-danger text-white delete" >
                            Delete
                        </button>
                        <button data-id="{{$d->id}}" class="btn btn-warning text-white edit" >
                            Update
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
            <form action="{{route('admin.driver.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Driver Name">
                    </div>
                    <div class="form-group">
                        <label for="">Age</label>
                        <input type="number" name="age" class="form-control" placeholder="Driver Age">
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="number" name="phone_number" class="form-control" placeholder="Driver Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <label for="">Commission</label>
                        <input type="number" name="commission" class="form-control" placeholder="Commission">
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

      <div class="modal fade" id="updateData" tabindex="-1" role="dialog" aria-labelledby="updateDataLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="updateDataLabel">Add Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('admin.driver.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_driver" name="id_driver">
                    <div class="form-group">
                        <label for="">Plate Number</label>
                        <input type="text" name="plate_number" id="plate_number" class="form-control" placeholder="Plate Number">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Driver Name">
                    </div>
                    <div class="form-group">
                        <label for="">Age</label>
                        <input type="text" name="type" id="type" class="form-control" placeholder="Driver Age">
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="number" id="phone_number" name="phone_number" class="form-control" placeholder="Driver Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <label for="">Commission</label>
                        <input type="number" name="commission" id="comission" class="form-control" placeholder="Commission">
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

            $('.edit').on('click',function(e){
                let id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.driver.getDetail') }}",
                    data: {id:id, "_token": $('#token').val()},
                    success: function (data) {
                        console.log(data);
                        $("#id_driver").val(data.driver.id);
                        $('#name').val(data.driver.name);
                        $('#age').val(data.driver.age);
                        $('#phone_number').val(data.driver.phone_number);
                        $('#address').val(data.driver.address);
                        $('#commission').val(data.driver.commission);
                        $('#updateData').modal('toggle');
                    }         
                });
            })
      </script>
@endsection
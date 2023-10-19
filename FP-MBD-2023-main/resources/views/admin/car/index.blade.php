@extends('layouts.main')

@section('content')
    <div class="container"> 
        <div class="row">
            <div class="col"><h1>Daftar Mobil</h1></div>
            <div class="col" style="text-align:right;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addData">Add Data</button>
            </div>
        </div>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>Plate Number</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Capacities</th>
                    <th>Rent Price</th>
                    <th>Driver Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d )
                <tr>
                    <td>{{ $d->plate_number }}</td>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->type }}</td>
                    <td>{{ $d->capacities }}</td>
                    <td>{{ $d->rent_price }}</td>
                    <td>{{ $d->driver_price }}</td>
                    <td>
                        @if($d->image)
                        <img src={{ asset("vehicle/image/" . $d->image ) }} alt="Foto Image" width="100px">
                        @endif</td>
                    <td>
                        <button data-url="{{route('admin.car.destroy',$d->id)}}" class="btn btn-danger text-white delete" >
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
            <form action="{{route('admin.car.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Plate Number</label>
                        <input type="text" name="plate_number" class="form-control" placeholder="Plate Number">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Vehicle Name">
                    </div>
                    <div class="form-group">
                        <label for="">Type</label>
                        <input type="text" name="type" class="form-control" placeholder="Vehicle Type">
                    </div>
                    <div class="form-group">
                        <label for="">Capacities</label>
                        <input type="text" name="capacities" class="form-control" placeholder="Capacities">
                    </div>
                    <div class="form-group">
                        <label for="">Rent Price</label>
                        <input type="number" name="rent_price" class="form-control" placeholder="Rent Price">
                    </div>
                    <div class="form-group">
                        <label for="">Driver Price</label>
                        <input type="number" name="driver_price" class="form-control" placeholder="Driver Price">
                    </div>
                    <div class="form-group">
                        <label for="">Registration</label>
                        <input type="text" name="registration" class="form-control" placeholder="Registration">
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" class="form-control" placeholder="Image">
                    </div>
                    <div class="form-group">
                        <label for="">Branch</label>
                        <select name="branch_id" id="" class="form-control" required>
                            <option value="">Select Branch</option>
                            @foreach($branch as $b)
                                <option value="{{ $b->id }}"> {{ $b->location }} </option>
                            @endforeach
                        </select>
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
            <form action="{{route('admin.car.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_vehicle" name="id_vehicle">
                    <div class="form-group">
                        <label for="">Plate Number</label>
                        <input type="text" name="plate_number" id="plate_number" class="form-control" placeholder="Plate Number">
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Vehicle Name">
                    </div>
                    <div class="form-group">
                        <label for="">Type</label>
                        <input type="text" name="type" id="type" class="form-control" placeholder="Vehicle Type">
                    </div>
                    <div class="form-group">
                        <label for="">Capacities</label>
                        <input type="text" name="capacities" id="capacities" class="form-control" placeholder="Capacities">
                    </div>
                    <div class="form-group">
                        <label for="">Rent Price</label>
                        <input type="number" name="rent_price" id="rent_price" class="form-control" placeholder="Rent Price">
                    </div>
                    <div class="form-group">
                        <label for="">Driver Price</label>
                        <input type="number" name="driver_price" id="drive_price" class="form-control" placeholder="Driver Price">
                    </div>
                    <div class="form-group">
                        <label for="">Registration</label>
                        <input type="text" name="registration"  id="registration" class="form-control" placeholder="Registration">
                    </div>
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="image" id="image" class="form-control" placeholder="Image">
                    </div>
                    <div class="form-group">
                        <label for="">Branch</label>
                        <select name="branch_id" id="branch_id" class="form-control" required>
                            <option value="">Select Branch</option>
                            @foreach($branch as $b)
                                <option value="{{ $b->id }}"> {{ $b->location }} </option>
                            @endforeach
                        </select>
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
                    url: "{{ route('admin.car.getDetail') }}",
                    data: {id:id, "_token": $('#token').val()},
                    success: function (data) {
                        console.log(data);
                        $("#id_vehicle").val(data.vehicle.id);
                        $('#name').val(data.vehicle.name);
                        $('#plate_number').val(data.vehicle.plate_number);
                        $('#type').val(data.vehicle.type);
                        $('#capacities').val(data.vehicle.capacities);
                        $('#rent_price').val(data.vehicle.rent_price);
                        $('#drive_price').val(data.vehicle.drive_price);
                        $('#registration').val(data.vehicle.registration);
                        $('#branch_id').val(data.vehicle.branch_id);
                        $('#updateData').modal('toggle');
                    }         
                });
            })
      </script>
@endsection
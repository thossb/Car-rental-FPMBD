@extends('layouts.main')

@section('content')
    <div class="container"> 
        <div class="row">
            <div class="col"><h1>Branch</h1></div>
            <div class="col" style="text-align:right;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addData">Add Data</button>
            </div>
        </div>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <table class="table" id="table">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d )
                <tr>
                    <td>{{ $d->location }}</td>
                    <td>
                        <button data-url="{{route('admin.branch.destroy',$d->id)}}" class="btn btn-danger text-white delete" >
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
            <form action="{{route('admin.branch.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Location</label>
                        <textarea name="location" class="form-control" placeholder="Location"> </textarea>
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
            <form action="{{route('admin.branch.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_branch" name="id_branch">
                    <div class="form-group">
                        <label for="">Location</label>
                        <textarea name="location" id="location" class="form-control" placeholder="Location"> </textarea>
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
                    url: "{{ route('admin.branch.getDetail') }}",
                    data: {id:id, "_token": $('#token').val()},
                    success: function (data) {
                        console.log(data);
                        $("#id_branch").val(data.branch.id);
                        $("#location").val(data.branch.location);
                        $('#updateData').modal('toggle');
                    }         
                });
            })
      </script>
@endsection
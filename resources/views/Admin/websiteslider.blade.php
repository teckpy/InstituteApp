@extends('layouts.Admin.app')
@section('title')
   Create Slider Image
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Slider</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#modal-image">
                                        New
                                    </button>
                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-fit">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 10px">S.N</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Created_at</th>
                                            <th>Updated_at</th>
                                            <th>Publish</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($slider) > 0)
                                            @foreach ($slider as $item)
                                                <tr class="text-center">
                                                    <td> {{ $item->id }}</td>
                                                    <td> {{ $item->title }}</td>
                                                    <td class="text-center">
                                                        <img src="{{ $item->image }}" alt="" width="40px"
                                                            height="40px">
                                                    </td>
                                                    <td> {{ $item->created_at }}</td>
                                                    <td> {{ $item->updated_at }}</td>
                                                    <td class="text-center">
                                                        @if ($item->status == 0)
                                                            <span class="badge badge-danger"><a href="{{ route('publish', $item->id) }}"
                                                                    data-id="{{ $item->id }}" class="text-white publish"><i
                                                                        class="fa fa-close"></i></a></span>
                                                        @else
                                                            <span class="badge badge-success"><a
                                                                    data-id="{{ $item->id }}" href="{{ route('unpublish', $item->id) }}"
                                                                    class="text-white unpublish"><i class="fa fa-check"></i></a></span>
                                                        @endif
                                                    </td>
                                                    <td><span class="badge bg-warning">
                                                            <a class="editSlide" href="javascript:void(0);"
                                                                data-toggle="modal" data-target="#modal-editSlide"
                                                                data-id="{{ $item->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a></span>
                                                        <span class="badge bg-danger"> <a class="image_delete"
                                                                data-toggle="modal" data-target="#modal-delete"
                                                                data-id="{{ $item->id }}" href="javascript:void(0);"> <i
                                                                    class="fas fa-trash-alt"></i></a></span>


                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-image">
        <div class="modal-dialog">
            <form id="addimage" action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Slider</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Enter Slider Title"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Record</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteimage" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Are you sure you want to delete this Record !</p>
                            <input type="hidden" name="id" id="delete_image_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $("#addimage").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('image.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false, // Set cache to false for file uploads
                    success: function(data) {
                        location.reload(true);
                        $("#modal-image").modal("hide");
                        setTimeout(function() {
                            // Your additional logic after success
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

            });

            $('.image_delete').click(function() {

                var id = $(this).data('id');
                $('#delete_image_id').val(id);
            });

            $('#deleteimage').submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                var id = $("#delete_image_id").val();
                var url = '{{ url('image') }}/' + id;

                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success == true) {
                            console.log('Slide deleted successfully:', data);
                            location.reload(true);
                            $("#modal-delete").modal("hide");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection

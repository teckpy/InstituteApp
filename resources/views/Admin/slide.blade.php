@extends('layouts.Admin.app')
@section('title')
    Admin | Dashboard
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#modal-add">
                                        <i class="fas fa-plus">&nbsp; New
                                    </button>
                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @if (count($data) > 0)
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>
                                                        <img width="50" height="40" src="{{ $item->image }}"
                                                            alt="">
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($item->status == 0)
                                                            <span class="badge badge-danger"><i
                                                                    class="fas fa-cross"></i></span>
                                                        @else
                                                            <span class="badge badge-success"><i
                                                                    class="fas fa-check"></i></span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{ $item->updated_at }}</td>
                                                    <td class="text-center">
                                                        <span class="badge badge-warning"><a href=""><i
                                                                    class="fa fa-edit"></i></a></span>
                                                        <span class="badge badge-danger"><a href=""
                                                                class="delete_slide" data-id="{{ $item->id }}"
                                                                data-toggle="modal" data-target="#modal-delete"><i
                                                                    class="fa fa-trash"></i></a></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <p>record not found</p>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <section class="col-lg-7 connectedSortable">
                    </section>
                    <section class="col-lg-5 connectedSortable">
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <form id="addslide" enctype="multipart/form-data" action="{{ route('image.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Slide</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Enter image title"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /Edit .modal-dialog -->
    </div>
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <form id="deleteslide" action="javascript:void(0);" method="DELETE">
                @method('DELETE')
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Are you sure you want to delete !</p>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="delete_slide_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /Edit .modal-dialog -->
    </div>
    <script>
        $(document).ready(function() {
            $("#addslide").submit(function(e) {
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
                        $("#modal-add").modal("hide");
                        setTimeout(function() {
                            // Your additional logic after success
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
            //delete
            $(".delete_slide").click(function() {
                var id = $(this).data('id');
                $("#delete_slide_id").val(id);

                console.log(id);
            });

            $(".delete_slide").click(function() {
                var id = $(this).data('id');
                $("#delete_slide_id").val(id);
            });

            $("#deleteslide").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                var id = $("#delete_slide_id").val();

                // Use the url helper to generate the URL with the correct parameter
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

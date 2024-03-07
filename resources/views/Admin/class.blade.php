@extends('layouts.Admin.app')
@section('title')
    Classes
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Classes</li>
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
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#modal-add">
                                        New
                                    </button>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-fit">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Age Group</th>
                                            <th>Seat</th>
                                            <th>Timing</th>
                                            <th>Fee</th>
                                            <th>Image</th>
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
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->students_age }}</td>
                                                    <td>{{ $item->total_seat }}</td>
                                                    <td>{{ $item->class_time }}</td>
                                                    <td>{{ $item->tution_fee }}</td>
                                                    <td>
                                                        <img width="50" height="40" src="{{ $item->image }}"
                                                            alt="">
                                                    </td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>{{ $item->updated_at }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-warning"><a href=""><i
                                                                    class="fa fa-edit"></i></a></span>
                                                        <span class="badge bg-danger"><a href="" class="delete_class"
                                                                data-id="{{ $item->id }}" data-toggle="modal"
                                                                data-target="#modal-delete"><i
                                                                    class="fa fa-trash"></i></a></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <p>record not found</p>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
            <form id="addclass" enctype="multipart/form-data" action="{{ route('classes.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Class</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Enter Class Name"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="description" placeholder="Description" multiple
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="students_age" placeholder="Enter Age Group"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="total_seat" placeholder="Total Seat" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="class_time" placeholder="Enter Class Timing"
                                required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="tution_fee" placeholder="Tution Fee" required>
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
            <form id="deleteclass" action="javascript:void(0);">
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
                            <input type="hidden" id="delete_class_id">
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
            $("#addclass").submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('classes.store') }}",
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


            $(".delete_class").click(function() {
                var id = $(this).data('id');
                $("#delete_class_id").val(id);
            });

            $("#deleteclass").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                var id = $("#delete_class_id").val();

                // Use the url helper to generate the URL with the correct parameter
                var url = '{{ url('classes') }}/' + id;

                $.ajax({
                    url: url,
                    type: "POST",
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

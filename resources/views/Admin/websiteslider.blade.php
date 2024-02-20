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
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modal-slider">
                                        New
                                    </button>
                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-fit">
                                    <thead>
                                        <tr>
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
                                                <tr>
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
                                                            <span class="badge badge-danger"><i
                                                                    class="fa fa-close"></i></span>
                                                        @else
                                                            <span class="badge badge-success"><i
                                                                    class="fa fa-check"></i></span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="" data-id="{{ $item->id }}"> <span
                                                                class="badge badge-info"><i
                                                                    class="fa fa-newspaper"></i></span></a>
                                                        <a href="" data-id="{{ $item->id }}"> <span
                                                                class="badge badge-warning"><i
                                                                    class="fa fa-edit"></i></span></a>
                                                        <a href="" id="removeslider" data-id="{{ $item->id }}"
                                                            data-toggle="modal" data-target="#modal-delete"> <span
                                                                class="badge badge-danger"><i
                                                                    class="fa fa-trash"></i></span></a>
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
    <div class="modal fade" id="modal-slider">
        <div class="modal-dialog">
            <form id="NewSlider" action="{{ route('Slider.store') }}" method="POST">
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
                            <input type="text" class="form-control" id="" name="title"
                                placeholder="Enter Slider Title" required>
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
                <form id="DeleteSliderSubmit" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Are you sure you want to delete this Record !</p>
                            <input type="hidden" name="id" id="delete_slider_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        $(document).ready(function() {

            $("#NewSlider").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('Slider.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {

                        $("#modal-slider").modal("hide");
                        setTimeout(function() {}, 1000);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // delete slider
            $("#removeslider").click(function(e) {
                e.preventDefault();

                var Slider_id = $(this).attr("data-id");
                $("#delete_slider_id").val(Slider_id);

                console.log(Slider_id);
                var id = $("#delete_slider_id").val();
                var = url.replace('id', id);
                url = '{{ route('Slider.destroy', 'id') }}';
                console.log(url);

            });

        });
    </script>
@endsection

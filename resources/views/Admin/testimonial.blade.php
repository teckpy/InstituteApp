@extends('layouts.Admin.app')
@section('title')
    Testimonial
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
                            <li class="breadcrumb-item active">Testimonial</li>
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
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#modal-linkadd">
                                        New
                                    </button>
                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-fit">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 10px">S.N</th>
                                            <th>Name</th>
                                            <th>Link</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @if (count($link) > 0)
                                            @foreach ($link as $item)
                                                <tr class="text-left">
                                                    <td> {{ $item->id }}</td>
                                                    <td> {{ $item->name }}</td>
                                                    <td> {{ $item->link }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><span class="badge bg-warning">
                                                            <a class="editlink" href="javascript:void(0);"
                                                                data-toggle="modal" data-target="#modal-link"
                                                                data-id="{{ $item->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a></span>


                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modal-linkadd">
        <div class="modal-dialog">
            <form id="link" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Newsletter</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="" cols="30" rows="2" class="form-control"
                                placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="file">
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
    <div class="modal fade" id="modal-link">
        <div class="modal-dialog">
            <form id="linkedit" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Annauncement</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name_" name="name"
                                placeholder="Social Name">
                            <input type="hidden" name="" id="id">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="link_" name="link" placeholder="Link">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- <script>
        $(document).ready(function() {

            $("#link").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('linkstore') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        location.reload(true);
                        $("#modal-linkadd").modal("hide");
                        setTimeout(function() {

                        }, 1000);
                        // Refresh the page or update the table with the new item
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });


            $(".editlink").click(function(e) {
                e.preventDefault();

                var id = $(this).data("id");
                $("#id").val(id);

                var url = '{{ route('linkedit', 'id') }}';
                url = url.replace('id', id);
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(data) {
                        if (data.success == true) {
                            var contact = data.data;
                            $("#id").val(contact[0].id);
                            $("#name_").val(contact[0].email);
                            $("#link_").val(contact[0].mobile);

                        } else {
                            alert(data.msg);
                        }
                    },

                });
            });

            $("#editlink").submit(function(e) {
                e.preventDefault();

                var id = $("#id").val();
                var url = '{{ route('linkupdate', 'id') }}';
                url = url.replace('id', id);

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {

                        _token: $('input[name="_token"]').val(),
                        email: $("#name").val(),
                        mobile: $("#link_").val(),


                    },
                    success: function(data) {
                        if (data.success == true) {
                            location.reload(true);
                            $('#modal-contact').modal('hide');
                        } else {
                            alert(data.msg);
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script> --}}
@endsection

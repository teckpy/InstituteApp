@extends('layouts.Admin.app')
@section('title')
    Contact
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
                            <li class="breadcrumb-item active">Contact</li>
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

                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-fit">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 10px">S.N</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($contact) > 0)
                                            @foreach ($contact as $item)
                                                <tr class="text-left">
                                                    <td> {{ $item->id }}</td>
                                                    <td> {{ $item->address }}</td>
                                                    <td> {{ $item->email }}</td>
                                                    <td class="w-25"> {{ $item->mobile }}</td>
                                                    <td></td>

                                                    <td><span class="badge bg-warning">
                                                            <a class="editSlide" href="javascript:void(0);"
                                                                data-toggle="modal" data-target="#modal-contact"
                                                                data-id="{{ $item->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a></span>


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
    <div class="modal fade" id="modal-contact">
        <div class="modal-dialog">
            <form id="contactedit" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Contact</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email_" name="email" placeholder="Email">
                            <input type="hidden" name="" id="id">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="mobile_" name="mobile" placeholder="Mobile">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="address" id="address_" placeholder="Address" cols="30" rows="3"></textarea>
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

    <script>
        $(document).ready(function() {
            $(".editSlide").click(function(e) {
                e.preventDefault();

                var id = $(this).data("id");

                $("#id").val(id);

                var url = '{{ route('contactedit', 'id') }}';
                url = url.replace('id', id);
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(data) {
                        if (data.success == true) {
                            var contact = data.data;
                            $("#id").val(contact[0].id);
                            $("#email_").val(contact[0].email);
                            $("#mobile_").val(contact[0].mobile);
                            $("#address_").val(contact[0].address);

                        } else {
                            alert(data.msg);
                        }
                    },

                });
            });

            $("#contactedit").submit(function(e) {
                e.preventDefault();

                var id = $("#id").val();
                var url = '{{ route('contactupdate', 'id') }}';
                url = url.replace('id', id);

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {

                        _token: $('input[name="_token"]').val(),
                        email: $("#email_").val(),
                        mobile: $("#mobile_").val(),
                        address: $("#address_").val(),

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
    </script>
@endsection

@extends('Admin.Dashboard')
@section('title')Add Header Content
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subject Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Subject</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modal-subject">
                                        New
                                    </button>
                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->subject}}</td>
                                            <td><span class="badge bg-warning">
                                           <a href="http://"> <i class="fas fa-edit"></i></a></span>
                                           <span class="badge bg-danger"> <a href="http://"> <i class="fas fa-trash-alt"></i></a></span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- subject model --}}
    <div class="modal fade" id="modal-subject">
        <div class="modal-dialog">
            <form id="addSubject">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Subject</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject_name" name="subject"
                                placeholder="Enter Subject Name">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        $(document).ready(function() {

            $("#addSubject").submit(function(e) {
                e.preventDefault();

                var  formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('subjectstore') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if(data.success == true)
                        {
                            location.reload();
                        }
                        else
                        {
                            alert(data.msg);
                        }
                    }
                });
            });
        });
    </script>
@endsection

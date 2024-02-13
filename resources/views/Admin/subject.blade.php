@extends('Admin.Dashboard')
@section('title')Add Subjects
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
                            <li class="breadcrumb-item active">Subject</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
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
                                        @if (count($subjects) > 0)
                                        @foreach ($subjects as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->subject }}</td>
                                            <td><span class="badge bg-warning">
                                                    <a class="editSubjectbutton" href="javascript:void(0);"
                                                        data-toggle="modal" data-target="#modal-editsubject"
                                                        data-id="{{ $item->id }}"
                                                        data-subject="{{ $item->subject }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a></span>
                                                <span class="badge bg-danger"> <a class="deleteSubject"
                                                    data-toggle="modal" data-target="#modal-delete"
                                                        data-id="{{ $item->id }}" href="#"> <i
                                                            class="fas fa-trash-alt"></i></a></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4"> Subject Data Not Found !</td>
                                            </tr>
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
    {{-- Add subject model --}}
    <div class="modal fade" id="modal-subject">
        <div class="modal-dialog">
            <form id="addSubject" action="{{ route('Subject.store') }}" method="POST">
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
                            <input type="text" class="form-control" id="" name="subject"
                                placeholder="Enter Subject Name" required>
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
    <div class="modal fade" id="modal-editsubject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Subject</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editSubjectForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="edit_subject" name="subject" required>
                            <input type="hidden" id="edit_subject_id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Subject</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deletesubject">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <p>Are you sure you want to delete this Subject !</p>
                        <input type="hidden" name="id" id="delete_subject_id">
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

            $("#addSubject").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('Subject.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        $("#modal-subject").modal("hide");
                        setTimeout(function() {

                        }, 1000);
                        // Refresh the page or update the table with the new item
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            //edit
            $(".editSubjectbutton").click(function(e) {
                e.preventDefault();

                var subject_id = $(this).data("id");
                var subject = $(this).data("subject");
                $("#edit_subject").val(subject);
                $("#edit_subject_id").val(subject_id);
            });

            $("#editSubjectForm").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('editSubject') }}",
                    method: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {

                        } else {
                            alert(data.msg);
                        }
                    },

                });
            });

            //delete

            $(".deleteSubject").click(function(e) {
                e.preventDefault();

                var subject_id = $(this).data("id");

                $("#delete_subject_id").val(subject_id);
            });
            $("#deletesubject").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "{{ route('deleteSubject') }}",
                    method: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {

                        } else {
                            alert(data.msg);
                        }
                    },

                });
            });
        });
    </script>
@endsection

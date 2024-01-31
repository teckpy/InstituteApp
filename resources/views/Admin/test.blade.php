@extends('Admin.Dashboard')
@section('title')Add Header Content
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Test Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Test</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modal-test">
                                        New
                                    </button>
                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Test</th>
                                            <th>Subject</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tests as $test)
                                            <tr>
                                                <td>{{ $test->id }}</td>
                                                <td>{{ $test->name }}</td>
                                                <td>{{ $test->subject[0]['subject'] }}</td>
                                                <td>{{ $test->date }}</td>
                                                <td>{{ $test->time }}</td>
                                                <td><span class="badge bg-warning">
                                                        <a class="editSubjectbutton" href="javascript:void(0);"
                                                            data-toggle="modal" data-target="#modal-editsubject"
                                                            data-id="{{ $test->id }}"
                                                            data-subject="{{ $test->subject }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a></span>
                                                    <span class="badge bg-danger"> <a class="deleteSubject"
                                                        data-toggle="modal" data-target="#modal-delete"
                                                            data-id="{{ $test->id }}" href="#"> <i
                                                                class="fas fa-trash-alt"></i></a></span>
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
    {{-- Add subject model --}}
    <div class="modal fade" id="modal-test">
        <div class="modal-dialog">
            <form id="addtest" action="{{ route('Test.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Test</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="" name="name"
                                placeholder="Enter Test Name">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="subject_id" required  id="">
                                <option  value="">Select Subject</option>
                                @if (count($subjects) > 0)
                                    @foreach ($subjects as $subject )
                                        <option value="{{$subject->id}}">{{$subject->subject}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" id="" name="date" required min="@php echo date('Y,m,d'); @endphp">
                        </div>
                        <div class="form-group">
                            <input type="time" class="form-control" id="" name="time" required >
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
                            <input type="text" class="form-control" id="edit_subject" name="subject">
                            <input type="hidden" id="edit_subject_id" name="id">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
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
                <div class="modal-footer justify-content-between">
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

            $("#addtest").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('Test.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        $("#modal-test").modal("hide");
                        setTimeout(function() {
                            location.reload();
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
                            location.reload();
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
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    },

                });
            });
        });
    </script>
@endsection

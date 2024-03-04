@extends('Admin.Dashboard')
@section('title')
    Add Test
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
                            <li class="breadcrumb-item active">Test</li>
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
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#modal-test">
                                        <i class="fas fa-plus">&nbsp;</i>New
                                    </button>
                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-fit table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Test</th>
                                            <th>Subject</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Attempt</th>
                                            <th>Add</th>
                                            <th>Show</th>
                                            <th>Registration Link</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($tests) > 0)
                                            @foreach ($tests as $test)
                                                <tr>
                                                    <td>{{ $test->id }}</td>
                                                    <td>{{ $test->name }}</td>
                                                    <td>{{ $test->subjects[0]['subject'] }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($test->date)) }}</td>
                                                    <td>{{ $test->time }}</td>
                                                    <td>{{ $test->attempt }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-success">
                                                            <a class="Addquestions" href="javascript:void(0);"
                                                                data-toggle="modal" data-target="#modal-AddAnswer"
                                                                data-id="{{ $test->id }}">
                                                                <i class="fas fa-plus"></i>
                                                            </a></span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-warning">
                                                            <a class="Showquestions" href="javascript:void(0);"
                                                                data-toggle="modal" data-target="#modal-Showanswer"
                                                                data-id="{{ $test->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </a></span>
                                                    </td>
                                                    <td class="text-center"><a href="{{ route('examregistration', ['id' => $test->test_exam_id]) }}"
                                                            target="_blank"><span class="badge badge-info"><i
                                                                    class="fas fa-hand-pointer"></i></span></a></td>

                                                    <td><span class="badge bg-warning">
                                                            <a class="edittestbutton" href="javascript:void(0);"
                                                                data-toggle="modal" data-target="#modal-edittest"
                                                                data-id="{{ $test->id }}"
                                                                data-test="{{ $test->name }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a></span>
                                                        <span class="badge bg-danger"> <a class="deletetest"
                                                                data-toggle="modal" data-target="#modal-delete"
                                                                data-id="{{ $test->id }}" href="#"> <i
                                                                    class="fas fa-trash-alt"></i></a></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4"> Test Data Not Found !</td>
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
                                placeholder="Enter Test Name" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="subject_id" required id="">
                                <option value="">Select Subject</option>
                                @if (count($subjects) > 0)
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="date" required min="{{ date('Y-m-d') }}">

                        </div>
                        <div class="form-group">
                            <input type="text" id="time" name="time"
                                placeholder="Enter Valid Duration Format hh:mm:ss" class="form-control"
                                onblur="validateDuration()">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" min="1"
                                placeholder="Enter Exam Attempt Time" id="" name="attempt" required>
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
    <div class="modal fade" id="modal-edittest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Test</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edittestform" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="edit_test" name="name" required>
                            <input type="hidden" id="edit_test_id" name="id">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="subject_id" required id="subject_id">
                                <option value="">Select Subject</option>
                                @if (count($subjects) > 0)
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" id="date" name="date" required
                                min="@php echo date('Y,m,d'); @endphp">
                        </div>
                        <div class="form-group">
                            <input type="text" id="timeedit" name="time" class="form-control"
                                onblur="validateDuration()">
                        </div>
                        <div class="form-group">
                            <input type="number" min="1" class="form-control" id="attempt" name="attempt"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </form>
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- //dlete --}}
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Test</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deletetest" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Are you sure you want to delete this Test !</p>
                            <input type="hidden" name="id" id="delete_test_id">
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
    {{-- Add Answer model --}}
    <div class="modal fade" id="modal-AddAnswer">
        <div class="modal-dialog">
            <form id="AddQNA">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Question Answers</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="examId" name="examId">
                            <input type="search" name="search" id="search" onkeyup="searchTable()"
                                class="form-control w-100" placeholder="Search here">
                        </div>
                        <div class="form-group">
                            <table class="table" id="questionTable">
                                <thead>
                                    <th>Select</th>
                                    <th>Question</th>
                                </thead>
                                <tbody class="addBody">

                                </tbody>
                            </table>
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
    {{-- Show Question model --}}
    <div class="modal fade" id="modal-Showanswer">
        <div class="modal-dialog">
            <form id="Showqna">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Show Question Answers</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <table class="table">
                                <thead>
                                    <th>S.N</th>
                                    <th>Question</th>
                                </thead>
                                <tbody class="showBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /Edit .modal-dialog -->
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
                        location.reload(true);
                        $("#modal-test").modal("hide");
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
            $(".edittestbutton").click(function(e) {
                e.preventDefault();

                var id = $(this).data("id");

                $("#edit_test_id").val(id);

                var url = '{{ route('Test.edit', 'id') }}';
                url = url.replace('id', id);
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(data) {
                        if (data.success == true) {
                            var test = data.data;
                            $("#edit_test").val(test[0].name);
                            $("#subject_id").val(test[0].subject_id);
                            $("#date").val(test[0].date);
                            $("#timeedit").val(test[0].time);
                            $("#attempt").val(test[0].attempt);
                        } else {
                            alert(data.msg);
                        }
                    },

                });
            });
            //////////////////////////
            $("#edittestform").submit(function(e) {
                e.preventDefault();

                var id = $("#edit_test_id").val();
                var url = '{{ route('Test.update', 'id') }}';
                url = url.replace('id', id);

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        _method: 'PUT', // or 'PATCH'
                        _token: $('input[name="_token"]').val(),
                        name: $("#edit_test").val(),
                        subject_id: $("#subject_id").val(),
                        date: $("#date").val(),
                        time: $("#timeedit").val(),
                        attempt: $("#attempt").val(),
                    },
                    success: function(data) {
                        if (data.success == true) {
                            location.reload(true);
                            $('#modal-edittest').modal('hide');
                        } else {
                            alert(data.msg);
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            //delete
            $(".deletetest").click(function(e) {
                e.preventDefault();

                var test_id = $(this).data("id");

                $("#delete_test_id").val(test_id);
            });
            $("#deletetest").submit(function(e) {
                e.preventDefault();

                var id = $("#delete_test_id").val();
                var url = '{{ route('Test.destroy', 'id') }}';
                url = url.replace('id', id);
                $.ajax({
                    url: url,
                    method: "DELETE",
                    data: {
                        _token: $('input[name="_token"]').val(),
                    },
                    success: function(data) {
                        if (data.success == true) {
                            location.reload(true);
                            $('#modal-delete').modal('hide');
                        } else {
                            alert(data.msg);
                        }
                    },
                });
            });

            // Add question //
            $(".Addquestions").click(function(e) {
                e.preventDefault();

                var id = $(this).attr("data-id");
                $("#examId").val(id);

                $.ajax({
                    url: "{{ route('getQuestion') }}",
                    method: "GET",
                    data: {
                        examId: id
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            var questions = data.data;
                            var html = ``;

                            if (questions.length > 0) {
                                for (let i = 0; i < questions.length; i++) {
                                    html += `
                                    <tr>
                                    <td><input type="checkbox" value="` + questions[i]['id'] + `" name="questions_ids[]"></td>
                                    <td>` + questions[i]['question'] + `</td>
                                    </tr>
                                    `;
                                }
                            } else {
                                html += `
                            <tr>
                            <td colspan="2">Question not found !</td>
                            </tr>
                            `;
                            }
                            $('.addBody').html(html);
                        } else {
                            alert(data.msg);
                        }
                    },
                });

            });


            $("#AddQNA").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('addQuestion') }}",
                    method: "POST",
                    data: formData,
                    success: function(data) {
                        console.log(data);
                        setTimeout(function() {
                            location.reload(true);
                            $('#modal-AddAnswer').modal('hide');
                        }, 1000);
                        // Refresh the page or update the table with the new item
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            ////////////////////////////////////////
            $(".Showquestions").click(function(e) {
                e.preventDefault();

                var id = $(this).attr("data-id");
                $.ajax({
                    url: "{{ route('showQuestion') }}",
                    method: "GET",
                    data: {
                        examId: id
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success == true) {
                            var html = ``;
                            var questions = data.data;
                            if (questions.length > 0) {
                                for (i = 0; i < questions.length; i++) {
                                    html += `
                                    <tr>
                                        <td>` + (i + 1) + `</td>
                                        <td>` + questions[i]['question'][0]['question'] + `</td>
                                    </tr>
                                    `;
                                }
                            } else {
                                html += `
                                    <tr><td colspan="1"> Question not Avilable !</td></tr>
                                    `;
                            }
                            $(".showBody").html(html);


                        } else {
                            alert(data.msg);
                        }
                    }

                });
            });

        });
    </script>
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById('search');
            filter = input.value.toUpperCase();
            table = document.getElementById('questionTable');
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection

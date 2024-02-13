@extends('Admin.Dashboard')
@section('title')
    Add Questionand Answers
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
                            <li class="breadcrumb-item active">Questions</li>
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
                                        data-target="#modal-question">
                                        New
                                    </button>
                                    <span> <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#modal-import">
                                            import
                                        </button></span>
                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered table-fit">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Question</th>
                                            <th>Answers</th>
                                            <th>Created_at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($questions) > 0)
                                            @foreach ($questions as $question)
                                                <tr>
                                                    <td>{{ $question->id }}</td>
                                                    <td>{{ $question->question }}</td>
                                                    <td>
                                                        <a href="" class="ansButton" data-id="{{ $question->id }}"
                                                            data-toggle="modal" data-target="#modal-showAns">SeeAnswer</a>
                                                    </td>
                                                    <td>{{ $question->created_at }}</td>
                                                    <td><span class="badge bg-warning">
                                                            <a class="editquestiontbutton" href="javascript:void(0);"
                                                                data-toggle="modal" data-target="#modal-editqa"
                                                                data-id="{{ $question->id }}"
                                                                data-test="{{ $question->name }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a></span>
                                                        <span class="badge bg-danger"> <a class="deleteQNA"
                                                                data-toggle="modal" data-target="#modal-deleteQ"
                                                                data-id="{{ $question->id }}" href="#"> <i
                                                                    class="fas fa-trash-alt"></i></a></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">Questions 7 Answer Not Found !</td>
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
    <div class="modal fade" id="modal-question">
        <div class="modal-dialog">
            <form id="addquestion" action="" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button id="addAnswer" class="btn btn-info">Add
                            Answer</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h4 class="modal-title">Create New Question</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modalanswer">

                        <div class="form-group">
                            <input type="text" class="form-control" id="" name="question"
                                placeholder="Enter Question" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span style="color: rgb(122, 8, 8)" class="error"></span>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /Edit .modal-dialog -->
    </div>

    {{-- Edit Qustion model --}}
    <div class="modal fade" id="modal-editqa">
        <div class="modal-dialog">
            <form id="editquestion" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button id="addeditAnswer" class="btn btn-info">Add
                            Answer</button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h4 class="modal-title">Update Question & Answers</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body editmodalanswer">

                        <div class="form-group">
                            <input type="hidden" id="question_id" name="question_id">
                            <input type="text" class="form-control" id="question" name="question"
                                placeholder="Enter Question" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <span style="color: rgb(122, 8, 8)" class="editerror"></span>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /Edit .modal-dialog -->
    </div>


    <div class="modal fade" id="modal-showAns">
        <div class="modal-dialog">
            <form id="">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Answers</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Answer</th>
                                <th>Is Correct</th>
                            </thead>
                            <tbody class="showanswers">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer justify-content-between">

                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /Edit .modal-dialog -->
    </div>
    {{-- //dlete --}}
    <div class="modal fade" id="modal-deleteQ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Question & Answers !</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteQA" action="javascript:void(0);">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Are you sure you want to delete this Question & Answers !</p>
                            <input type="hidden" name="id" id="delete_QNA_id">
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
    <div class="modal fade" id="modal-import">
        <div class="modal-dialog">
            <form id="import" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Import New Question and Answers !</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" id="file" name="file"required
                                accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms.excel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Import</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /Edit .modal-dialog -->
    </div>
    <script>
        $(document).ready(function() {



            /////// Add  question answer /////
            $("#addquestion").submit(function(e) {
                e.preventDefault();

                if ($(".answers").length < 2) {
                    $(".error").text("Please add minimum two answers !")
                    setTimeout(function() {
                        $(".error").text("")
                    }, 2000);
                } else {
                    var checkIsCorrect = false;
                    for (let i = 0; i < $(".is_correct").length; i++) {
                        if ($(".is_correct:eq(" + i + ")").prop('checked') == true) {
                            checkIsCorrect = true;
                            $(".is_correct:eq(" + i + ")").val($(".is_correct:eq(" + i + ")").next().find(
                                'input').val());
                        }
                    }
                    if (checkIsCorrect) {
                        var formData = $(this).serialize();

                        $.ajax({
                            url: "{{ route('Question.store') }}",
                            method: "POST",
                            data: formData,
                            success: function(data) {
                                if (data.success == true) {

                                } else {
                                    alert(data.msg);
                                }
                            },

                        });
                    } else {
                        $(".error").text("     Please select anyone correct answers !")
                        setTimeout(function() {
                            $(".error").text("")
                        }, 2000);
                    }

                }
            });


            // add answer //
            $("#addAnswer").click(function(e) {
                e.preventDefault();

                if ($(".answers").length >= 4) {
                    $(".error").text("You can add maximum 6 answers !")
                    setTimeout(function() {
                        $(".error").text("")
                    }, 2000);

                } else {
                    var html = `
                <div class="row answers">
                    <input type="radio" class="is_correct" name="is_correct">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="" name="answers[]"
                                        placeholder="Enter Answer" required>
                                </div>
                            </div>
                           <button class="btn btn-outline-danger btn-sm removeButton"> <i class="fas fa-trash-alt"></i></button>
                        </div>
                `;
                    $(".modalanswer").append(html);
                }
            });


            /////// Remove Answer /////
            $(document).on("click", ".removeButton", function() {
                $(this).parent().remove();
            });

            $(".ansButton").click(function(e) {
                e.preventDefault();
                var questions = @json($questions);

                var qid = $(this).attr('data-id');
                var html = ``;

                for (let i = 0; i < questions.length; i++) {
                    if (questions[i]['id'] == qid) {
                        var answersLength = questions[i]['answers'].length;
                        for (let j = 0; j < answersLength; j++) {
                            let is_correct = questions[i]['answers'][j]['is_correct'] == 1;
                            let badgeClass = is_correct ? 'badge badge-success' : 'badge badge-danger';

                            html +=
                                `
                    <tr>
                        <td>` + (j + 1) + `</td>
                        <td>` + questions[i]['answers'][j]['answer'] + `</td>
                        <td><span class="` + badgeClass + `">` + (is_correct ? 'Yes' : 'No') + `</span></td>
                    </tr>
                `;
                        }
                        break;
                    }
                }

                $(".showanswers").html(html);
            });


            // Add New  answer When update //
            $("#addeditAnswer").click(function(e) {
                e.preventDefault();

                if ($(".editanswers").length >= 4) {
                    $(".editerror").text("You can add maximum 6 answers !")
                    setTimeout(function() {
                        $(".editerror").text("")
                    }, 2000);

                } else {
                    var html = `
                <div class="row editanswers">
                    <input type="radio"  class="edit_is_correct" name="is_correct">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control"  name="new_answers[]"
                                        placeholder="Enter Answer" required>
                                </div>
                            </div>
                           <button class="btn btn-outline-danger btm-sm removeButton removeans"> <i class="fas fa-trash-alt"></i></button>
                        </div>
                `;
                    $(".editmodalanswer").append(html);
                }
            });


            /// edit question and answers ////
            $(".editquestiontbutton").click(function(e) {
                e.preventDefault();

                var id = $(this).data("id");

                var url = '{{ route('Question.edit', 'id') }}';
                url = url.replace('id', id);
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(data) {

                        var qna = data.data[0];
                        $("#question_id").val(qna['id']);
                        $("#question").val(qna['question']);
                        $(".editanswers").remove();

                        var html = ``;
                        for (let i = 0; i < qna['answers'].length; i++) {
                            var checked = '';
                            if (qna['answers'][i]["is_correct"] == 1) {
                                checked = 'checked';
                            }
                            html +=
                                `
                                                <div class="row editanswers">
                                                    <input type="radio" class="edit_is_correct" name="is_correct" ` +
                                checked +
                                `>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"  name="answers[${qna['answers'][i]['id']}]"
                                                            placeholder="Enter Answer" value="${qna['answers'][i]['answer']}" required>
                                                    </div>
                                                </div>
                                            <button class="btn btn-outline-danger btn-sm  removeButton removeans" data-id="` +
                                qna[
                                    'answers'][i][
                                    'id'
                                ] + `"> <i class="fas fa-trash-alt"></i></button>
                                                </div>
                                            `;

                        }
                        $(".editmodalanswer").append(html);

                    }

                });
            });
            /////Remove answers///////
            $(document).on('click', '.removeans', function() {
                var ansId = $(this).attr('data-id');


                $.ajax({
                    url: "{{ route('removeAns') }}",
                    type: "GET",
                    data: {
                        id: ansId
                    },
                    success: function(data) {
                        if (data.success == true) {

                        }
                    }
                });
            });
            /////// update question answer ///////
            $("#editquestion").submit(function(e) {
                e.preventDefault();

                if ($(".editanswers").length < 2) {
                    $(".editerror").text("Please add minimum two answers !")
                    setTimeout(function() {
                        $(".editerror").text("")
                    }, 2000);
                } else {
                    var checkIsCorrect = false;
                    for (let i = 0; i < $(".edit_is_correct").length; i++) {
                        if ($(".edit_is_correct:eq(" + i + ")").prop('checked') == true) {
                            checkIsCorrect = true;
                            $(".edit_is_correct:eq(" + i + ")").val($(".edit_is_correct:eq(" + i + ")")
                                .next().find(
                                    'input').val());
                        }
                    }

                    if (checkIsCorrect) {
                        var formData = $(this).serialize();
                        var id = $("#question_id").val();
                        var url = '{{ route('Question.update', 'id') }}';
                        url = url.replace('id', id);

                        $.ajax({
                            url: url,
                            method: "PUT",
                            data: formData,
                            success: function(data) {
                                console.log(data);
                                if (data.success == true) {


                                } else {
                                    alert(data.msg);
                                }
                            },
                        });
                    } else {
                        $(".editerror").text(" Please select anyone correct answers !")
                        setTimeout(function() {
                            $(".editerror").text("")
                        }, 2000);
                    }

                }
            });


            /////// Delete  question answer /////
            $(".deleteQNA").click(function() {
                var id = $(this).attr('data-id');
                $("#delete_QNA_id").val(id);
            });

            $("#deleteQA").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var id = $("#delete_QNA_id").val();
                var url = '{{ route('Question.destroy', 'id') }}';
                url = url.replace('id', id);
                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {

                        }
                    }
                });
            });


            /////// Import  question answer /////
            $("#import").submit(function(e) {
                e.preventDefault();

                let formData = new FormData();
                let fileInput = $("#file");

                if (fileInput[0].files.length > 0) {
                    formData.append('file', fileInput[0].files[0]);

                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        }
                    });
                    $.ajax({
                        url: "{{ route('import') }}",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.success == true) {

                            }
                        }
                    });

                } else {

                    console.error("Please select a file");
                }
            });
        });
    </script>
@endsection

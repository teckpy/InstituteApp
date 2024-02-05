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
                                                            <button class="editquestiontbutton" href="javascript:void(0);"
                                                                data-toggle="modal" data-target="#modal-editqa"
                                                                data-id="{{ $question->id }}"
                                                                data-test="{{ $question->name }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button></span>
                                                        <span class="badge bg-danger"> <a class="deletetest"
                                                                data-toggle="modal" data-target="#modal-delete"
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
                    <span style="color: rgb(122, 8, 8)" class="error"></span>
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

    {{-- Edit Qustion model --}}
    <div class="modal fade" id="modal-editqa">
        <div class="modal-dialog">
            <form id="editquestion" method="POST">
                @csrf
                @method("PUT")
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
                    <span style="color: rgb(122, 8, 8)" class="editerror"></span>
                    <div class="modal-footer justify-content-between">
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

    <script>
        $(document).ready(function() {

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
                                    location.reload();
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

            // add answer
            $("#addAnswer").click(function(e) {
                e.preventDefault();

                if ($(".answers").length >= 6) {
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
                            let is_correct = 'No';
                            if (questions[i]['answers'][j]['is_correct'] == 1) {
                                is_correct = 'Yes';
                            }
                            html +=
                                `
                                <tr>
                                    <td>` + (j + 1) + `</td>
                                    <td>` + questions[i]['answers'][j]['answer'] + `</td>
                                    <td>` + is_correct + `</td>
                                </tr>
                            `;

                        }
                        break;
                    }

                }

                $(".showanswers").html(html);

            });

            //update answer
            $("#addeditAnswer").click(function(e) {
                e.preventDefault();

                if ($(".editanswers").length >= 6) {
                    $(".error").text("You can add maximum 6 answers !")
                    setTimeout(function() {
                        $(".error").text("")
                    }, 2000);

                } else {
                    var html = `
                <div class="row editanswers">
                    <input type="radio"  class="edit_is_correct" name="edit_is_correct">
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="" name="new_answers[]"
                                        placeholder="Enter Answer" required>
                                </div>
                            </div>
                           <button class="removeButton removeans"> <i class="fas fa-trash-alt"></i></button>
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
                                                    <input type="radio" class="edit_is_correct" name="edit_is_correct" ` +
                                checked + `>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control"  name="answers['${qna['answers'][i]['answer']}']"
                                                            placeholder="Enter Answer" value="${qna['answers'][i]['answer']}" required>
                                                    </div>
                                                </div>
                                            <button class="removeButton removeans" data-id="` + qna['answers'][i][
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


            /////// update question answer
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
                            data: $(this).serialize(),
                            success: function(data) {
                                if (data.success == true) {
                                    location.reload();

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
        });
    </script>
@endsection

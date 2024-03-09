@extends('layouts.User.app')
@section('title')
    @if (auth()->check())
        {{ auth()->user()->name }}
    @endif | Result
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
                            <li class="breadcrumb-item active">
                                @if (auth()->check())
                                    {{ auth()->user()->name }}
                                @endif
                            </li>
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
                                    Result
                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 10px">S.N</th>
                                            <th>Test Name</th>
                                            <th>Result</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($result && count($result) > 0)
                                            @php $count = 1; @endphp
                                            @foreach ($result as $item)
                                                <tr class="text-center">

                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $item->test->name }}</td>
                                                    <td>
                                                        @if ($item->status == 0)
                                                            Not Declared
                                                        @else
                                                            @if ($item->marks >= $item->test->passing_marks)
                                                                <span class="badge bg-success">Passed</span>
                                                            @else
                                                                <span class="badge bg-danger">Failed</span>
                                                            @endif
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if ($item->status == 0)
                                                            <span class="badge bg-warning">Pending</span>
                                                        @else
                                                            <a href="" class="reviewTest" data-toggle="modal"
                                                                data-target="#modal-review"
                                                                data-id="{{ $item->id }}">Revieq Q&A</a>
                                                        @endif
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
    <div class="modal fade" id="modal-review">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Review Test</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body review-test">
                    <div class="form-group">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /Edit .modal-dialog -->
    </div>
    <div class="modal fade" id="explanationQuestion">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Explanation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p id="explanation"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /Edit .modal-dialog -->
    </div>
    <script>
        $(document).ready(function() {

            $('.reviewTest').click(function() {

                var id = $(this).attr('data-id');


                var html = ``;
                $.ajax({
                    url: "{{ route('testreview') }}",
                    type: "GET",
                    data: {
                        attempt_id: id
                    },
                    success: function(data) {
                        if (data.success == true) {

                            var data = data.data;

                            if (data.length > 0) {
                                for (let i = 0; i < data.length; i++) {
                                    let isCorrect =
                                        `<span class="badge bg-danger"><i class="fa fa-close"></i></span>`;
                                    if (data[i]['answers']['is_correct'] == 1) {
                                        isCorrect =
                                            `<span class="badge bg-success"><i class="fa fa-check"></i></span>`;
                                    }
                                    let answer = data[i]['answers']['answer'];

                                    html += ` <div class="row">
                                                    <div class="col-sm-12">
                                                        <h6>Q(` + (i + 1) + `).` + data[i]['question']['question'] + `</h6>
                                                        <p>Ans:-` + answer + `&nbsp;&nbsp;` + isCorrect + `</p>`;
                                    if (data[i]['question']['explanation'] != null) {
                                        html += `<p><a href="" data-explanation="` + data[i][
                                                'question'
                                            ]['explanation'] +
                                            `" class="explanation" data-toggle="modal" data-target="#explanationQuestion  ">Explanation</a></p>`
                                    }
                                    html += `
                                                    </div>
                                                </div>`;
                                }
                            } else {
                                html += `<h6>Students not attempt any question !</h6>
                                        <p>if you approve this exam student will fail </p>`;
                            }
                        } else {
                            html += `<p>Having some server issue !</p>`;
                        }

                        $('.review-test').html(html);
                    }
                });
            });

            $(document).on('click', '.explanation', function() {
                var explanation = $(this).attr('data-explanation');
                $('#explanation').text(explanation);
            });
        });
    </script>
@endsection

@extends('Admin.Dashboard')
@section('title')
    review
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
                            <li class="breadcrumb-item active">review</li>
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
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h3 class="card-title">

                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 10px">S.N</th>
                                            <th>Name</th>
                                            <th>Test</th>
                                            <th>Status</th>
                                            <th>Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($attemps) > 0)
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($attemps as $item)
                                                <tr class="text-center">
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->test->name }}</td>
                                                    <td>
                                                        @if ($item->status == 0)
                                                            <span class="badge bg-danger">pending</span>
                                                        @else
                                                            <span class="badge bg-success">approved</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 0)
                                                            <a class="reviewTest" href=""
                                                                data-id="{{ $item->id }}" data-toggle="modal"
                                                                data-target="#modal-review"><span class="badge bg-info"><i
                                                                        class="fa fa-eye"></i></span></a>
                                                        @else
                                                            <p>Completed</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4"> Data Not Found !</td>
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
    <div class="modal fade" id="modal-review">
        <div class="modal-dialog">
            <form id="reviewForm">
                @csrf
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
                        <button type="submit" class="btn btn-outline-info">Approve</button>
                    </div>
                </div>
            </form>
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
                    url: "{{ route('reviewQNA') }}",
                    type: "GET",
                    data: {
                        attempt_id: id
                    },
                    success: function(data) {
                        if (data.success == true) {
                            console.log(data);
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
                                                    <p>Ans:-` + answer + `&nbsp;&nbsp;` + isCorrect + `</p>
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
        });
    </script>

@endsection

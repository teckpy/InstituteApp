@extends('layouts.User.app')
@section('title')
    @if (auth()->check())
        {{ auth()->user()->name }}
    @endif | Dashboard
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <span class="badge badge-warning">
                            <h1 class="m-0">Welcome -@if (auth()->check())
                                    {{ auth()->user()->name }}
                                @endif
                            </h1>
                        </span>
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
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">

                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Test Name</th>
                                            <th>Subject Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Total Attempt</th>
                                            <th>Available Attempt</th>
                                            <th>Copy Link</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($data && count($data) > 0)
                                            @php $count = 1; @endphp
                                            @foreach ($data as $item)
                                                <tr>
                                                    
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->subjects[0]['subject'] }}</td>
                                                    <td>{{ $item->date }}</td>
                                                    <td>{{ $item->time }}</td>
                                                    <td>{{ $item->attempt }}</td>
                                                    <td>{{ $item->attempt_counter }}</td>
                                                    
                                                    <td class="text-center"><a onclick="openFullscreenWindow(event)"
                                                            href="{{ route('loadExam', ['id' => $item->test_exam_id]) }}"
                                                            target="_blank" data-code="{{ $item->test_exam_id }}"
                                                            class="copy"><i class="fa fa-copy"></i></a></td>
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
                <div class="row">
                    <section class="col-lg-7 connectedSortable">
                    </section>
                    <section class="col-lg-5 connectedSortable">
                    </section>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).ready(function() {

            $(".copy").click(function() {

                var code = {{ $item->test_exam_id }};
                var url = "{{ URL::to('/') }}/exam/" + code;

                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(url).select();
                document.execCommand("copy");
                $temp.remove();

                setTimeout(() => {
                    $('.copied_text').remove();
                }, 1000);
            });
        });
    </script>

@endsection
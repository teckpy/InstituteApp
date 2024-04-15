@extends('layouts.User.app')
@section('title')
    @if (auth()->check())
        {{ auth()->user()->name }}
    @endif | Paid Exam
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

                                </h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="width: 10px">S.N</th>
                                            <th>Test Name</th>
                                            <th>Subject Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Total Attempt</th>
                                            <th>Attempt</th>
                                            <th>Plan</th>
                                            <th>Price</th>
                                            <th>Buy</th>
                                            <th>Link</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($data && count($data) > 0)
                                            @php $count = 1; @endphp
                                            @foreach ($data as $item)
                                                <tr class="text-center">
                                                    <td style="display: none">{{ $item->id }}</td>
                                                    <td>{{ $count++ }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->subjects[0]['subject'] }}</td>
                                                    <td>{{ $item->date }}</td>
                                                    <td>{{ $item->time }}</td>
                                                    <td>{{ $item->attempt }}</td>
                                                    <td>{{ $item->attempt_counter }}</td>
                                                    <td>
                                                        @if ($item->plan != 0)
                                                            <span class="badge bg-danger">Paid</span>
                                                        @else
                                                            <span class="badge bg-success">Free</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->plan != null)

                                                                INR: {{ $item->Prices}}
                                                        @else
                                                            <span class="badge bg-success">Not Prices</span>
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        <a href=""><span class="badge bg-warning"><i class="fa fa-shopping-cart text-white"></i></span></a>
                                                    </td>
                                                    <td class="text-center"><a onclick="openFullscreenWindow(event)"
                                                            href="{{ route('loadExam', ['id' => $item->test_exam_id]) }}"
                                                            target="_blank" data-code="{{ $item->test_exam_id }}"
                                                            class="copy"><span class="badge bg-danger"><i
                                                                    class="fa fa-copy"></i></span></a></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10"> Subject Data Not Found !</td>
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

                var code = $(this).attr('data-code');

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

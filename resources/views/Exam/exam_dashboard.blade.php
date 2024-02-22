@extends('layouts.Exam.app')
@section('title')
    @if (auth()->check())
        {{ auth()->user()->name }}
    @endif | Dashboard
@endsection

@section('aside')
    <style>
        .navbar {
            height: 40px;
            /* Set your desired height */
        }
    </style>
    <style>
        .brand-image {
            margin-bottom: 10px;
            /* Set your desired margin-bottom */
        }
    </style>
    <style>
        .name {
            margin-top: 5px !important;
            /* Set your desired margin-top */
        }
    </style>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Move the brand logo to the right end -->
        <ul class="navbar-nav">
            <li class="nav-item name">
                <a class="nav-link text-uppercase">
                    @if (auth()->check())
                        {{ auth()->user()->name }}
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <div class="brand-link" style="margin-left: auto; margin-right: 15px;">
                    <img src="{{ asset('Admin/dist/img/logo1.png') }}" class="brand-image img-circle" style="opacity: .8;">
                </div>
            </li>
        </ul>
    </nav>


    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <div class="brand-link">
            <img style="margin-left: 45%;" src="{{ asset('Admin/dist/img/logo1.png') }}" class="brand-image img-circle"
                style="opacity: .8; height: 60px; width: 60px;">
            <br><br>
            <p class="text-center time"> {{ \Carbon\Carbon::parse($qnaExam[0]['time'])->format('h:i A') }}</p>
        </div>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <p class="text-center" style="color: white;">Exam Question Summary </p>
                <ul>
                    <span class="badge badge-success" style="width: 30px;"><i class="fas fa-check"></i></span><span
                        style="color: white">&nbsp;&nbsp;2 Answered</span><br>
                    <span class="badge badge-danger" style="width: 30px;"><i class="fa fa-times"></i></i></span><span
                        style="color: white">&nbsp;&nbsp;0 Not Answered</span><br>
                    <span class="badge badge-primary" style="width: 30px;"><i class="fa fa-eye"></i></i></span><span
                        style="color: white">&nbsp;&nbsp;4 Marked For Review</span><br>
                    <span class="badge badge-info" style="width: 30px;"><i class="fa fa-times"></i></i></span><span
                        style="color: white">&nbsp;&nbsp;6 Not Visited</span><br>
                </ul>
                <hr color="white">
                <div class="text-center d-flex justify-content-center">
                    <table class="table-responsive table-sm" style="margin-left: 20%;">

                        <tr>
                            <td><span class="badge badge-light">1</span></td>
                            <td><span class="badge badge-success">2</span></td>
                            <td><span class="badge badge-success">3</span></td>
                            <td><span class="badge badge-success">4</span></td>
                            <td><span class="badge badge-light">4</span></td>
                        </tr>
                        <tr>
                            <td><span class="badge badge-warning">1</span></td>
                            <td><span class="badge badge-danger">2</span></td>
                            <td><span class="badge badge-light">3</span></td>
                            <td><span class="badge badge-light">4</span></td>
                            <td><span class="badge badge-light">4</span></td>
                        </tr>
                    </table>
                </div>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </aside>
@endsection
@php
    $time = explode(':', $qnaExam[0]['time']);
@endphp
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid"><br>
                <div class="row">
                    <div class="col-10 mx-auto">
                        <!-- Default box -->
                        <h6 class="font-weight-bold text-uppercase">Exam : {{ $qnaExam[0]['name'] }} </h6>
                        <h6 class="font-weight-bold text-uppercase">Test Id :{{ $qnaExam[0]['test_exam_id'] }}</h6>
                        {{-- <h6>Subject:{{ $qnaExam->subject[0]['subject'] }}</h6> --}}
                        <hr>
                        <form action="{{ route('examSubmit') }}" method="POST" id="exam_form">
                            @php $qcount = 1; @endphp
                            @csrf
                            @if ($success == true)
                                @php
                                    $Qcount = 1;
                                @endphp

                                <div class="singleRecord">
                                    <div class="card">
                                        <div class="card-body row">
                                            <div class="col">
                                                <h4>Q) <b>{{ $Qcount++ }}.</b>&nbsp;
                                                    {{ $Exam['question'][0]['question'] }}</h4>
                                                <input type="hidden" name="Q[]"
                                                    data-question-id="{{ $Exam['question'][0]['id'] }}"
                                                    value="{{ $Exam['question'][0]['id'] }}">
                                                <input type="hidden" name="ans_{{ $Qcount - 1 }}">
                                                <input type="hidden" name="exam_id"
                                                    data-exam-id="{{ $qnaExam[0]['test_exam_id'] }}"
                                                    value="{{ $qnaExam[0]['test_exam_id'] }}">
                                                @php
                                                    $Acount = 1;
                                                @endphp
                                                @foreach ($Exam['question'][0]['answers'] as $Answer)
                                                    <p><input type="radio" class="select_ans"
                                                            data-id="{{ $Qcount - 1 }}" name="radio_{{ $Qcount - 1 }}"
                                                            value="{{ $Answer->id }}">&nbsp;&nbsp;<b>{{ $Acount++ }}.&nbsp;&nbsp;</b>{{ $Answer->answer }}
                                                    </p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </form>
                        <button class="btn btn-dark prevBtn">Previous</button>
                        <button class="btn btn-success nextBtn">Next</button>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script>
        $(document).ready(function() {
            const element = document.documentElement;
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
            $('.copied_text').remove();

            $('.select_ans').click(function() {
                var no = $(this).attr('data-id');
                $('#ans_' + no).val($(this).val());
            });

            var time = @json($time);
            $('.time').text(time[0] + ':' + time[0] + ':00 ');

            var seconds = 00;
            var hours = parseInt(time[0]);
            var minutes = parseInt(time[1]);
            var timer = setInterval(() => {

                console.log(hours + ':' + minutes + ':' + seconds);
                if (hours == 0 && minutes == 0 && seconds == 0) {

                    console.log('Submitting form...');
                    clearInterval(timer);
                    $("#exam_form").submit();
                    console.log('After form submission...');

                }
                if (seconds <= 0) {
                    minutes--;
                    seconds = 59;
                }
                if (minutes <= 0 && hours != 0) {
                    hours--;
                    minutes = 59;
                    seconds = 59;
                }
                let temphours = hours.toString().length > 1 ? hours : '0' + hours;
                let tempminutes = minutes.toString().length > 1 ? minutes : '0' + minutes;
                let tempseconds = seconds.toString().length > 1 ? seconds : '0' + seconds;
                $('.time').text(temphours + ':' + tempminutes + ':' + tempseconds + ' ');
                seconds--;
            }, 1000);





            $('.nextBtn').on('click', function() {
                // Get the QuestionID from the hidden input field
                let QuestionID = $("input[name='Q[]']").attr('data-question-id');
                let ExamID = $("input[name='exam_id']").attr('data-exam-id');

                console.log('Button clicked');
                //QuestionID + 1;
                $.ajax({
                    url: "/getSingleRecord/" + ExamID,
                    type: 'GET',
                    data: {
                        QuestionID: QuestionID
                    },
                    success: function(data) {
                        console.log(data);
                        // Update the content with the new question
                        $('.singleRecord').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });




        });
    </script>

@endsection
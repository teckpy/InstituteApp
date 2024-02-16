@extends('layouts.Exam.app')
@section('title')
    @if (auth()->check())
        {{ auth()->user()->name }}
    @endif | Dashboard
@endsection
<style>
    body {
        margin: 0;
        overflow: hidden;
    }

    #fullscreenButton {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }
</style>
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
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

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
                <p class="text-center" style="color: white;">Max 55 Marks</p>
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
                            <td><span class="badge badge-light">2</span></td>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10 mx-auto">
                        <!-- Default box -->
                        <h6 class="font-weight-bold text-uppercase">Exam : {{ $qnaExam[0]['name'] }} </h6>
                        <h6 class="font-weight-bold text-uppercase">Test Id :{{ $qnaExam[0]['test_exam_id'] }}</h6>
                        {{-- <h6>Subject:{{ $qnaExam->subject[0]['subject'] }}</h6> --}}
                        <hr>
                        <form action="{{ route('examSubmit') }}" method="POST" id="exam_form">
                            @csrf
                            @if ($success == true)
                                @if (count($initialQuestion) > 0)
                                    <div class="card">
                                        <div class="card-body row">
                                            <div class="col-9">
                                                <table>
                                                    <tr>
                                                        <h5 class="card-title">
                                                            Q.)
                                                            &nbsp;</h5>
                                                        <input type="hidden" name="exam_id" data-id="{{ $qnaExam[0]['id'] }}"
                                                            value="{{ $qnaExam[0]['id'] }}">
                                                        <input type="hidden" name="q[]"
                                                            value="{{ $initialQuestion[0]['id'] }}">
                                                        {{-- <input type="hidden" name="ans_{{ $randomExam[0]->id }}"
                                            id="ans_{{ $randomExam[0]->id }}"> --}}
                                                        <p class="text-justify">
                                                            {{ $initialQuestion[0]['question'] }}
                                                        </p>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-3 text-right">
                                                <span class="">2 Marks</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body row">
                                            <div class="col" style="margin-left: 1%">
                                                <table>
                                                    <tr>
                                                        @foreach ($randomExam->question[0]->answers->shuffle() as $answer)
                                                            <input type="radio"
                                                                name="radio_{{ $initialQuestion[0]['id'] }}"
                                                                class="form-check-input select_ans"
                                                                data-id="{{ $initialQuestion[0]['id'] }}"
                                                                value="{{ $answer->id }}">
                                                            <label for="">
                                                                {{ $answer->answer }}
                                                            </label><br>
                                                        @endforeach

                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <a class="btn btn-dark" onclick="goBack()">Back</a>
                                        <a class="btn btn-info" onclick="skipQuestion()" style="color: white">Skip</a>
                                        <a class="btn btn-danger" onclick="clearAnswer()" style="color: white">Clear</a>
                                        <a class="btn btn-success" onclick="markForReview()" style="color: white">Mark for
                                            Review</a>
                                        <a class="btn btn-light" onclick="saveAndNext()"
                                            style="background-color: rgb(134, 212, 16);color:white;">Save & Next</a>
                                        <a class="btn btn-warning" style="color:white">Go
                                            Fullscreen</a>
                                    </div>
                                @endif
                            @endif
                        </form>
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

            ////////////////////////////////////////////



                    // Function to get the next question and answer
                    function getNextQuestion() {
                        let examId = $(this).attr();
                        $.ajax({
                            url: '/get-next-question',
                            type: 'POST',
                            data: {
                                _token: csrfToken,
                                exam_id: examId,
                            },
                            success: function(response) {
                                // Handle the response and update your UI
                                // Display the question and answers
                            },
                            error: function(error) {
                                console.error(error);
                            },
                        });
                    }

            // Call this function on button click or any other trigger
            $('#nextButton').on('click', function() {
                getNextQuestion();
            });

        });



        document.addEventListener('DOMContentLoaded', () => {
            const fullscreenButton = document.getElementById('fullscreenButton');
            fullscreenButton.click();
        });


    </script>
@endsection

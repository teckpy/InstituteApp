@extends('layouts.Exam.app')
@section('title')
    Welcome -
    @if (auth()->check())
        {{ auth()->user()->name }}
    @endif
@endsection
@section('nav')
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white fixed-top">
        <div class="container">
            <a href="" class="navbar-brand">

                <span class="brand-text font-weight-light">
                    @yield('name')
                </span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="" class="nav-link"> Welcome -
                            @if (auth()->check())
                                {{ auth()->user()->name }}
                            @endif
                        </a>
                    </li>
                </ul>

                <!-- Centered navbar link -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <h5 class="nav-link">Exam: {{ $qnaExam[0]['name'] }} </h5>
                    </li>
                </ul>

                <!-- Right-aligned navbar link -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <h4 class="nav-link">
                            <p id="currentDate"></p>
                        </h4>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <h4 class="nav-link time">
                            {{ \Carbon\Carbon::parse($qnaExam[0]['time'])->format('h:i A') }}
                        </h4>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
@endsection
@php
    $time = explode(':', $qnaExam[0]['time']);
@endphp
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <br><br>
        <div class="content-header">
            <div class="container d-flex align-items-center justify-content-center">
                <div class="row mb-12">
                    <div class="col-sm-12">


                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="content justify-content-center">
            <div class="container">
                <div class="row mb-12">
                    <div class="col-lg-10 mx-auto">

                        <form action="{{ route('examSubmit') }}" method="POST" id="exam_form">
                            @csrf
                            @if ($success == true)
                                @if (count($qnas) > 0)
                                    @php $qcount = 1; @endphp
                                    @foreach ($qnas as $question)
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <h5 class="card-title">
                                                            Q.{{ ($qnas->currentPage() - 1) * $qnas->perPage() + $loop->index + 1 }})
                                                            &nbsp;</h5>

                                                        <input type="hidden" name="exam_id"
                                                            value="{{ $qnaExam[0]['id'] }}">
                                                        <input type="hidden" name="q[]"
                                                            value="{{ $question['question'][0]['id'] }}">
                                                        <input type="hidden" name="ans_{{ $qcount - 1 }}"
                                                            id="ans_{{ $qcount - 1 }}">
                                                        <p class="text-justify">{{ $question['question'][0]['question'] }}
                                                        </p>
                                                    </tr>
                                                    <tr>
                                                        @php $acount = 1; @endphp
                                                        @foreach ($question['question'][0]['answers'] as $answer)
                                                            <div class="form-check">
                                                                <input type="radio" name="radio_{{ $qcount - 1 }}"
                                                                    class="form-check-input select_ans"
                                                                    data-id="{{ $qcount - 1 }}"
                                                                    value="{{ $answer['id'] }}">
                                                                <label
                                                                    class="form-check-label text-justify">{{ $acount++ }}.
                                                                    {{ $answer['answer'] }}</label>
                                                            </div>
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                    {{-- <div class="text-center mt-3">
                                        <ul class="pagination">
                                            @if ($qnas->onFirstPage())
                                                <li class="page-item disabled"><span class="page-link">&laquo;
                                                        Previous</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $qnas->previousPageUrl() }}" rel="prev">&laquo;
                                                        Previous</a></li>
                                            @endif

                                            @for ($i = 1; $i <= $qnas->lastPage(); $i++)
                                                <li class="page-item {{ $qnas->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $qnas->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor

                                            @if ($qnas->hasMorePages())
                                                <li class="page-item"><a class="page-link"
                                                        href="{{ $qnas->nextPageUrl() }}" rel="next">Next &raquo;</a>
                                                </li>
                                            @else
                                                <li class="page-item disabled"><span class="page-link">Next &raquo;</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div> --}}

                                    <div class="text-center">

                                        <input type="hidden" name="exam_id" value="{{ $qnaExam[0]['id'] }}">
                                        <button type="submit" class="btn btn-info mt-2">Submit Answers</button>

                                    </div>
                                    <br>
                                @else
                                    <h3 class="text-center"><span class="badge badge-danger">Question and Answer
                                            not
                                            available!</span></h3>
                                @endif
                            @else
                                <h3 class="text-center"><span class="badge badge-danger">{{ $msg }}</span>
                                </h3>
                            @endif
                        </form>
                    </div>

                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $('.select_ans').click(function() {
                var no = $(this).attr('data-id');
                $('#ans_' + no).val($(this).val());
            });


            var time = @json($time);
            $('.time').text(time[0] + ':' + time[0] + ':00 ');
           
            var seconds = 60;
            var hours = parseInt(time[0]);
            var minutes = parseInt(time[1]);
            var timer = setInterval(() => {
                
                console.log(hours+':'+minutes+':'+seconds);
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

        });

        function isValid() {
            var result = true;
            var qlength = parseInt("{{ $qcount }}") - 1;

            for (i = 0; i <= qlength; i++) {
                if ($('#ans_' + i).val() == "") {
                    result = false;
                    $('#ans_' + i).parent().append(
                        '<span style="color:red; class="error_msg">Please Select Answer !</span>');
                    setTimeout(() => {
                        $('.error_msg').remove();
                    }, 5000);
                }
            }
            return result;
        }
    </script>

   
@endsection

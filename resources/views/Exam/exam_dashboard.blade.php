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
                    {{-- <li class="nav-item">
                    <a href="#" class="nav-link">Profile</a>
                </li> --}}
                    {{-- <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                        <li><a href="#" class="dropdown-item">Some action </a></li>
                        <li><a href="#" class="dropdown-item">Some other action</a></li>

                        <li class="dropdown-divider"></li>

                        <!-- Level two dropdown-->
                        {{-- <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover
                                for action</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                </li>

                                <!-- Level three dropdown-->
                                <li class="dropdown-submenu">
                                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">level 2</a>
                                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                                    </ul>
                                </li>
                                <!-- End Level three -->

                                <li><a href="#" class="dropdown-item">level 2</a></li>
                                <li><a href="#" class="dropdown-item">level 2</a></li>
                            </ul>
                        </li> --}}
                    <!-- End Level two -->
                </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <br><br>
        <div class="content-header">
            <div class="container d-flex align-items-center justify-content-center">
                <div class="row mb-12">
                    <div class="col-sm-12">
                        <span class="badge badge-warning">
                            <h1 class="m-0 text-center"> {{ $qnaExam[0]['name'] }} <small></small></h1>
                        </span>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="content justify-content-center">
            <div class="container d-flex align-items-center justify-content-center">
                <div class="row">
                    <div class="col-lg-10 mx-auto">

                        <form action="{{ route('examSubmit') }}" method="POST" onsubmit="return isValid()">
                            @csrf
                            @if ($success == true)
                                @if (count($qnas) > 0)
                                    @php $qcount = 1; @endphp
                                    @foreach ($qnas as $question)
                                        <div class="card mb-6">
                                            <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <h5 class="card-title">Q.{{ $qcount++ }}) &nbsp;</h5>

                                                        <input type="hidden" name="exam_id"
                                                            value="{{ $qnaExam[0]['id'] }}">
                                                        <input type="hidden" name="q[]"
                                                            value="{{ $question['question'][0]['id'] }}">
                                                        <input type="hidden" name="ans_{{ $qcount - 1 }}"
                                                            id="ans_{{ $qcount - 1 }}">
                                                        <p>{{ $question['question'][0]['question'] }}</p>
                                                    </tr>
                                                    <tr>
                                                        @php $acount = 1; @endphp
                                                        @foreach ($question['question'][0]['answers'] as $answer)
                                                            <div class="form-check">
                                                                <input type="radio" name="radio_{{ $qcount - 1 }}"
                                                                    class="form-check-input select_ans"
                                                                    data-id="{{ $qcount - 1 }}"
                                                                    value="{{ $answer['id'] }}">
                                                                <label class="form-check-label">{{ $acount++ }}.
                                                                    {{ $answer['answer'] }}</label>
                                                            </div>
                                                        @endforeach
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
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

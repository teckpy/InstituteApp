@extends('layouts.Exam.app')
@section('title')
    {{ $msg }}
@endsection

@section('content')
    <div class="wrapper"><br>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">GSSC</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('logout') }}"><i
                                    class="fa fa-sign-out"></i></a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card bg-light hover-overlay hover-zoom hover-shadow ripple">
                    <div class="card-title text-center">
                        Hi..@if (auth()->check())
                            {{ auth()->user()->name }}
                        @endif
                    </div>
                    <div class="text-center">
                        <h5><u style="color: rgb(212, 58, 58)">{{ $msg }}</u></h5>
                    </div>
                    <div class="form-group text-center">
                        <a class="btn btn-info" href="{{ route('dashboard') }}">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

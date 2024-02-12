@extends('layouts.Exam.app')
@section('title')
    Error
@endsection

@section('content')
    <div class="wrapper"><br>
        <div class="text-center">
            <h4>Hi..@if (auth()->check())
                    {{ auth()->user()->name }}
                @endif </h4>
            <h5><u style="color: rgb(212, 58, 58)">{{ $msg }}</u></h5>
            <a class="btn btn-info" href="{{ route('dashboard') }}">Home</a>
        </div>
    </div>
@endsection

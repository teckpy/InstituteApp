@extends('layouts.Exam.app')
@section('title')
    Thanks
@endsection

@section('content')
    <div class="wrapper"><br>
        <div class="text-center">
            <h4>Thanks for submit your test exam @if (auth()->check())
                    {{ auth()->user()->name }}
                @endif !</h4>
            <h5><u>Your test exam is under review</u></h5>
            <a class="btn btn-info" href="{{ route('dashboard') }}">Home</a>
        </div>
    </div>
@endsection

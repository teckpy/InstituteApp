@extends('layouts.Exam.app')
@section('title')
    Welcome -
    @if (auth()->check())
        {{ auth()->user()->name }}
    @endif
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-center"> <small></small></h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <br>
                        <h2>Thanks for Submit Your Exam, {{ Auth::user()->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

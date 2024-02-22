@extends('layouts.User.app')
@section('title')
    @if (auth()->check())
        {{ auth()->user()->name }}
    @endif | Dashboard
@endsection
@section('content')
    
   

@endsection

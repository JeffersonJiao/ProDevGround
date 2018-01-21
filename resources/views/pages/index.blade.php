@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{asset('css/main.css')}}" />
@endsection
@section('title')
    ProDevGround|Home
@endsection

@section('header')
    <div class="jumbotron">
        <div class="container">
            <h1>Welcome to ProDevGround</h1>
            <p>Join, Make, Create</p>
            <a class="btn btn-primary btn-lg pull-right" href="/register">Get Started</a>
        </div>
    </div>
@endsection

@section('content')
    <div>
    </div>
@endsection
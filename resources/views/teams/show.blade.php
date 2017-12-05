@extends('layouts.app')
@section('title')
    ProDevGround|Projects
@endsection
@section('content')
    <div class="container">
        <h1>{{$project->project_title}}</h1>
    <div>
        {!!$project->project_description!!}
    </div>
    <hr>
    <small>Written on: {{$project->created_at}} </small>

    <hr>
    @if(!Auth::guest())
        

    @endif
    </div>
@endsection
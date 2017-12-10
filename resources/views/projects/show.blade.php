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
        @if(Auth::user()->id == $project->user_id)
            <a href="/projects/{{$project->id}}/edit" class="btn btn-default">Edit</a>
            {!!Form::open(['action'=>['ProjectsController@destroy',$project->id],'method' => 'DELETE', 'class'=>'pull-right'])!!}
                {{Form::submit('Delete',['class'=> 'btn btn-danger'])}}
            {!!Form::close()!!}
        @else
            @if(count($joinrequest) > 0)
                <p>Your request has been sent. Please wait for the project creator to accept</p>
            @elseif(count($member_exist)>0)
                <p>You are already part of this project</p>
            @else
                <a href="/request/create/{{$project->id}}" class="btn btn-default">Join</a>
            @endif
        @endif

    @endif
    </div>
@endsection
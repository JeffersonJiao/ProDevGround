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
            {!!Form::open(['action'=>['TeamsController@store',$project->id],'method' => 'POST', 'class'=>'pull-right'])!!}
                {{Form::submit('Join',['class'=> 'btn btn-default'])}}
            {!!Form::close()!!}
        @endif

    @endif
    </div>
@endsection
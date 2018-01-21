@extends('layouts.app')
@section('title')
    ProDevGround|Projects
@endsection
@section('content')
    <div class="container">
        <h1>Project List</h1>
        @if(count($projects) > 0)
            @foreach($projects as $project)
                <div class="well">
                    <h3><a href="/projects/{{$project->id}}">{{$project->project_title}}</a></h3>
                    <small>Created at: {{$project->created_at}} by: {{$project->user->name}}</small>
                </div>
            @endforeach
            {{$projects->links()}}
        @else
            <p>No Projects Yet</p>
        @endif
    </div>
@endsection
@extends('layouts.app')
@section('title')
    ProDevGround|Projects
@endsection
@section('content')
    <div class="container">
        <h1>{{$request->project_title}}</h1>
    <div>
        {!!$request->coverletter!!}
    </div>
    <hr>
    {!!Form::open(['action'=>['TeamsController@store',$request->id],'method' => 'POST', 'class'=>'pull-left'])!!}
    {{ Form::hidden('project_id', $request->project_id) }}
    {{ Form::hidden('requester_id', $request->requester_id) }}
    {{ Form::hidden('joinrequest_id', $request->id) }}
        {{Form::submit('Accept',['class'=> 'btn btn-default'])}}
    {!!Form::close()!!}
    {!!Form::open(['action'=>['RequestController@destroy',$request->id],'method' => 'DELETE', 'class'=>'pull-right'])!!}
        {{Form::submit('Deny',['class'=> 'btn btn-danger'])}}
    {!!Form::close()!!}
    </div>
@endsection
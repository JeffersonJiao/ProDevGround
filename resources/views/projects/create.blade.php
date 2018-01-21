@extends('layouts.app')
@section('title')
    ProDevGround|Projects
@endsection
@section('content')
    <div class="container">
        <h1>Create Project</h1>
        {!! Form::open(['action' => 'ProjectsController@store','method'=>'POST']) !!}
            <div class="form-group">
                {{Form::label('title','Project title')}}
                {{Form::text('title','',['class' => 'form-control','placeholder' => 'Title' ])}}
            </div>
            <div class="form-group">
                {{Form::label('description','Project Description')}}
                {{Form::textarea('description','',['id' => 'article-ckeditor','class' => 'form-control','placeholder' => 'Project Description' ])}}
            </div>

            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
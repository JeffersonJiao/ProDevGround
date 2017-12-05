@extends('layouts.app')
@section('title')
    ProDevGround|Projects
@endsection
@section('content')
    <div class="container">
        <h1>Join Request</h1>
        {!! Form::open(['action' => 'RequestController@store','method'=>'POST']) !!}
            <div class="form-group">
                {{Form::label('title','Project title')}}
                {{Form::text('title','',['class' => 'form-control','placeholder' => $project->project_title , 'disabled' => 'disabled' ])}}
                {{ Form::hidden('id', $project->id) }}
            </div>
            <div class="form-group">
                {{Form::label('coverletter','Cover Letter (please include portfolio links)')}}
                {{Form::textarea('coverletter','',['id' => 'article-ckeditor','class' => 'form-control','placeholder' => 'Cover Letter' ])}}
            </div>

            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
@endsection
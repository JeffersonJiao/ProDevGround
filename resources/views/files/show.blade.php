@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{asset('css/main.css')}}" />
@endsection
@section('title')
    ProDevGround|Projects
@endsection
@section('content')
    <div class="container-fluid">
        <div class="file-show-img">
            <img src="/images/uploads/{{$file->name}}" alt="file-image"/>
            <a id="fileClose" href="{{ url('teams') }}/{{$file->project_id}}"/>
                
            </a>
        </div>
    </div>
@endsection
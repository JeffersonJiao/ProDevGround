@extends('layouts.app')
@section('title')
    ProDevGround|Teams
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My Teams</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h1>Your Teams</h1>
                        @if(count($teams) > 0)
                            <table class="table table-striped">
                            <tr>
                                <th>Project Title</th>
                                <th>Project Creator</th>
                                <th></th>
                            </tr>
                            @foreach($teams as $team)
                            <tr>
                                <td>{{$team->project_title}}</td>
                                <td>{{$team->name}}</td>
                                <td><a href="/teams/{{$team->project_id}}" class="btn btn-primary">View</a></td>
                            </tr>
                            @endforeach
                            </table>
                            {{$teams->links()}}
                        @else
                            <p>You are not member of any teams yet</p>
                        @endif
                    </div>
                </div>
            </div>   
        </div>
    </div>
@endsection
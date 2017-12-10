@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Join Requests</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Request Lists</h3>

                    @if(count($requests)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Project</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($requests as $request)
                            <tr>
                                <td> <a href="/request/{!!$request->id!!}">{{$request->name}}</a></td>
                                <td>{{$request->project_title}}</td>
                                <td>
                                    {!!Form::open(['action'=>['TeamsController@store',$request->id],'method' => 'POST', 'class'=>'pull-left'])!!}
                                    {{ Form::hidden('project_id', $request->project_id) }}
                                    {{ Form::hidden('requester_id', $request->requester_id) }}
                                    {{ Form::hidden('joinrequest_id', $request->id) }}
                                        {{Form::submit('Accept',['class'=> 'btn btn-primary'])}}
                                    {!!Form::close()!!}
                                </td>
                                <td>
                                {!!Form::open(['action'=>['RequestController@destroy',$request->id],'method' => 'DELETE'])!!}
                                    {{Form::submit('Deny',['class'=> 'btn btn-danger'])}}
                                {!!Form::close()!!}
                                   
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{$requests->appends(['projects' => $projects->currentPage()])->links()}}  
                    @else
                        <p>You currently do not have join request for your project</p>
                    @endif
                    
                </div>
            </div>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/projects/create" class="btn btn-primary">Create Project</a>
                    <a href="/teams" class="btn btn-primary pull-right">My Teams</a>
                    <h3>Your Created Projects</h3>

                    @if(count($projects)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($projects as $project)
                            <tr>
                                <td><a href="/projects/{{$project->id}}">{{$project->project_title}}</a></td>
                                <td><a href="/projects/{{$project->id}}/edit" class="btn btn-default">Edit</a></td>
                                <td>
                                    {!!Form::open(['action'=>['ProjectsController@destroy',$project->id],'method' => 'DELETE', 'class'=>'pull-right'])!!}
                                        {{Form::submit('Delete',['class'=> 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{$projects->appends(['requests' => $requests->currentPage()])->links()}}  
                    @else
                        <p>You have no projects</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

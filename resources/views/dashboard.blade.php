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

                    @if(count($projects)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Project</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($requests as $request)
                            <tr>
                                <td>{{$request->name}}</td>
                                <td>{{$request->project_title}}</td>
                                <td>
                                    <a href="">Accept</a>
                                   
                                </td>
                                <td>
                                    <a href="">Deny</a>
                                   
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{$projects->links()}}
                    @else
                        <p>You have no projects</p>
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
                    {{$projects->links()}}
                    @else
                        <p>You have no projects</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

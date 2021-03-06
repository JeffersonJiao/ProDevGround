@extends('layouts.app')
@section('title')
    ProDevGround|Teams
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Project: {{$project->project_title}}</h2>
            </div>   
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                        <ul class="nav nav-tabs" >
                                <li class="active"><a data-toggle="tab" href="#home">Files</a></li>
                                <li><a data-toggle="tab" href="#menu1">Members</a></li>
                                <li><a id="fileTab" data-toggle="tab" href="#menu2">Project</a></li>
                                <li><a data-toggle="tab" href="#menu3">Upload File</a></li>
                                <li><a data-toggle="tab" href="#menu4">Discussions</a></li>
                              </ul>
                            
                              <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                <h3>Files</h3>
                                  <hr>
                                  @if(count($files)>0)
                                        <div class="row"> 
                                        @foreach($files as $file)
                                        
                                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 img-file">
                                                <h4>{{$file->title}}</h4>

                                                <small>Uploaded by: {{$file->uploader_name}}</small>                
                                                <hr>                              
                                                <a href="/files/{{$file->id}}"><img src="/images/uploads/{{$file->name}}" width="100%" height="auto"/></a>
                                                <hr>
                                                <small>Posted on: {{$file->created_at}}</small><br/>
                                                <hr>
                                                <a href="/images/uploads/{{$file->name}}" class="btn btn-primary" download="filename"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Download</a>
                                                @if(Auth::user()->id == $file->uploader_id)
                                                    {!!Form::open(['action'=>['FilesController@destroy',$file->id],'method' => 'DELETE', 'class'=>'pull-right form-delete'])!!}
                                                        {{Form::button('<i class="glyphicon glyphicon-remove"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-danger '))}}
                                                    {!!Form::close()!!}
                                                @endif
                                                
                                            </div>
                        
                                        @endforeach
                                        

                                        </div>
                                  @else
                                        <p>No image file exist on this project</p>
                                  @endif
                                  {{$files->links()}}           
                                </div>
                                <div id="menu3" class="tab-pane fade">
                                  <h3>Upload File</h3>
                                  <div class="panel panel-default">
                                        <div class="panel-body">
                                            {!! Form::open(['action' => 'FilesController@store','method'=>'POST', 'files' => true]) !!}
                                                <div class="form-group">
                                                    {{Form::label('title','File Title')}}
                                                    {{Form::text('title','',['class' => 'form-control','placeholder' => 'Title' ])}}
                                                </div>
                                                <div class="form-group">
                                                    {{Form::label('file_image','')}}
                                                    {{Form::file('file_image')}}
                                                    {{ Form::hidden('uploader_id', Auth::user()->id) }}
                                                    {{ Form::hidden('project_id', $project->id) }}
                                                </div>
                                            {{Form::submit('Upload',['class' => 'btn btn-primary'])}}
                                            {!! Form::close() !!}
                                        </div>

                                  </div>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                  <h3>Members</h3>
                                  <div class="panel panel-default">
                                        <div class="panel-heading">Member count: {{count($members)}}
                                            <button id="showMember" class="btn btn-info pull-right">Show</button>
                                        </div>
                            
                                        <div id="membersTable" class="panel-body">
                                            @if (session('status'))
                                                <div class="alert alert-success">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            @if(count($members) > 0)
                                                <table  class="table table-striped">
                                                <tr>
                                                    <th>Name</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($members as $member)
                                                <tr>
                                                    <td>{{$member->member_name}}</td>
                                                    <td>
                                                        @if(Auth::user()->id == $member->creator_id)
                                                            @if(Auth::user()->id != $member->user_id)
                                                                {!!Form::open(['action'=>['TeamsController@destroy',$member->id],'method' => 'DELETE', 'class'=>'pull-right'])!!}
                                                                    {{Form::submit('Remove',['class'=> 'btn btn-danger'])}}
                                                                {!!Form::close()!!}
                                                            @endif
                                                        @elseif(Auth::user()->id == $member->user_id &&  Auth::user()->id != $member->creator_id) 
                                                                {!!Form::open(['action'=>['TeamsController@destroy',$member->id],'method' => 'DELETE', 'class'=>'pull-right'])!!}
                                                                    {{Form::submit('Leave',['class'=> 'btn btn-danger'])}}
                                                                {!!Form::close()!!}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </table>
                                            @else
                                                <p>Members cannot find</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                    <h3>Project Description</h3>
                                    <p>{!!$project->project_description!!}</p>  
                                  
                                </div>
                                <div id="menu4" class="tab-pane fade">
                                    <h3>Discussions</h3>
                                    <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                </div>
                              </div>
                   
                </div>
                
                
            </div>
        </div>    
    </div>
    
@endsection
@section('pagescript')
<script src="/js/teampage.js"></script>
@endsection
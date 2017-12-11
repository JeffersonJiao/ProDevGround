@extends('layouts.app')
@section('title')
    ProDevGround|Teams
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Members</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(count($members) > 0)
                            <table class="table table-striped">
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
        </div>
    </div>
@endsection
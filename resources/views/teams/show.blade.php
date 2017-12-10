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
                            </tr>
                            @foreach($members as $member)
                            <tr>
                                <td>{{$member->name}}</td>
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
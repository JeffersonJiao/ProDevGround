@extends('layouts.app')
@section('title')
    ProDevGround|Teams
@endsection
@section('content')
    <div class="container">
         @if(count($teams)>0)
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($teams as $team)
                    <tr>
                        <td>{{$team->project_id}}</td>
                        <td></td>
                        <td>
                           
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>You have no projects</p>
        @endif
    </div>
@endsection
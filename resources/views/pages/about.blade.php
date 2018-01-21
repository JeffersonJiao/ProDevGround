@extends('layouts.app')


@section('title')
    ProDevGround|About
@endsection

@section('content')
    <div class="container about-container">
        <div class="row">
            <h1>Who we are?</h1>
            <hr>
            <p>Prodevground is a group of professional who are focussed on</p>
            <p>to encourage professionals to work in a team. Either they can join or
                create their own team.
            </p>
            <br>
            <p>We believe everyone should have a chance to be discovered,<br> build a business and succeed on their own terms, and that people—not gatekeepers—decide what’s popular.</p>
        </div>
        <div class="row">
            <h1>Features</h1>
            <hr>
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <img class="text-justify" src="/images/ConnectionHv - Copy.png" width="30%" height="auto"/>
                <p>Quick to assign work</p>
            </div>
            <div class="col-sm-12 col-lg-4">
                <img class="text-justify" src="/images/lightbulb.png" width="30%" height="auto"/>
                <p>Your idea your team</p>
            </div>
            <div class="col-sm-12 col-lg-4">
                <img class="text-justify" src="/images/bargraph.png" width="30%" height="auto"/>
                <p>Easy teamwork tracking</p>
            </div>
        </div>
    </div>
@endsection
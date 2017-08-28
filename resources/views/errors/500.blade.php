@extends('layouts.maincontent')

@section('title')
    Uh oh...
@endsection

@section('content')
    <div class="row text-center">
        <h4>Something went wrong. Sorry about that.</h4>
        <h4>Please let us know what went wrong by clicking the button below.</h4>
        <button class="btn btn-pink" onclick="window.location='/contact'">Submit an Issue</button>
        <hr/>
        <h4>Or...</h4>
        <button class="btn btn-pink" onclick="window.location='/forum'">Back to Safety</button>
    </div>
@endsection
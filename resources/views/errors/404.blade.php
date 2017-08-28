@extends('layouts.maincontent')

@section('title')
    Hmmm are you lost?
@endsection

@section('content')
    <div class="row text-center">
        <h4>We can't seem to find the page you are looking for.</h4>
        <button class="btn btn-pink" onclick="window.location='/forum'">Back to Safety</button>
        <hr/>
        <h4>If this page should exist, please click the button below</h4>
        <button class="btn btn-pink" onclick="window.location='/contact'">Submit an Issue</button>
    </div>
@endsection
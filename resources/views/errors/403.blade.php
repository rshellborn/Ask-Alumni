@extends('layouts.maincontent')

@section('title')
    Unauthorized Request
@endsection

@section('content')
    <div class="row text-center">
        <h4>You are unauthorized to perform this action</h4>
        <button class="btn btn-pink" onclick="window.location='/forum'">Back to Safety</button>
        <hr/>
        <h4>If this page should accessible to you, please click the button below</h4>
        <button class="btn btn-pink" onclick="window.location='/contact'">Submit an Issue</button>
    </div>
@endsection
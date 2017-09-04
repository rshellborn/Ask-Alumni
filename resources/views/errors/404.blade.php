@extends('layouts.maincontent')

@section('title')
    Hmmm are you lost?
@endsection

@section('content')
    <div class="row text-center">
        <img src="{{url('notFoundError.png')}}" class="img-responsive center-block" width="100px" />
        <h4>We can't seem to find the page you are looking for.</h4>
        <button class="btn btn-pink" onclick="window.location='/forum'">Back to Safety</button>
        <button class="btn btn-pink" onclick="window.location='/contact'">Submit an Issue</button>
    </div>
@endsection
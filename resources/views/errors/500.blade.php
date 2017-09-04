@extends('layouts.maincontent')

@section('title')
    Oops!
@endsection

@section('content')
    <div class="row text-center">
        <img src="{{url('badError.png')}}" class="img-responsive center-block" width="100px" />
        <h4>Something went wrong.</h4>
        <button class="btn btn-pink" onclick="window.location='/forum'">Back to Safety</button>
        <button class="btn btn-pink" onclick="window.location='/contact'">Submit an Issue</button>
    </div>
@endsection
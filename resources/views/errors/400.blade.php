@extends('layouts.maincontent')

@section('title')
    Uh oh!
@endsection

@section('content')
    <div class="row text-center">
        <h4>Something went wrong.</h4>
        <button class="btn btn-pink" onclick="window.location='/forum'">Back to Safety</button>
    </div>
@endsection
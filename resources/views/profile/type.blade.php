@extends('layouts.maincontent')

@section('title')
    Account Type
@endsection

@section('content')
    <div class="text-center">
        <h4>Are you currently a high school student or an Alumni?</h4>
        <br/>
        <div class="col-md-8 col-md-offset-2">
            <button class="btn btn-pink btn-block" onclick="window.location='{{ url('/profile/complete/student') }}'">High School Student</button>
        <br/>
            <button class="btn btn-pink btn-block" onclick="window.location='{{ url('/profile/complete/alumni') }}'">Alumni</button>
        </div>
    </div>
@endsection
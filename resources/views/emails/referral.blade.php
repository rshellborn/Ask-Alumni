@extends('emails.layout')

@section('image')
    https://www.askalumni.ca/Cap.png
@endsection

@section('title')
    Your friend, {{$name}}, has sent you an invitation to join Ask Alumni!
@endsection

@section('subtitle')
    Ask Alumni is a social network which connects high school students and alumni.<br/><br/>
    Using this link to register will earn you 15 points after you register.<br/>
    Sign up now and claim your 15 points!
@endsection

@section('btnLink')
    {!! url('/register/' . $url) !!}
@endsection

@section('btnText')
    Register
@endsection

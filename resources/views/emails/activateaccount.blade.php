@extends('emails.layout')

@section('image')
    https://www.askalumni.ca/emailLogo.png
@endsection

@section('title')
    Hello {{explode(' ',trim($name))[0]}}, <br/>
    Welcome to Ask Alumni!
@endsection

@section('subtitle')
    Please click the link below to activate your account.
@endsection

@section('btnLink')
    {!! url('/activate', ['code'=>$verification_code]) !!}
@endsection

@section('btnText')
    Activate My Account
@endsection

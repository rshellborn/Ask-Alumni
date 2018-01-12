@extends('emails.layout')

@section('image')
    https://www.askalumni.ca/Cap.png
@endsection

@section('title')
    Complete Your Registration
@endsection

@section('subtitle')
    {{explode(' ',trim($name))[0]}}, we noticed you did not complete your profile.<br/><br/>
    Head over to Ask Alumni to fill in your education details and join the community!
@endsection

@section('btnLink')
    {!! url('/profile/complete/type') !!}
@endsection

@section('btnText')
    Complete my Registration
@endsection

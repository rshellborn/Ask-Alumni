@extends('emails.layout')

@section('image')
    https://www.askalumni.ca/message.png
@endsection

@section('title')
    New Message Received
@endsection

@section('subtitle')
    {{explode(' ',trim($name))[0]}}, you have one or more messages in your inbox.
@endsection

@section('btnLink')
    {!! url('/messages') !!}
@endsection

@section('btnText')
    View Messages
@endsection

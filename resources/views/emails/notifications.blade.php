@extends('emails.layout')

@section('image')
    https://www.askalumni.ca/notification.png
@endsection

@section('title')
    You have new notifications
@endsection

@section('subtitle')
    <div class="text-align: left" style="width:350px; margin:0 auto;">
    @if($messages != 0)
        <div style="margin-bottom: 10px;">
            <img style="vertical-align:middle;" src="https://www.askalumni.ca/message-thumb.png"/>
            <span style="font-size: 18px;">{{$messages}} new @if($messages == 1) message @else messages @endif</span><br/>
        </div>
    @endif

    @if($likes != 0)
        <div style="margin-bottom: 10px;">
            <img style="vertical-align:middle" src="https://www.askalumni.ca/thumbsupfilled.png"/>
            <span style="font-size: 18px;">{{$likes}} @if($likes == 1) like @else likes @endif on your forum threads</span><br/>
        </div>
    @endif

    @if($points != 0)
        <div>
            <img style="vertical-align:middle" src="https://www.askalumni.ca/star-filled.png"/>
            <span style="font-size: 18px;">{{$points}} points were given to you from others</span><br/>
        </div>
    @endif
    </div>
@endsection

@section('btnLink')
    {!! url('/home') !!}
@endsection

@section('btnText')
    View Notifications
@endsection

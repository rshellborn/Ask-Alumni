@extends('layouts.maincontent')

@section('title')
    Messages
@endsection

@section('content')
    <div class="media" style="margin-left: 2px; margin-right: 2px; border-radius: 10px;">
        @if($flag == true)
            <h5>No messages</h5>
        @endif
        @foreach($threads as $inbox)
            @if(!is_null($inbox->thread))
                <a href="{{route('message.read', ['id'=>$inbox->withUser->id])}}">
                    <div class="col-md-12 list-group-item convoSelectIndex">
                        <div class="media-left">
                            <img src="{{'/avatars/' . $inbox->withUser->avatar}}" alt="avatar" style="margin-top: 5px;width: 50px;height: 50px;border-radius:50px;" />
                        </div>
                        <div class="media-body">
                            <div class="media-heading"><strong>{{$inbox->withUser->name}}</strong></div>
                            <div>
                                @if(auth()->user()->id == $inbox->thread->sender->id)
                                    <span class="fa fa-reply"></span>
                                @endif
                                <span>{{substr($inbox->thread->message, 0, 80)}}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
@endsection
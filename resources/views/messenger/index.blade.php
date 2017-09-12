@extends('layouts.maincontent')

@section('title')
    Inbox
@endsection

@section('content')
    @if($flag == false)
        <div class="text-right">
            <button class="btn btn-pink" onclick="window.location='/discover'">New Message</button>
        </div>
    @endif
    <div class="media" style="margin-left: 2px; margin-right: 2px;">
        @if($flag == true)
            <div class="row text-center">
                <div class="col-md-12">
                    <h4><strong>You Currently Have No Messages</strong></h4>
                </div>
                <div class="col-md-6">
                    <h4>Search for people using Discover</h4>
                    <br/>
                    <div class="col-md-6 col-md-offset-3">
                        <img src="{{url('search.png')}}" class="img-responsive" />
                        <br/>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <button class="btn btn-pink" onclick="window.location='/discover'">Discover</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Find people with similar interests using matches</h4>
                    <br/>
                    <div class="col-md-6 col-md-offset-3">
                        <img src="{{url('matches.png')}}" class="img-responsive" />
                        <br/>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <button class="btn btn-pink" onclick="window.location='/discover'">Matches</button>
                    </div>
                </div>
            </div>
        @else
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
        @endif
    </div>
@endsection
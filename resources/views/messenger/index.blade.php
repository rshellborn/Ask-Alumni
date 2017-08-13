@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4><strong>Messages</strong></h4>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            @foreach($threads as $inbox)
                                @if(!is_null($inbox->thread))
                                    <a href="{{route('message.read', ['id'=>$inbox->withUser->id])}}">
                                        <div class="col-md-12" id="convoSelect">
                                            <img src="{{'/avatars/' . $inbox->withUser->avatar}}" alt="avatar" style="width: 50px;height: 50px;border-radius:50px;" />

                                            <div><strong>{{$inbox->withUser->name}}</strong></div>
                                            <div>
                                                @if(auth()->user()->id == $inbox->thread->sender->id)
                                                    <span class="fa fa-reply"></span>
                                                @endif
                                                <span>{{substr($inbox->thread->message, 0, 20)}}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
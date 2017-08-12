@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4><strong>Messages</strong></h4>
                    </div>

                    <div class="panel-body">
                        <div class="text-right">
                            <button class="btn btn-primary" onclick="window.location='{{ url('/discover') }}'">New Message</button>
                        </div>
                        <br/>
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error_message') }}
                            </div>
                        @endif
                        @if($threads->count() > 0)
                            @foreach($threads as $thread)
                                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : 'border rounded'; ?>

                            <a style="text-decoration: none; cursor: pointer;" href={{url("messages/" . $thread->id)}}>
                                <div class="media alert {{ $class }}" style="border:2px solid #3097d1;">
                                    <h4 class="media-heading"><strong>{{$thread->subject}}</strong></h4>
                                    <h5><strong>{{ str_replace(array(',', $currentUserName), '', $thread->participantsString()) }}</strong></h5>
                                    <p style="font-style: italic ">{{ $thread->latestMessage->body }}</p>
                                </div>
                            </a>
                            @endforeach
                        @else
                            <p>You currently have no conversations.</p>
                        @endif

                            <div class="text-center">{{ $threads->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

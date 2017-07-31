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
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error_message') }}
                            </div>
                        @endif
                        @if($threads->count() > 0)
                            @foreach($threads as $thread)
                                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                                <div class="media alert {{ $class }}">
                                    <h4 class="media-heading">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
                                    <p>{{ $thread->latestMessage->body }}</p>
                                    <p><small><strong>Creator:</strong> {{ $thread->creator()->name }}</small></p>
                                    <p><small><strong>Participants:</strong> {{ $thread->participantsString() }}</small></p>
                                </div>
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

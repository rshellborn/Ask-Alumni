@extends('layouts.app')

@section('scripts')
<script>
    var objDiv = document.getElementById("message-box");
    objDiv.scrollTop = objDiv.scrollHeight;
</script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4><strong>{{ $thread->subject }}</strong></h4>
                    </div>

                    <div class="panel-body">
                        <div class="col-md-12">
                            <div id="message-box" style="max-height:300px;overflow:auto;">
                            @foreach($thread->messages as $message)
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64" alt="{{ $message->user->name }}" class="img-circle">
                                    </a>
                                    <div class="media-body">
                                        <h5 class="media-heading">{{ $message->user->name }}</h5>
                                        <p>{{ $message->body }}</p>
                                        <div class="text-muted"><small>Posted {{ $message->created_at->diffForHumans() }}</small></div>
                                    </div>
                                </div>
                            @endforeach

                            </div>
                            {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
                            <br/>
                        <!-- Message Form Input -->
                            <div class="form-group">
                                {!! Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Type a message...', 'rows' => 5]) !!}
                            </div>

                            {{--@if($users->count() > 0)--}}
                                {{--<div class="checkbox">--}}
                                    {{--@foreach($users as $user)--}}
                                        {{--<label title="{{ $user->name }}"><input type="checkbox" name="recipients[]" value="{{ $user->id }}">{{ $user->name }}</label>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--@endif--}}

                        <!-- Submit Form Input -->
                            <div class="form-group">
                                {!! Form::submit('Send', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

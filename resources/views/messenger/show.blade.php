@extends('layouts.app')

@section('scripts')
<script>
    var objDiv = document.getElementById("message-box");
    objDiv.scrollTop = objDiv.scrollHeight;
</script>

<script>
    var objDiv = document.getElementById("message-box");
    objDiv.scrollTop = objDiv.scrollHeight;
</script>

<script type="text/javascript">


    $(function(){
        $('#give-points').click(function(e){
            e.preventDefault();
            var userId = $('input[name="userID"]').val();
            var name = $('input[name="userName"]').val();
            var fromUser = $('input[name="fromUser"]').val();
            var data = { user: userId, fromUser: fromUser };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'/post/give_points',
                type:'POST',
                data:JSON.stringify(data),
                contentType:"application/json",
                processData:false,
                success:function(data){
                    $("#pointsBtn").hide();
                    $("#convoHelp").hide();
                    $('<p>You gave 10 points to ' + name + '.</p>').appendTo('#pointsGiven');
                },
                error:function(data){
                    console.log('error ' +data.responseJSON);
                }
            });
        })
    });
</script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div style="width: 100%; display: table;">
                            <div style="display: table-row">
                                <div style="width: 400px; display: table-cell;"><h4><strong>{{ $thread->subject }}</strong></h4></div>
                                <div style="display: table-cell;" class="text-right">
                                    <span id="convoHelp">Was this conversation helpful?</span>
                                    <input type="hidden" name="userID" value="{{$user->user_id}}"/>
                                    <input type="hidden" name="fromUser" value="{{$fromUser->user_id}}"/>
                                    <input type="hidden" name="userName" value="{{DB::table('users')->where('id', $user->user_id)->value('name')}}"/>
                                    <div id="pointsBtn">
                                        <button id="give-points" class="btn btn-success">
                                            Give Points
                                        </button>
                                    </div>
                                    <div id="pointsGiven"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel-body">
                        <div class="col-md-12">
                            <div id="message-box" style="max-height:300px;overflow:auto;">
                            @foreach($thread->messages as $message)
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img src="/avatars/{{ $message->user->avatar }}" class="img-circle" style="width:64px; height:64px;">
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

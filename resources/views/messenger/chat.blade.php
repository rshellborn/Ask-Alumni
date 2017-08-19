@extends('layouts.maincontent')

@section('styles')
    <style>
        .panel-body {
            padding-top: 0;
        }
    </style>
@endsection

@section('scripts')
    <script>
        var objDiv = document.getElementById("talkMessages");
        objDiv.scrollTop = objDiv.scrollHeight;
    </script>

    <script>
        var __baseUrl = "{{url('/')}}"
    </script>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js'></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js'></script>

    <script src="{{asset('chat/js/talk.js')}}"></script>

    <script>
        var show = function(data) {
            alert(data.sender.name + " - '" + data.message + "'");
        }

        var msgshow = function(data) {
            var html =
                    '<div class="col-md-10 col-md-offset-1">' +
                    '<div id="message-' + data.id + '">' +
                    '<span>' + data.sender.name + '</span>' +
                    '<div class="text-right">' +
                    '<div class="well well-sm col-md-8 col-md-offset-4" style="margin-bottom: 0px; background-color: #1ea896; border-radius: 30px">' +
                    '<span style="color: white">' + data.message + '</span>' +
                    '<img src="' + '/avatars/' + data.sender.avatar + '" alt="avatar" style="width: 50px;height: 50px;border-radius:50px" />' +
                    '</div></div>' +
                    '<span>Just now</span></div></div>';
            $('#talkMessages').append(html);
        }

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

@section('title')
    <div style="width: 100%; display: table;">
        <div style="display: table-row">
            <div class="text-center" style="width: 400px; display: table-cell;">
                <h4>
                    <strong>
                        @if(isset($user))
                            {{'Chat with ' . @$user->name}}
                        @else
                            No Thread Selected
                        @endif
                    </strong>
                </h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="text-center" style="background-color: white; padding-bottom: 4px; padding-top: 4px;">
        <span id="convoHelp">Was this conversation helpful?</span>
        <input type="hidden" name="userID" value="{{$user->id}}"/>
        <input type="hidden" name="fromUser" value="{{\Auth::user()->id}}"/>
        <input type="hidden" name="userName" value="{{$user->name}}"/>
        <div id="pointsBtn" style="display:inline">
            <button id="give-points" class="btn btn-pink">
                Give Points
            </button>
        </div>
        <div id="pointsGiven"></div>
    </div>

    <div class="row" id="talkMessages" style="max-height:400px;overflow:auto;">
    @foreach($messages as $message)
        @if($message->sender->id == auth()->user()->id)
            <div class="col-md-10 col-md-offset-1">
                <div class="row text-right" id="message-{{$message->id}}">
                    <span>{{$message->sender->name}}</span>
                    <div class="text-right">
                        <div class="well well-sm col-md-8 col-md-offset-4" style="margin-bottom: 0px; background-color: #ff715b; border-radius: 30px">
                            <span style="color: white">{{$message->message}}</span>
                            <img src="{{'/avatars/' . $message->sender->avatar}}" alt="avatar" style="width: 50px;height: 50px;border-radius:50px" />
                            {{--<a href="#" style="color: white" data-message-id="{{$message->id}}" title="Delete Message"><i class="fa fa-close"></i></a>--}}
                        </div>
                    </div>
                    <span>{{$message->humans_time}} ago</span>
                </div>
            </div>
        @else
            <div class="col-md-10 col-md-offset-1">
                <div class="row text-left" id="message-{{$message->id}}">
                    <span>{{$message->sender->name}}</span>
                    <div class="text-left">
                        <div class="well well-sm col-md-8" style="margin-bottom: 0px; background-color: #4c5454; border-radius: 30px">
                            <img src="{{'/avatars/' . $message->sender->avatar}}" alt="avatar" style="width: 50px;height: 50px;border-radius:50px" />
                            <span style="color: white">{{$message->message}}</span>
                        </div>
                        <div class="text-left col-md-8">
                            <span>{{$message->humans_time}} ago</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    </div>
        <br/>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
            <form action="" method="post" id="talkSendMessage">
                <textarea class="form-control" name="message-data" id="message-data" placeholder ="Type your message" rows="3"></textarea>
                <input type="hidden" name="_id" value="{{@request()->route('id')}}">
                <button class="btn btn-pink" type="submit" style="margin-top: 10px">Send</button>
            </form>
        </div>
    </div>
@endsection

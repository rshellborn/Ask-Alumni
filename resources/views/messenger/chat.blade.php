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
        $( document ).ready(function() {
            $('#message-data').bind("enterKey",function(e){
                $( "#sendBtn" ).submit();
            });
            $('#message-data').keydown(function(e){
                if(e.keyCode == 13)
                {
                    e.preventDefault();
                    $(this).trigger("enterKey");
                }
            });
        });
    </script>

    <script>
        var objDiv = document.getElementById("talkMessages");
        objDiv.scrollTop = objDiv.scrollHeight;
    </script>

    <script>
        var __baseUrl = "{{url('/')}}"
    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js'></script>

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
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="text-center col-md-8">
            <h4>
                <strong>
                    @if(isset($user))
                        <a href="{{'/profile/view/' . $user->id}} " style="color: white;">
                            {{@$user->name}}
                        </a>
                    @else
                        No Thread Selected
                    @endif
                </strong>
            </h4>
        </div>
        <div class="col-md-2 text-right">
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                    <li><a href="{{url('/profile/view/' . $user->id)}}">View Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{url('/report/' . $user->id)}}">Report</a></li>
                    <li><a href="{{url('/block/' . $user->id)}}">Block</a></li>
                </ul>
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
                    <div class="text-right">
                        <div class="well well-sm col-md-8 col-md-offset-4" style="margin-bottom: 0px; background-color: #1ea896; border-radius: 30px">
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
                <input type="hidden" name="trigger" value="{{$trigger}}"/>
                <button class="btn btn-pink col-md-4 col-md-offset-4" type="submit" id="sendBtn" style="margin-top: 10px">Send</button>
            </form>
        </div>
    </div>
@endsection

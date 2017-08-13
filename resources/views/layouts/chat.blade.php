<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
      <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Talk Message</title>


    <link rel="stylesheet" href="{{asset('chat/css/reset.css')}}">

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="{{asset('chat/css/style.css')}}">




  </head>

  <body>
<div class="header">
    <div class="container header-brand">
        <a href="{{url('/home')}}" class="brand">Talk Message</a>
    </div>
</div>
      <div class="container clearfix body">
   @include('partials.peoplelist')




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

        var msgshow = function(data) {data.sender.name
            var html = '<li id="message-' + data.id + '">' +
            '<div class="message-data">' +
            '<span class="message-data-name"> <a href="#" class="talkDeleteMessage" data-message-id="' + data.id + '" title="Delete Messag"><i class="fa fa-close" style="margin-right: 3px;"></i></a>' +  + '</span>' +
            '<span class="message-data-time">1 Second ago</span>' +
            '</div>' +
            '<div class="message my-message">' +
            data.message +
            '</div>' +
            '</li>';

            $('#talkMessages').append(html);
        }

    </script>
{{--    {!! talk_live(['user'=>["id"=>auth()->user()->id, 'callback'=>['msgshow']]]) !!}--}}

  </body>
</html>

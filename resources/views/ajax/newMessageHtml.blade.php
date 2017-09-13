<script>
    var objDiv = document.getElementById("talkMessages");
    objDiv.scrollTop = objDiv.scrollHeight;
</script>
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
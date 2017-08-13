<div class="row" style="background-color: #1ea896; margin-left: 10px; margin-right: 10px; border-radius: 20px">
    @foreach($threads as $inbox)
        @if(!is_null($inbox->thread))
        <a href="{{route('message.read', ['id'=>$inbox->withUser->id])}}">
        <div class="col-md-12" id="convoSelect" style="margin-bottom: 10px; margin-top: 10px; border-radius:20px">
            <img src="{{'/avatars/' . $inbox->withUser->avatar}}" alt="avatar" style="width: 50px;height: 50px;border-radius:50px;" />

            <div style="color: white;"><strong>{{$inbox->withUser->name}}</strong></div>
            <div style="color: white;">
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
<div class="list-group" style="margin-bottom: 0;">
    <a href="/discover" class="profileNavLink">
        <div class="list-group-item profileNav" style="font-weight: bold;">
            New Message
        </div>
    </a>
</div>

<div class="media" style="background-color: #4c5454; margin-left: 2px; margin-right: 2px; margin-top:0">
    @foreach($threads as $inbox)
        @if(!is_null($inbox->thread))
        <a href="{{route('message.read', ['id'=>$inbox->withUser->id])}}">
        <div class="col-md-12 list-group-item convoSelect">
            <div class="media-left">
                <img src="{{'/avatars/' . $inbox->withUser->avatar}}" alt="avatar" style="margin-top: 5px;width: 50px;height: 50px;border-radius:50px;" />
            </div>
            <div class="media-body">
                <div class="media-heading" style="color: white;"><strong>{{$inbox->withUser->name}}</strong></div>
                <div style="color: white;">
                    @if(auth()->user()->id == $inbox->thread->sender->id)
                        <span class="fa fa-reply"></span>
                    @endif
                    <span>{{substr($inbox->thread->message, 0, 20)}}</span>
                </div>
            </div>
        </div>
        </a>
    @endif
    @endforeach
</div>

<div class="list-group" style="margin-bottom: 0;">
    <a href="/messages" class="profileNavLink">
        <div class="list-group-item profileNav" style="font-weight: bold;">
            View All Messages
        </div>
    </a>
</div>
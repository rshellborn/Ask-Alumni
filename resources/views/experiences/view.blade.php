@extends('layouts.maincontent')

@section('scripts')
    <script type="text/javascript">
        $(function(){
            $('#up-vote').click(function(e){
                e.preventDefault();

                $('#up-vote').hide();
                $('<img id="up-vote" src=" {{url('/thumbsupfilled.png') }}"/>').appendTo('#filled');
                $likes = parseInt($('input[name="likes"]').val());
                $('#likes').text($likes + 1);

                var threadId = $('input[name="threadID"]').val();
                var userId = $('input[name="userID"]').val();
                var authorId = $('input[name="authorID"]').val();
                console.log(threadId);
                console.log(userId);
                console.log(authorId);
                var data = { thread: threadId, user: userId, author: authorId };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'/post/experience_vote_up',
                    type:'POST',
                    data:JSON.stringify(data),
                    contentType:"application/json",
                    processData:false,
                    success:function(data){
                    },
                    error:function(data, error, info){
                        console.log('error ' +info);
                    }
                });
            })
        });
    </script>
@endsection

@section('title')
    {{$experience->title}}
@endsection

@section('content')
    @if(Auth::user()->id == $experience->user_id)
        <form class="form-horizontal" role="form" method="GET" action="{{ url('experiences/edit/' . $id) }}">
            <button class="btn btn-pink">Edit this Experience</button>
        </form>
    @endif

    <div class="text-right">
        <h4>Like this Experience? Give it a thumbs up!</h4>
        @if(Auth::guest())
            <p>Login to vote.</p>
        @endif
        <input type="hidden" name="threadID" value="{{$experience->id}}"/>
        <input type="hidden" name="authorID" value="{{$experience->user_id}}"/>
        <input type="hidden" name="userID" value="{{\Auth::id()}}"/>
        <input type="hidden" name="likes" value="{{ $experience->up_votes }}"/>
        <div class="text-right col-md-2" style="float:right;">
            @if(Auth::guest())
                <img src=" {{url('/thumbsup.png') }}"/>&nbsp;
            @elseif(DB::table('experiences')->where('id', $experience->id)->where('users', 'like', '%'.\Auth::id().'%')->count() == 0)
                <div id="filled" style="display:inline;"></div>
                <img id="up-vote"  style="cursor: pointer;" src=" {{url('/thumbsup.png') }}"/>&nbsp;
            @else
                <img src=" {{url('/thumbsupfilled.png') }}"/>&nbsp;
            @endif
            <h4 id="likes" style="font-weight: bold; float:right;">{{ $experience->up_votes }}</h4>
        </div>
    </div>

    <div class="col-md-12">
        {!! $experience->body !!}
    </div>

    <div class="col-md-10">
        <br/>
        <span>Posted by <i><a href="{{ url("profile/" . $user->id) }}">{{ $user->name }}</a></i></span><br/>

        {{ $experience->schools }}<br/>
        {{ $experience->fields }}<br/>
        {{ $experience->degrees }}
    </div>
@endsection

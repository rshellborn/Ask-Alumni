@extends('layouts.maincontent')

@section('title')
    Favourites
@endsection

@section('content')
    <h4 class="text-right" style="font-weight: bold">{{$favourites}}
        @if($favourites==1)
            favourite
        @else
            favourites
        @endif
    </h4>
    <br/>
    @if($favourites != 0)
        @foreach($users as $user)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="col-md-2">
                        <img src="{{url('/avatars/' . $user->avatar)}}" style="width: 80px; height: 80px; border-radius:50px;margin:10px" />
                    </div>
                    <div class="col-md-8">
                        <h4><a href="{{ url("profile/view/" . $user->id) }}" style="text-decoration: underline;">{{  $user->name }}</a></h4>
                        <h5 style="margin-bottom: 0">{{ $user->type }}</h5>
                        <img width="25px" src="{{url(strtolower($user->rank) . '-cap.png')}}" /><span> {{ $user->points }} points</span>
                    </div>
                    <div class="col-md-2">
                        <form role="form" method="POST" action="{{url('/profile/removefavourite') }}">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$user->id}}" name="user"/>
                            <input type="hidden" value="true" name="return"/>
                            <button type="submit" class="btn btn-sm pull-right">X</button>
                        </form>
                        <a href="{{route('message.read', ['id'=>$user->id])}}" class="btn btn-pink pull-right" style="margin-top: 25px">Message</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <hr class="thick-hr"/>
                </div>
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="text-center">{{ $users->links() }}</div>
    </div>
@endsection

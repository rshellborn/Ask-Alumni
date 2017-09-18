@extends('layouts.maincontent')

@section('styles')
    <style>
        .btn-grey {
        background-color: #4c5454;
        border-color: #4c5454;
        color: white;
        }
        .btn-grey:hover {
        background-color: #464b4e;
        border-color: #464b4e;
        color: white;
        }
    </style>
@endsection

@section('title')
    Favourites
@endsection

@section('content')
    @if($favourites != 0)
    <h4 class="text-right" style="font-weight: bold">{{$favourites}}
        @if($favourites==1)
            favourite
        @else
            favourites
        @endif
    </h4>
    @endif
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
                            <button type="submit" class="btn btn-sm pull-right btn-grey">X</button>
                        </form>
                        <a href="{{route('message.read', ['id'=>$user->id, 'trigger'=>'favourites'])}}" class="btn btn-pink pull-right" style="margin-top: 25px">Message</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <hr class="thick-hr"/>
                </div>
            </div>
        @endforeach
    @else
        <div class="row text-center">
            <div class="col-md-12">
                <h4>Add favourites by clicking on the star on someone's profile.</h4>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <img src="{{url('bookmarking.png')}}" class="img-responsive" />
            </div>
            <div class="col-md-12">
                <h4>View them here later to start a conversation with them.</h4>
            </div>
        </div>
    @endif
    <div class="row">
        @if($favourites != 0)
        <div class="text-center">{{ $users->links() }}</div>
        @endif
    </div>
@endsection

@extends('layouts.maincontent')

@section('title')
    Results
@endsection

@section('content')
    <h4 class="text-right" style="font-weight: bold">{{$totalResults}}
        @if($totalResults == 1)
            result found
        @else
            results found
        @endif
    </h4>
    <br/>
    @foreach($results as $user)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-2">
                    <img src="{{url('/avatars/' . $user->avatar)}}" style="width: 80px; height: 80px; border-radius:50px;margin:10px" />
                </div>
                <div class="col-md-8">
                    <h4><a href="{{ url("profile/view/" . $user->id) }}" style="text-decoration: underline;">{{  $user->name }}</a></h4>
                    <h5>{{ $user->type }}</h5>
                    <strong>Post secondary institutions:</strong> {{$user->schools}}<br/>
                    <strong>Fields of study:</strong> {{$user->fields}}<br/>
                    <strong>Degrees:</strong> {{$user->degrees}}<br/>
                    <strong>High school:</strong> {{$user->highSchool}}
                </div>
                <div class="col-md-2">
                    @if($user->allowMessage || $user->allowMessage === null)
                    <a href="{{route('message.read', ['id'=>$user->id, 'trigger'=>'discover'])}}" class="btn btn-pink pull-right">Message</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <hr class="thick-hr"/>
        </div>
    @endforeach

    <div class="col-md-4 col-md-offset-4">
        <div class="text-center">{{ $results->appends($_REQUEST)->render() }}</div>
    </div>
@endsection

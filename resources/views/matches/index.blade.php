@extends('layouts.maincontent')

@section('title')
    Matches
@endsection

@section('subtitle')
    @if(DB::table('users')->where('id', Auth::id())->value('type') == 'Alumni')
        These high school students are interested in your school, degree, or field of study.<br/>
                                      Help them out by sending them a message!
    @elseif(DB::table('users')->where('id', Auth::id())->value('type') == 'Student')
        These Alumni have information on schools, degrees, and fields of study you are interested in.<br/>
                                      Send them a message!
    @endif
@endsection

@section('content')
    <h4 class="text-right" style="font-weight: bold">{{$totalMatches}}
        @if($totalMatches==1)
            match
        @else
            matches
        @endif
    </h4>
    <br/>
    @foreach($matches as $match)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-2">
                    <img src="{{url('/avatars/' . $match->avatar)}}" style="width: 80px; height: 80px; border-radius:50px;margin:10px" />
                </div>
                <div class="col-md-8">
                    <h4><a href="{{ url("profile/view/" . $match->user_id) }}" style="text-decoration: underline;">{{  $match->user_name }}</a></h4>
                    <strong>Matched on post secondary institutions: </strong>
                    @foreach($match->schoolMatches as $school)
                        <span>{{ $school }}, </span>
                    @endforeach
                    <br/>
                    <strong>Matched on fields of study: </strong>
                    @foreach($match->fieldMatches as $field)
                        <span>{{ $field }}, </span>
                    @endforeach
                    <br/>
                    <strong>Matched on degrees: </strong>
                    @foreach($match->degrees as $degree)
                        <span>{{ $degree }}, </span>
                    @endforeach
                    <br/>
                    <span><strong>Matched on same high school: </strong>{{ $match->highSchool }}</span>
                </div>
                <div class="col-md-2">
                    @if($match->allowMessage || $match->allowMessage === null)
                    <a href="{{route('message.read', ['id'=>$match->user_id, 'trigger'=>'matches'])}}" class="btn btn-pink pull-right">Message</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <hr class="thick-hr"/>
        </div>
    @endforeach

    <div class="col-md-4 col-md-offset-4">
        <div class="text-center">{{ $matches->links() }}</div>
    </div>
@endsection

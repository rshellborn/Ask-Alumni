@extends('layouts.maincontent')

@section('title')
    Matches
@endsection

@section('content')
    <div class="row text-center">
        <div class="col-md-12">
            <h4><strong>
                @if(DB::table('users')->where('id', Auth::id())->value('type') == 'Alumni')
                    High school students need your help!
                @elseif(DB::table('users')->where('id', Auth::id())->value('type') == 'Student')
                    Need advice or information for your post secondary journey?
                @endif
            </strong></h4>
            <h4>
                @if(DB::table('users')->where('id', Auth::id())->value('type') == 'Alumni')
                    Find high school students that are interested in your school, degree, or field of study.
                @elseif(DB::table('users')->where('id', Auth::id())->value('type') == 'Student')
                    Find Alumni that have information on schools, degrees, and fields of study you are interested in.
                @endif
            </h4>
            <br/>
            <div class="col-md-6 col-md-offset-3">
                <img src="{{url('matches.png')}}" class="img-responsive" />
                <br/>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/matches') }}">
                    {{ csrf_field() }}
                    <button class="btn btn-pink" type="submit">Get Matches</button>
                </form>
            </div>
        </div>
    </div>
@endsection

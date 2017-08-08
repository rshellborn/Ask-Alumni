@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h4><strong>Matches</strong></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="container">
                            @foreach($matches as $match)
                                <div class="col-md-7">
                                    <div class="col-md-10">
                                        <h4><a href="{{ url("profile/view/" . $match->user_id) }}">{{  $match->user_name }}</a></h4>
                                        <span>Matched on fields of study: </span>
                                        @foreach($match->fieldMatches as $field)
                                            <span>{{ $field }}</span>
                                        @endforeach
                                        <br/>
                                        <span>Matched on schools: </span>
                                        @foreach($match->schoolMatches as $school)
                                            <span>{{ $school }}</span>
                                        @endforeach
                                        <br/>
                                        <span>Matched on degrees: </span>
                                        @foreach($match->degrees as $degree)
                                            <span>{{ $degree }}</span>
                                        @endforeach
                                        <br/>
                                        <span>Matched on same high school: {{ $match->highSchool }}</span>
                                    </div>
                                    <div class="col-md-2">
                                        <form role="form" method="POST" action="{{ url('/messages/create') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $match->user_id }}" name="user" />
                                            <input type="hidden" value="matches" name="trigger" />
                                            <button class="btn btn-primary">Message</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">{{ $matches->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

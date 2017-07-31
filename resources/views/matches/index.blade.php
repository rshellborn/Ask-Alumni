@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h3><strong>Alumni Matches</strong></h3>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="container">
                            @foreach($matches as $match)
                                <div class="col-md-12">
                                    <h4><a href="{{ url("profile/" . $match->user_id) }}">{{  $match->user_name }}</a></h4>
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
                                    <span>Matched on same high school: {{ $match->highSchool }}</span>
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

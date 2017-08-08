@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h4><strong>Results</strong></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="container">
                            @foreach($results as $user)
                                <div class="col-md-7">
                                    <div class="col-md-10">
                                        <h4><a href="{{ url("profile/view/" . $user->id) }}">{{  $user->name }}</a></h4>
                                        <p><strong>Post secondary institutions:</strong> {{$user->schools}}</p>
                                        <p><strong>Fields of study:</strong> {{$user->fields}}</p>
                                        <p><strong>Degrees:</strong> {{$user->degrees}}</p>
                                        <p><strong>High school:</strong> {{$user->highSchool}}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <form role="form" method="POST" action="{{ url('/messages/create') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $user->id }}" name="user" />
                                            <input type="hidden" value="search" name="trigger" />
                                            <button class="btn btn-primary">Message</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center">{{ $results->appends($_REQUEST)->render() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

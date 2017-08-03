@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h3><strong>Alumni Results</strong></h3>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="container">
                            @foreach($results as $user)
                                <div class="col-md-12">
                                    <h4><a href="{{ url("profile/" . $user->id) }}">{{  $user->name }}</a></h4>
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

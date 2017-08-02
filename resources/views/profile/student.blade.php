@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-md-10">
                        <h3><strong>{{ $name }}</strong></h3>
                    </div>

                    <div class="col-md-1">
                        <h3>Student</h3>
                    </div>
                    <hr>
                </div>

                <div class="panel-body">
                    @if($usersProfile)
                        <form class="form-horizontal" role="form" method="GET" action="{{ url($url) }}">
                            <button class="btn btn-success">Edit Profile</button>
                        </form>
                    @endif

                    <p>Attends {{ $highSchool }}</p>

                    <p>Schools interested in: </p>
                    <ul>
                        @foreach($schools as $school)
                            <li>{{$school}}</li>
                        @endforeach
                    </ul>

                    <p>Fields of study interested in: </p>
                    <ul>
                        @foreach($fields as $field)
                            <li>{{$field}}</li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="row">
                            <div class="col-md-10">
                                <img src="//www.gravatar.com/avatar/{{ md5($email) }} ?s=128" alt="{{ $name }}" class="">
                            </div>
                            <div class="col-md-2">
                                @if($usersProfile)
                                    <button class="btn btn-success" onclick="window.location='{{ url('/profile/edit') }}'">Edit Profile</button>
                                @endif

                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/messages/create') }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $id }}" name="user" />
                                    <input type="hidden" value="profile" name="trigger" />
                                    @if($id != Auth::user()->id)
                                        <button class="btn btn-primary">Message</button>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <h3><strong>{{ $name }}</strong></h3>
                            </div>

                            <div class="col-md-1">
                                <h3>Student</h3>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div>
                            <img style="display:inline;" src="{{ url(strtolower($rank) . '-cap.png') }}" />
                            <p style="display:inline;"><strong>Rank {{ $rank }} - {{$points}} points</strong></p>
                        </div>

                        <p>Attends {{ $highSchool }}</p>

                        <p>Schools interested in: </p>
                        <ul>
                            @foreach($schools as $school)
                                <li>{{$school}}</li>
                            @endforeach
                        </ul>

                        <p>Degrees interested in: </p>
                        <ul>
                            @foreach($degrees as $degree)
                                <li>{{$degree}}</li>
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

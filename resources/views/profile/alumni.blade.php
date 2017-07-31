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
                        <h3>Alumni</h3>
                    </div>
                    <hr>
                </div>

                <div class="panel-body">
                    @if($usersProfile)
                        <form class="form-horizontal" role="form" method="GET" action="{{ url($url) }}">
                            <button class="btn btn-success">Edit Profile</button>
                        </form>
                    @endif

                    <p>Graduated from {{ $highSchool }}</p>

                    @if(!$inSchool)
                        <p>Has graduated.</p>
                    @else
                        <p>Currently attending a post-secondary institution.</p>
                    @endif

                    <p>Schools attended: </p>
                    <ul>
                        @foreach($schools as $school)
                            <li>{{$school}}</li>
                        @endforeach
                    </ul>

                    <p>Degrees: </p>
                    <ul>
                        @foreach($degrees as $degree)
                            <li>{{$degree}}</li>
                        @endforeach
                    </ul>

                    <p>Fields of study: </p>
                    <ul>
                        @foreach($fields as $field)
                            <li>{{$field}}</li>
                        @endforeach
                    </ul>

                    <p>{{ $bio }}</p>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/messages/create') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $id }}" name="user" />
                        @if($allowMessage && $id != Auth::user()->id)
                            <button class="btn btn-primary">Direct Message</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('scripts')
    @if($displayModal)
        <script>
            $('#myModal').modal('show');
        </script>
    @endif
@endsection

@section('content')
        <!-- Trigger the modal with a button -->
        {{--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>--}}

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Congratulations! You've earned 10 points.</h4>
                    </div>
                    <div class="modal-body">
                        <p>You just earned 10 points for registering!</p>
                    </div>
                    <div class="modal-footer text-center">
                        <button class="btn btn-success" onclick="window.location='{{ url('/pointsystem') }}'">What are points?</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>



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

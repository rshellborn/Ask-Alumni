@extends('layouts.app')

@section('scripts')
    <script>
        $("#alumni").hide();
        $("#student").hide();

        $( "#tabAll" ).click(function() {
            $("#alumni").hide();
            $("#student").hide();
            $("#all").show();

            $('#liAll').addClass('active');
            $('#liAlumni').removeClass('active');
            $('#liStudent').removeClass('active');
        });

        $( "#tabAlumni" ).click(function() {
            $("#alumni").show();
            $("#student").hide();
            $("#all").hide();

            $('#liAll').removeClass('active');
            $('#liAlumni').addClass('active');
            $('#liStudent').removeClass('active');
        });

        $( "#tabStudent" ).click(function() {
            $("#alumni").hide();
            $("#student").show();
            $("#all").hide();

            $('#liAll').removeClass('active');
            $('#liAlumni').removeClass('active');
            $('#liStudent').addClass('active');
        });

        $( "#filter" ).click(function() {
            $('#myModal').modal('show');
        });
    </script>
@endsection

@section('modal')
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header" style="background-color: #1ea896; color: white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Find Top Users By Post Secondary Institution</strong></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/rankings') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div id="fields" class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <select name="school" class="form-control">
                                        @foreach($schools as $school)
                                            <option value="{{ $school }}">{{ $school }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div id="fields" class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button class="btn btn-pink" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body')
    <ul class="nav nav-pills nav-justified">
        <li id="liAlumni"><a href="#" id="tabAlumni">Alumni Users</a></li>
        <li id="liAll" class="active"><a href="#" id="tabAll">All Users</a></li>
        <li id="liStudent"><a href="#" id="tabStudent">Student Users</a></li>
    </ul>
    <br/>
    <div id="all">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #1ea896; color: white">
                        <div class="text-center">
                            @if(!empty($filterSchool))
                                <h4><strong>Top Users for {{$filterSchool}}</strong></h4>
                            @else
                                <h4><strong>Top Users</strong></h4>
                            @endif
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <button class="btn btn-pink pull-left" style="margin-left: 10px; margin-bottom: 10px" id="filter">Top users by post secondary institution</button>
                            <button class="btn btn-pink pull-right" style="margin-right: 10px; margin-bottom: 10px" onclick="window.location='{{ url('/pointsystem') }}'">How do I earn points?</button>
                        </div>

                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Type</th>
                                <th>Rank</th>
                                <th>Points</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allUsers as $user)
                                <tr>
                                    <td><a href="{{'profile/view/' . $user->id}}">{{$user->name}}</a></td>
                                    <td>{{$user->type}}</td>
                                    <td>{{$user->rank}}</td>
                                    <td>{{$user->points}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="alumni">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #1ea896; color: white">
                        <div class="text-center">
                            <h4><strong>Top Alumni Users</strong></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="text-right">
                            <button class="btn btn-pink" onclick="window.location='{{ url('/pointsystem') }}'">How do I earn points?</button>
                        </div>

                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Rank</th>
                                <th>Points</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($alumniUsers as $user)
                                <tr>
                                    <td><a href="{{'profile/view/' . $user->id}}">{{$user->name}}</a></td>
                                    <td>{{$user->rank}}</td>
                                    <td>{{$user->points}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="student">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #1ea896; color: white">
                        <div class="text-center">
                            <h4><strong>Top Student Users</strong></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="text-right">
                            <button class="btn btn-pink" onclick="window.location='{{ url('/pointsystem') }}'">How do I earn points?</button>
                        </div>

                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Rank</th>
                                <th>Points</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($studentUsers as $user)
                                <tr>
                                    <td><a href="{{'profile/view/' . $user->id}}">{{$user->name}}</a></td>
                                    <td>{{$user->rank}}</td>
                                    <td>{{$user->points}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

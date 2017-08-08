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

    </script>
@endsection

@section('content')
    <div class="container">
        <ul class="nav nav-pills nav-justified">
            <li id="liAlumni"><a href="#" id="tabAlumni">Alumni Users</a></li>
            <li id="liAll" class="active"><a href="#" id="tabAll">All Users</a></li>
            <li id="liStudent"><a href="#" id="tabStudent">Student Users</a></li>
        </ul>
        <br/>
        <div class="text-right">
            <button class="btn btn-success" onclick="window.location='{{ url('/pointsystem') }}'">How do I earn points?</button>
        </div>
    </div>
    <br/>

    <div class="container" id="all">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h4><strong>Top Users</strong></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Rank</th>
                                <th>Points</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allUsers as $user)
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

    <div class="container" id="alumni">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h4><strong>Top Alumni Users</strong></h4>
                        </div>
                    </div>
                    <div class="panel-body">
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


    <div class="container" id="student">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h4><strong>Top Student Users</strong></h4>
                        </div>
                    </div>
                    <div class="panel-body">
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

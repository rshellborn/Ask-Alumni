@extends('layouts.maincontent')

@section('title')
    <button class="btn btn-default" onclick="window.location='{{ url('reports/contacts') }}'">Contact Messages</button><br/><br/>
    <button class="btn btn-default" onclick="window.location='{{ url('reports/logs/App') }}'">App Log</button>
    <button class="btn btn-default" onclick="window.location='{{ url('reports/logs/Worker') }}'">Worker Log</button>
    <button class="btn btn-default" onclick="window.location='{{ url('reports/logs/Scheduler') }}'">Scheduler Log</button>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading text-center"><h4>Users</h4></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-3 text-center">
                        <button class="btn btn-primary" onclick="window.location='{{ url('reports/users') }}'">Browse Users</button>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="panel panel-primary">
                            <div class=panel-heading>
                                <h3 class=panel-title>Completed</h3>
                            </div>
                            <div class=panel-body>
                                {{$completed}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="panel panel-primary">
                            <div class=panel-heading>
                                <h3 class=panel-title>Verified</h3>
                            </div>
                            <div class=panel-body>
                                {{$registered}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="panel panel-primary">
                            <div class=panel-heading>
                                <h3 class=panel-title>Registered</h3>
                            </div>
                            <div class=panel-body>
                                {{$users}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 text-center">
                        <div class="panel panel-primary">
                            <div class=panel-heading>
                                <h3 class=panel-title>Students</h3>
                            </div>
                            <div class=panel-body>
                                {{$students}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="panel panel-primary">
                            <div class=panel-heading>
                                <h3 class=panel-title>Alumni</h3>
                            </div>
                            <div class=panel-body>
                                {{$alumni}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="panel panel-primary">
                            <div class=panel-heading>
                                <h3 class=panel-title>Provider Counts</h3>
                            </div>
                            <div class="text-left panel-body">
                                Facebook: {{$fb}}<br/>
                                Twitter: {{$tw}}<br/>
                                Google: {{$go}}<br/>
                                Ask Alumni: {{$aa}}<br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading text-center"><h4>Forums</h4></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-3 text-center">
                        <button class="btn btn-success" onclick="window.location='{{ url('reports/forums') }}'">Browse Forums</button>
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="panel panel-success">
                            <div class=panel-heading>
                                <h3 class=panel-title>Threads</h3>
                            </div>
                            <div class=panel-body>
                                {{$forumThreads}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="panel panel-success">
                            <div class=panel-heading>
                                <h3 class=panel-title>Posts</h3>
                            </div>
                            <div class=panel-body>
                                {{$forumPosts}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="panel panel-success">
                            <div class=panel-heading>
                                <h3 class=panel-title>Likes</h3>
                            </div>
                            <div class=panel-body>
                                {{$adviceLikes}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="panel panel-danger">
            <div class="panel-heading text-center"><h4>Messages</h4></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-2 text-center">
                        <button class="btn btn-danger" onclick="window.location='{{ url('reports/messages') }}'">Browse Messages</button>
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="panel panel-danger">
                            <div class=panel-heading>
                                <h3 class=panel-title>Total Convos</h3>
                            </div>
                            <div class=panel-body>
                                {{$conversations}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 text-center">
                        <div class="panel panel-danger">
                            <div class=panel-heading>
                                <h3 class=panel-title>From Discover</h3>
                            </div>
                            <div class=panel-body>
                                {{$fromDiscover}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 text-center">
                        <div class="panel panel-danger">
                            <div class=panel-heading>
                                <h3 class=panel-title>From Matches</h3>
                            </div>
                            <div class=panel-body>
                                {{$fromMatches}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 text-center">
                        <div class="panel panel-danger">
                            <div class=panel-heading>
                                <h3 class=panel-title>From Profile</h3>
                            </div>
                            <div class=panel-body>
                                {{$fromProfile}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 text-center">
                        <div class="panel panel-danger">
                            <div class=panel-heading>
                                <h3 class=panel-title>From Favourites</h3>
                            </div>
                            <div class=panel-body>
                                {{$fromFavourites}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading text-center"><h4>Other</h4></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-3 text-center">
                        <button class="btn btn-warning" onclick="window.location='{{ url('reports/searches') }}'">Browse Searches</button>
                        <button class="btn btn-warning" onclick="window.location='{{ url('reports/blocked') }}'">Browse Blocked Users</button>
                        <button class="btn btn-warning" onclick="window.location='{{ url('reports/reports') }}'">Browse Reported Users</button>
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="panel panel-warning">
                            <div class=panel-heading>
                                <h3 class=panel-title>Searches</h3>
                            </div>
                            <div class=panel-body>
                                {{$searches}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="panel panel-warning">
                            <div class=panel-heading>
                                <h3 class=panel-title>Favourites</h3>
                            </div>
                            <div class=panel-body>
                                {{$favourites}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="panel panel-warning">
                            <div class=panel-heading>
                                <h3 class=panel-title>Blocked Users</h3>
                            </div>
                            <div class=panel-body>
                                {{$blockedUsers}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="panel panel-warning">
                            <div class=panel-heading>
                                <h3 class=panel-title>Reported Users</h3>
                            </div>
                            <div class=panel-body>
                                {{$reports}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

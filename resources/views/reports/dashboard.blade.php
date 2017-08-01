@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Reports</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="col-md-3 text-center">
                                <button class="btn btn-primary" onclick="window.location='{{ url('reports/users') }}'">Browse Users</button>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="panel panel-primary">
                                    <div class=panel-heading>
                                        <h3 class=panel-title>Users</h3>
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
                        </div>


                        <div class="col-md-12">
                            <div class="col-md-3 text-center">
                                <button class="btn btn-success" onclick="window.location='{{ url('reports/forums') }}'">Browse Forums</button>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="panel panel-success">
                                    <div class=panel-heading>
                                        <h3 class=panel-title>Forum Categories</h3>
                                    </div>
                                    <div class=panel-body>
                                        {{$forumCategories}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="panel panel-success">
                                    <div class=panel-heading>
                                        <h3 class=panel-title>Forum Threads</h3>
                                    </div>
                                    <div class=panel-body>
                                        {{$forumThreads}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="panel panel-success">
                                    <div class=panel-heading>
                                        <h3 class=panel-title>Forum Posts</h3>
                                    </div>
                                    <div class=panel-body>
                                        {{$forumPosts}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-3 text-center">
                                <button class="btn btn-danger" onclick="window.location='{{ url('reports/messages') }}'">Browse Messages</button>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="panel panel-danger">
                                    <div class=panel-heading>
                                        <h3 class=panel-title>Conversations</h3>
                                    </div>
                                    <div class=panel-body>
                                        {{$conversations}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="panel panel-danger">
                                    <div class=panel-heading>
                                        <h3 class=panel-title>Messages</h3>
                                    </div>
                                    <div class=panel-body>
                                        {{$messages}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-3 text-center">
                                <button class="btn btn-warning" onclick="window.location='{{ url('reports/advice') }}'">Browse Advice</button>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="panel panel-warning">
                                    <div class=panel-heading>
                                        <h3 class=panel-title>Advice Posts</h3>
                                    </div>
                                    <div class=panel-body>
                                        {{$advicePosts}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="panel panel-warning">
                                    <div class=panel-heading>
                                        <h3 class=panel-title>Comments</h3>
                                    </div>
                                    <div class=panel-body>
                                        {{$comments}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="panel panel-warning">
                                    <div class=panel-heading>
                                        <h3 class=panel-title>Likes</h3>
                                    </div>
                                    <div class=panel-body>
                                        {{$likes}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="panel panel-warning">
                                    <div class=panel-heading>
                                        <h3 class=panel-title>Dislikes</h3>
                                    </div>
                                    <div class=panel-body>
                                        {{$dislikes}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

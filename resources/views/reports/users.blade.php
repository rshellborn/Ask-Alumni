@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center"><h4>User Report</h4></div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Searches</th>
                                <th>Forum Threads</th>
                                <th>Advice Threads</th>
                                <th>Advice Likes</th>
                                <th>Forum Posts</th>
                                <th>Conversations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location='{{ url('profile/view/' . $user->id) }}'">
                                            {{ $user->id }}
                                        </button>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->type }}</td>
                                    <td>{{ \DB::table('search_queries')->where('user_id', $user->id)->count() }}</td>

                                    <?php
                                        $advices = \DB::table('forum_threads')->where('category_id', $adviceCategory)->where('author_id', $user->id)->get();
                                        $adviceLikes = 0;
                                        foreach($advices as $advice) {
                                            $adviceLikes += $advice->likes;
                                        }
                                    ?>

                                    <td>{{\DB::table('forum_threads')->where('author_id', $user->id)->count()}}</td>
                                    <td>{{\DB::table('forum_threads')->where('category_id', $adviceCategory)->where('author_id', $user->id)->count()}}</td>
                                    <td>{{$adviceLikes}}</td>
                                    <td>{{\DB::table('forum_posts')->where('author_id', $user->id)->count()}}</td>
                                    <td>{{\DB::table('messages')->where('user_id', $user->id)->where('trigger', '!=', 'reply')->count()}}</td>
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

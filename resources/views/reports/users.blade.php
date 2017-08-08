@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">User Report</div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Active</th>
                                <th>Forum Threads</th>
                                <th>Forum Posts</th>
                                <th>Messages</th>
                                <th>Advice Posts</th>
                                <th>Comments</th>
                                <th>Likes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <button class="btn btn-primary" onclick="window.location='{{ url('profile/' . $user->id) }}'">
                                            {{ $user->id }}
                                        </button>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->type }}</td>
                                    <td>{{ $user->active }}</td>
                                    <td>{{\DB::table('forum_threads')->where('author_id', $user->id)->count()}}</td>
                                    <td>{{\DB::table('forum_posts')->where('author_id', $user->id)->count()}}</td>
                                    <td>{{\DB::table('messages')->where('user_id', $user->id)->count()}}</td>
                                    <td>{{\DB::table('advice')->where('user_id', $user->id)->count()}}</td>
                                    <td>{{\DB::table('laravellikecomment_comments')->where('user_id', $user->id)->count()}}</td>
                                    <td>{{\DB::table('laravellikecomment_likes')->where('user_id', $user->id)->count()}}</td>
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

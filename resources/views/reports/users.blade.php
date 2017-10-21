@extends('layouts.maincontent')

@section('title')
    User Report
@endsection

@section('content')
    <table class="table table-hover table-responsive text-center">
        <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Email W-M-N</th>
            <th class="text-center">Points</th>
            <th class="text-center">Favourites</th>
            <th class="text-center">Searches</th>
            <th class="text-center">Forum T-L-P</th>
            <th class="text-center">Conversations</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    <button class="btn btn-primary" onclick="window.location='{{ url('profile/view/' . $user->id) }}'">
                    {{ $user->name }}
                    </button><br/>
                    <small>{{ $user->type }}</small><br/>
                    <small>{{ $user->provider }}</small>
                </td>
                <td>
                    {{ $user->email }}<br/>
                    {{ \DB::table('users')->where('id', $user->id)->value('emails-weekly') }} - {{ \DB::table('users')->where('id', $user->id)->value('emails-messages') }} - {{ \DB::table('users')->where('id', $user->id)->value('emails_news') }}
                </td>
                <td>{{ $user->points }}</td>
                <td>{{ $user->favourites }}</td>
                <td>{{ \DB::table('search_queries')->where('user_id', $user->id)->count() }}</td>

                <?php
                    $advices = \DB::table('forum_threads')->where('author_id', $user->id)->get();
                    $adviceLikes = 0;
                    foreach($advices as $advice) {
                        $adviceLikes += $advice->likes;
                    }
                ?>

                <td>{{\DB::table('forum_threads')->where('author_id', $user->id)->count()}}
                 - {{$adviceLikes}} -
                {{\DB::table('forum_posts')->where('author_id', $user->id)->count()}}</td>
                <td>{{\DB::table('conversations')->where('user_one', $user->id)->orWhere('user_two', $user->id)->count()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

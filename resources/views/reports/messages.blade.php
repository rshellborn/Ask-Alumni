@extends('layouts.maincontent')

@section('title')
    Messages Report
@endsection

@section('content')
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>Participants</th>
            <th>Trigger</th>
            <th>Messages</th>
        </tr>
        </thead>
        <tbody>
        @foreach($conversations as $convo)
            <?php
                $users = array();
                $user1 = \DB::table('conversations')->where('id', $convo->id)->pluck('user_one');
                $user2 = \DB::table('conversations')->where('id', $convo->id)->pluck('user_two');

                array_push($users, \DB::table('users')->where('id', $user1)->first());
                array_push($users, \DB::table('users')->where('id', $user2)->first());
            ?>
            <tr>
                <td>
                    @foreach($users as $user)
                        {{ str_replace(array('[', ']', '"'), '', $user->name) }} ({{$user->type}})
                        <br/>
                    @endforeach
                </td>
                <td>{{ DB::table('conversations')->where('id', $convo->id)->value('trigger') }}</td>
                <td>{{ count(\DB::table('messages')->where('conversation_id', $convo->id)->get()) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

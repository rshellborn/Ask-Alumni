@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Messages Report</div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Participants</th>
                                <th>Messages</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($threads as $thread)
                                <?php
                                    $users = \DB::table('participants')->where('thread_id', $thread->id)->get();
                                ?>
                                <tr>
                                    <td>{{ $thread->subject }}</td>
                                    <td>
                                        @foreach($users as $user)
                                            {{ str_replace(array('[', ']', '"'), '', \DB::table('users')->where('id', $user->user_id)->pluck('name')) }}
                                            <br/>
                                        @endforeach
                                    </td>
                                    <td>{{ \DB::table('messages')->where('thread_id', $thread->id)->count() }}</td>
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

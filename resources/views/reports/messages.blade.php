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
                                <tr>
                                    <td>{{ $thread->subject }}</td>
                                    <td>{{ \DB::table('users')->where('id', \DB::table('participants')->where('thread_id', $thread->id)->pluck('user_id')[0])->pluck('name')[0] }} - {{\DB::table('users')->where('id', \DB::table('participants')->where('thread_id', $thread->id)->pluck('user_id')[0])->pluck('type')[0]}}
                                        <br/>
                                        {{ \DB::table('users')->where('id', \DB::table('participants')->where('thread_id', $thread->id)->pluck('user_id')[1])->pluck('name')[0] }} - {{ \DB::table('users')->where('id', \DB::table('participants')->where('thread_id', $thread->id)->pluck('user_id')[1])->pluck('type')[0] }}</td>
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

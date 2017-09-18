@extends('layouts.maincontent')

@section('title')
    Blocked Users
@endsection

@section('content')
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>User</th>
            <th>Blocked By</th>
        </tr>
        </thead>
        <tbody>
        @foreach($blockedUsers as $user)
            <tr>
                <td>{{ $user->user_id }}</td>
                <td>{{ $user->blocked_by }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

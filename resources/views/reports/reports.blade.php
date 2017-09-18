@extends('layouts.maincontent')

@section('title')
    Reported Users
@endsection

@section('content')
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>User</th>
            <th>Reported By</th>
            <th>Reason</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reports as $report)
            <tr>
                <td>{{ $report->reported_user_id }}</td>
                <td>{{ $report->user_id }}</td>
                <td>{{ $report->reason }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

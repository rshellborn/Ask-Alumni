@extends('layouts.maincontent')

@section('title')
    Contact Messages
@endsection

@section('content')
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>User</th>
            <th>Email</th>
            <th>Type</th>
            <th>Message</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->type }}</td>
                <td>{{ $contact->message }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

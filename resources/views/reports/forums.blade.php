@extends('layouts.maincontent')

@section('title')
    Forums Report
@endsection

@section('content')
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>Category</th>
            <th>Threads</th>
            <th>Posts</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $row)
            <tr>
                <td>
                    <button class="btn btn-success" onclick="window.location='{{ url('forum/' . $row['category_id'] . '-' . $row['category_title']) }}'">
                        {{ $row['category_title'] }}
                    </button>
                </td>
                <td>{{ $row['total_threads'] }}</td>
                <td>{{ $row['total_posts'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

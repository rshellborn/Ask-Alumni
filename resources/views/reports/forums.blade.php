@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Forums Report</div>
                    <div class="panel-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

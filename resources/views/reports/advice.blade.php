@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Advice Report</div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Comments</th>
                                <th>Likes</th>
                                <th>Dislikes</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($advice as $post)
                                <tr>
                                    <td>
                                        <button class="btn btn-warning" onclick="window.location='{{ url('advice/' . $post->id) }}'">
                                            {{ $post->title }}
                                        </button>
                                    </td>
                                    <td>{{ \DB::table('laravellikecomment_comments')->where('item_id', $post->id)->count() }}</td>
                                    <td>{{ str_replace(array('[', ']'), '',\DB::table('laravellikecomment_total_likes')->where('item_id', $post->id)->pluck('total_like')) }}</td>
                                    <td>{{ str_replace(array('[', ']'), '',\DB::table('laravellikecomment_total_likes')->where('item_id', $post->id)->pluck('total_dislike')) }}</td>
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

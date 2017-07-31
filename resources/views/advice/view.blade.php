@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><strong>{{ $advice->title }}</strong></h4>
                        @if(Auth::user()->id == $advice->user_id)
                            <form class="form-horizontal" role="form" method="GET" action="{{ url('advice/edit/' . $id) }}">
                                <button class="btn btn-success">Edit</button>
                            </form>
                        @endif
                    </div>

                    <div class="panel-body">
                        <div class="col-md-12">
                            <p>{{ $advice->body }}</p>
                        </div>
                        <div class="col-md-10">
                            <span>Posted by <i><a href="{{ url("profile/" . $user->id) }}">{{ $user->name }}</a></i></span>
                        </div>
                        <div class="col-md-2">
                            @include('laravelLikeComment::like', ['like_item_id' => $id])
                        </div>
                    </div>
                </div>

                {{--Comments--}}

                @include('laravelLikeComment::comment', ['comment_item_id' => $id])
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="{{ asset('/vendor/laravelLikeComment/js/script.js') }}" type="text/javascript"></script>
@endsection

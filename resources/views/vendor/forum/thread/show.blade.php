@extends ('forum::master')

@section ('content')
    <div id="thread">
        <div>
            <h2>
                @if ($thread->trashed())
                    <span class="label label-danger">{{ trans('forum::general.deleted') }}</span>
                @endif
                @if ($thread->locked)
                    <span class="label label-warning">{{ trans('forum::threads.locked') }}</span>
                @endif
                @if ($thread->pinned)
                    <span class="label label-info">{{ trans('forum::threads.pinned') }}</span>
                @endif
                {{ $thread->title }}
            </h2>
            <div class="text-right">
                <h4>Like this thread? Give it a thumbs up!</h4>
                @if(Auth::guest())
                    <p>Login to vote.</p>
                @endif
                <input type="hidden" name="threadID" value="{{$thread->id}}"/>
                <input type="hidden" name="authorID" value="{{$thread->author_id}}"/>
                <input type="hidden" name="userID" value="{{\Auth::id()}}"/>
                <input type="hidden" name="likes" value="{{ $thread->likes }}"/>
                <div class="text-right col-md-2" style="float:right;">
{{--                        {{dd(DB::table('forum_threads')->where('id', $thread->id)->where('users', 'like', '%'.\Auth::id().'%')->count())}}--}}
                    @if(Auth::guest())
                        <img src=" {{url('/thumbsup.png') }}"/>&nbsp;
                    @elseif(DB::table('forum_threads')->where('id', $thread->id)->where('users', 'like', '%'.\Auth::id().'%')->count() == 0)
                        <div id="filled" style="display:inline;"></div>
                        <img id="up-vote"  style="cursor: pointer;" src=" {{url('/thumbsup.png') }}"/>&nbsp;
                    @else
                        <img src=" {{url('/thumbsupfilled.png') }}"/>&nbsp;
                    @endif
                    <h4 id="likes" style="font-weight: bold; float:right;">{{ $thread->likes }}</h4>
                </div>
            </div>
        </div>
<br/>
        <hr>

        @can ('manageThreads', $category)
            <form action="{{ Forum::route('thread.update', $thread) }}" method="POST" data-actions-form>
                {!! csrf_field() !!}
                {!! method_field('patch') !!}

                @include ('forum::thread.partials.actions')
            </form>
        @endcan

        @can ('deletePosts', $thread)
            <form action="{{ Forum::route('bulk.post.update') }}" method="POST" data-actions-form>
                {!! csrf_field() !!}
                {!! method_field('delete') !!}
        @endcan

        <div class="row">
            <div class="col-xs-4">
                @can ('reply', $thread)
                    <div class="btn-group" role="group">
                        <a href="#quick-reply" class="btn btn-pink">{{ trans('forum::general.quick_reply') }}</a>
                    </div>
                @endcan
            </div>
            <div class="col-xs-8 text-right">
                {!! $posts->render() !!}
            </div>
        </div>

        <table class="table {{ $thread->trashed() ? 'deleted' : '' }}">
            <thead>
                <tr>
                    <th class="col-md-2">
                        {{ trans('forum::general.author') }}
                    </th>
                    <th>
                        {{ trans_choice('forum::posts.post', 1) }}
                        @can ('deletePosts', $thread)
                            <span class="pull-right">
                                <input type="checkbox" data-toggle-all>
                            </span>
                        @endcan
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    @include ('forum::post.partials.list', compact('post'))
                @endforeach
            </tbody>
        </table>

        @can ('deletePosts', $thread)
                @include ('forum::thread.partials.post-actions')
            </form>
        @endcan

        {!! $posts->render() !!}

        @can ('reply', $thread)
            <h3>{{ trans('forum::general.quick_reply') }}</h3>
            <div id="quick-reply">
                <form method="POST" action="{{ Forum::route('post.store', $thread) }}">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <textarea name="content" class="form-control">{{ old('content') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-pink pull-right">{{ trans('forum::general.post') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        @endcan
    </div>
@stop

@section ('footer')
    <script>
    $('tr input[type=checkbox]').change(function () {
        var postRow = $(this).closest('tr').prev('tr');
        $(this).is(':checked') ? postRow.addClass('active') : postRow.removeClass('active');
    });
    </script>
@stop

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="{{ asset('/vendor/laravelLikeComment/js/script.js') }}" type="text/javascript"></script>
@endsection
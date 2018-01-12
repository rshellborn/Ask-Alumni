@extends('layouts.maincontent')

@section('title')
    Experiences
@endsection

@section('subtitle')
    Read about alumni experiences at post-secondary.
@endsection

@section('content')
{{--                        @if($user == "Alumni")--}}
        <div class="text-right">
            @if ($type == 'Alumni')
                <button type="submit" class="btn btn-pink" onclick="window.location='{{ url("experiences/new") }}'">Share your Experience</button>
            @endif
        </div>
        {{--@endif--}}
        <div class="container">
            @if(count($posts) === 0)
                <span class="text-center">There are no Experiences posted right now. Share your Experience by clicking the button.</span>
            @else
                @foreach ($posts as $post)
                    <a href="{{ url("experiences/view/" . $post->id) }}" style="text-decoration: none; color: #636b6f;">
                    <div>
                        <h4 style="color: #3fa896"><strong>{{ $post->title }}</strong></h4>
                        <strong>Post secondary institutions:</strong> {{$post->schools}}<br/>
                        <strong>Fields of study:</strong> {{$post->fields}}<br/>
                        <strong>Degrees:</strong> {{$post->degrees}}<br/><br/>

                        <strong>Posted by</strong> {{\DB::table('users')->where('id', $post->user_id)->value('name')}} on {{ substr($post->created_at, 0, 10) }}
                    </div>
                    </a>
                    <br/>
                @endforeach
            @endif


        </div>

        <div class="text-center">{{ $posts->links() }}</div>
@endsection

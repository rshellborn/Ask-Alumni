@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h3><strong>Advice from Alumni</strong></h3>
                        </div>
                      </div>

                    <div class="panel-body">
{{--                        @if($user == "Alumni")--}}
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary" onclick="window.location='{{ url("advice/post") }}'">Post Advice</button>
                        </div>
                        {{--@endif--}}
                        <div class="container">
                            @foreach ($advices as $advice)
                                <h4><a href="{{ url("advice/" . $advice->id) }}">{{ $advice->title }}</a></h4>
                                <p>{{ substr($advice->body,0, 50) }}</p>
                                <br/>
                            @endforeach
                        </div>

                        <div class="text-center">{{ $advices->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

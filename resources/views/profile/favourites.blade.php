@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h4><strong>Favourites</strong></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                        <h4 class="text-success text-center" style="font-weight: bold">You have {{$favourites}}
                            @if($favourites==1)
                                favourite
                            @else
                                favourites
                            @endif
                        </h4>
                        <br/>
                        <div class="container">
                            @foreach($users as $user)
                                <h1>{{$user->name}}</h1>
                            @endforeach
                        </div>
                        {{--<div class="text-center">{{ $matches->links() }}</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

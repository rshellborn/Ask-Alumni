@extends('layouts.app')

@section('body')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #ff715b; color: white">
                <div class="text-center">
                    <h4><strong>@yield('title')</strong></h4>
                    <span>@yield('subtitle')</span>
                </div>
            </div>
            <div class="panel-body">
                @yield('content')
            </div>
        </div>
    </div>
@endsection
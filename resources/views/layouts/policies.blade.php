@extends('layouts.app')

@section('auth')
    <div class="col-md-6 col-md-offset-3">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #1ea896; color: white">
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
    </div>
@endsection
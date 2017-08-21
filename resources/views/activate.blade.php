@extends('layouts.maincontent')

@section('title')
    Account Activation
@endsection

@section('content')
    <div class="form-group">
        <div class="col-md-8 col-md-offset-2 text-center">
            <p>Your account has been activated. You may login now.</p>
            <br/>
            <button class="btn btn-pink col-md-3 col-md-offset-4" onclick="window.location='{{ url('/login') }}'">Login</button>
        </div>
    </div>
@endsection

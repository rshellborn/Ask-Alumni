@extends('layouts.authcontent')

@section('title')
    Login
@endsection

@section('content')
    @if(session()->has('registered'))
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="alert alert-info text-center" role="alert">
                    <span>{{session()->get('registered')}}</span>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-5">
            <div class="col-md-12" style="margin-bottom: 10px;">
                <a class="btn btn-block btn-social btn-facebook" href="{{ url('/auth/facebook') }}">
                    <span class="fa fa-facebook"></span>
                    Sign in with Facebook
                </a>
            </div>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <a class="btn btn-block btn-social btn-twitter" href="{{ url('/auth/twitter') }}">
                    <span class="fa fa-twitter"></span>
                    Sign in with Twitter
                </a>
            </div>
            <div class="col-md-12" style="margin-bottom: 10px;">
                <a class="btn btn-block btn-social btn-google" href="{{ url('/auth/google') }}">
                    <span class="fa fa-google"></span>
                    Sign in with Google
                </a>
            </div>
        </div>

        <div class="col-md-7">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-md-10 col-md-offset-1">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="margin-bottom: 0">
                    <div class="col-md-10 col-md-offset-1">
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 0">
                    <div class="col-md-10 col-md-offset-1">
                        <button type="submit" class="btn btn-pink btn-block">
                            Login
                        </button>
                    </div>
                </div>
                <div class="row text-center">
                    <small>
                        <a href="{{ url('/register') }}">Register</a>
                        &bull;
                        <a href="{{ url('/password/reset') }}">Forgot Password</a>
                    </small>
                </div>
            </form>
        </div>
    </div>
@endsection

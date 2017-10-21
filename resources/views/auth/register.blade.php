@extends('layouts.authcontent')

@section('title')
    Register
@endsection

@section('scripts')
    <script>
        function onSubmit(token) {
            document.getElementById("registerForm").submit();
        }
    </script>
@endsection

@section('gCaptcha')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('content')
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
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" id="registerForm">
                {{ csrf_field() }}

                @if(!empty($referral_code))
                    <input type="hidden" name="referral_code" value="{{$referral_code}}" />
                @endif

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="col-md-10 col-md-offset-1">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-md-10 col-md-offset-1">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-1">
                        <button class="btn btn-pink btn-block g-recaptcha"
                                data-sitekey="6Lc-Zi4UAAAAAJdiGPQs-xUxeqmRitXasgls6roi"
                                data-callback='onSubmit'>
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>


        <div class="text-center">
            <small><a href="mailto:contact@askalumni.ca">Issues signing up? Contact us at contact@askalumni.ca</a></small>
        </div>
    </div>
@endsection

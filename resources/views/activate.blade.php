@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Account Activation</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2 text-center">
                                <p>Your account has been activated. You may login now.</p>
                                <br/>
                                <button class="btn btn-success col-md-3 col-md-offset-4" onclick="window.location='{{ url('/login') }}'">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

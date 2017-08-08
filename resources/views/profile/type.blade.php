@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h4><strong>Account Type</strong></h4>
                        </div>
                    </div>
                    <div class="panel-body text-center">
                        <h4>Are you currently a high school student or an Alumni?</h4>
                        <br/>
                        <div class="col-md-8 col-md-offset-2">
                            <button class="btn btn-primary btn-block" onclick="window.location='{{ url('/profile/complete/student') }}'">High School Student</button>
                        <br/>
                            <button class="btn btn-primary btn-block" onclick="window.location='{{ url('/profile/complete/alumni') }}'">Alumni</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
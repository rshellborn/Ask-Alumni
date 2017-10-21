@extends('layouts.maincontent')

@section('scripts')
    <script>
        $( "#hidden" ).hide();
        $( "#accept" ).click(function() {
            if($("#accept").prop("checked") == true) {
                $( "#hidden" ).show();
            } else {
                $( "#hidden" ).hide();
            }
        });
    </script>
@endsection

@section('title')
    Complete Registration
@endsection

@section('content')
    <div class="col-md-12 text-center">
        <div class="checkbox">
            <label><input type="checkbox" id="accept" value="accepted">I have read and agree to the Ask Alumni </label> <a href="/terms" target="_blank">Terms of Service</a> and <a href="/privacy" target="_blank">Privacy Policy</a>
        </div>
    </div>

    <div class="col-md-12 text-center" id="hidden">
        <h4>Are you currently a high school student or an Alumni?</h4>
        <br/>
        <div class="col-md-8 col-md-offset-2">
            <button class="btn btn-pink btn-block" onclick="window.location='{{ url('/profile/complete/student') }}'">High School Student</button>
        <br/>
            <button class="btn btn-pink btn-block" onclick="window.location='{{ url('/profile/complete/alumni') }}'">Alumni</button>
        </div>
    </div>
@endsection
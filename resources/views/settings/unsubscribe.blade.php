@extends('layouts.maincontent')

@section('title')
    Unsubscribe from Emails
@endsection

@section('content')
    <div class="form-group">
        <div class="col-md-8 col-md-offset-2 text-center">
            <p>Too much spam? You can change your email preferences instead.</p>
            <button class="btn btn-pink" onclick="window.location='{{ url('/settings') }}'">Change email preferences</button>

            <p><br/>Or if you really must...</p>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/unsubscribe') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-warning">
                            Unsubscribe from all emails
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.maincontent')

@section('title')
    Settings
@endsection

@section('content')
    @if(session()->has('updated'))
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="alert alert-success text-center" role="alert">
                    <span>{{session()->get('updated')}}</span>
                </div>
            </div>
        </div>
    @endif

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12 text-center">
                <label for="searchable">Account Settings</label>
            </div>


            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <input type="checkbox" name="unsearchable" value="true" <?php echo $unsearchable ?>> Hide account from being searched<br/>
                    <small>Your account would not be able to be found using the Discover feature.</small>
                    <br/>
                </div>
            </div>
        </div>
        <hr/>

        <div class="row">
            <div class="col-md-12 text-center">
                <label for="searchable">Email Preferences</label>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <input type="checkbox" name="weeklyEmails" value="subscribe" <?php echo $weeklyEmails ?>> Receive weekly notification emails<br/>
                    <small>Bundles all your notifications from the week that are unread into one email.</small>
                    <br/>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <input type="checkbox" name="newMessage" value="subscribe" <?php echo $messageEmails ?>> Receive new message emails<br/>
                    <small>Notifies you when you receive a message.</small>
                    <br/>
                </div>
            </div>
        </div>
        <br/>
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-pink">
                    Save
                </button>
            </div>
        </div>
    </form>
@endsection
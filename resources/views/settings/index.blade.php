@extends('layouts.maincontent')

@section('scripts')
    <script>
        $("#blocking").hide();
        $("#settings").show();

        $( "#main" ).click(function() {
            $("#blocking").hide();
            $("#settings").show();

            $('#main').addClass('active');
            $('#blockedUsers').removeClass('active');
        });

        $( "#blockedUsers" ).click(function() {
            $("#blocking").show();
            $("#settings").hide();

            $('#blockedUsers').addClass('active');
            $('#main').removeClass('active');
        });
    </script>
@endsection

@section('title')
    Settings
@endsection

@section('content')

    <ul class="nav nav-pills nav-justified">
        <li id="main" class="active"><a href="#" id="main">Main Settings</a></li>
        <li id="blockedUsers"><a href="#" id="blockedUsers">Blocked Users</a></li>
    </ul>
    <br/>
    @if(session()->has('updated'))
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="alert alert-success alert-dismissable text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span>{{session()->get('updated')}}</span>
                </div>
            </div>
        </div>
    @endif

    <div id="settings" class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings') }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12 text-center">
                    <label for="searchable">Account Settings</label>
                </div>

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <input type="checkbox" name="unsearchable" value="true" <?php echo $searchable ?>> Allow account to be displayed in a 'Discover' search<br/>
                        <small>Disable this if you no longer want your account to be displayed when someone searches using the 'Discover' feature.</small>
                        <br/>
                    </div>
                </div>
                <br/>

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <input type="checkbox" name="allowMessage" value="true" <?php echo $allowMessage ?>> Allow messages<br/>
                        <small>Disable this if you no longer want a 'Message' button to be displayed for your account.<br/>Current conversations will remain open.</small>
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
                        <input type="checkbox" name="weeklyEmails" value="subscribe" <?php echo $weeklyEmails ?>> Receive Weekly Notification emails<br/>
                        <small>Bundles all your unread notifications from the week into one email.</small>
                        <br/>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <input type="checkbox" name="newMessage" value="subscribe" <?php echo $messageEmails ?>> Receive New Message emails<br/>
                        <small>Notifies you when you receive a message.</small>
                        <br/>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <input type="checkbox" name="featureEmails" value="subscribe" <?php echo $featureEmails ?>> Receive New Feature and Update emails<br/>
                        <small>Notifies you when there are new features added or other helpful information about the website.</small>
                        <br/>
                    </div>
                </div>
            </div>
            <br/>
            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-pink col-md-2 col-md-offset-5">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div id="blocking" class="col-md-12">
        @if($blockedUsers != null)
            <p class="text-center">Blocked users will not be able to view your profile, message you, search for you, nor be matched with you.</p>
            @foreach($blockedUsers as $user)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="col-md-10">
                            <h4><a href="{{ url("profile/view/" . $user->id) }}" style="text-decoration: underline;">{{  $user->name }}</a></h4>
                        </div>
                        <div class="col-md-2">
                            <form role="form" method="POST" action="{{url('/unblock/' . $user->id) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-sm pull-right btn-grey">Unblock</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <hr class="thick-hr"/>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center">
                <h4>You have no blocked users</h4>
                <p class="text-center">Blocked users will not be able to view your profile, message you, search for you, nor be matched with you.</p>
            </div>
        @endif
    </div>
@endsection
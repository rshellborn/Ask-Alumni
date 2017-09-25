@extends('layouts.maincontent')

@section('styles')
    <style>
        .panel-default > .panel-heading{
            background-color: #f7f7f7;
        }
        .panel-default > .panel-heading:hover{
            cursor: pointer;
            font-weight: bold;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $('#collapseOne').collapse("hide");
        $('#collapseFour').collapse("hide");
        $('#collapseEight').collapse("hide");
    </script>
@endsection

@section('title')
    Frequently Asked Questions
@endsection

@section('content')
    <h4 class="text-center"><strong>General</strong></h4>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                <h4 class="panel-title">
                    What is Ask Alumni?
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <p>Ask Alumni is a social network where high school students can get advice about post-secondary and Alumni can share their experiences.</p>

                    <p>The purpose of this site is to make a bridge to allow high school students to get in contact with
                        Alumni and get personal experiences and answers to their questions.</p>

                    <div class="col-md-6">
                        <h4 class="text-center"><strong>Benefits for Students</strong></h4>
                        <ul>
                            <li>Ask questions to Alumni who are attending post-secondary schools, studying in fields, and pursuing degrees you are interested in</li>
                            <li>Discuss with other high school students</li>
                            <li>Get personal advice from Alumni</li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h4 class="text-center"><strong>Benefits for Alumni</strong></h4>
                        <ul>
                            <li>Share experiences and information with students about schools, fields of study, and degrees they would not be able to get anywhere else</li>
                            <li>Give advice to students that will help them in their post-secondary journey</li>
                            <li>Get advice and information from Alumni which are pursuing higher degrees that you are interested in</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h4 class="panel-title">
                    Is there a mobile app?
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    Currently there is no mobile app, but if Ask Alumni becomes popular enough, we are planning to develop a mobile app.
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <h4 class="panel-title">
                    @if(Auth::user()->type == 'Alumni')
                        How do I give advice to high school students?
                    @elseif(Auth::user()->type == 'Student')
                        How do I get advice from alumni?
                    @endif
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    @if(Auth::user()->type == 'Alumni')
                        <p>The best ways to give advice from high school students are through the forums or messages.</p>
                        <p>Browse the <a href="{{url('/forums')}}">forums</a> and look for students asking questions or having discussions on topics which you are knowledgeable about.</p>
                        <p>Start messaging students by finding <a href="{{url('/matches')}}">Matches</a> or searching for students using <a href="{{url('/discover')}}">Discover</a>.</p>
                    @elseif(Auth::user()->type == 'Student')
                        <p>The best ways to get advice from alumni is through the forums or messages.</p>
                        <p>Browse the <a href="{{url('/forums')}}">forums</a> and create a thread to ask questions or find a thread that interests you and join in on discussions.</p>
                        <p>Start messaging alumni by finding <a href="{{url('/matches')}}">Matches</a> or searching for alumni using <a href="{{url('/discover')}}">Discover</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <h4 class="text-center"><strong>Features</strong></h4>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <h4 class="panel-title">
                    What are Matches?
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                    @if(Auth::user()->type == 'Alumni')
                        <p>
                            Matches are a great way for you to find high school students that could benefit from your specfic advice and experiences.
                        </p>
                        <p>
                            These students are interested in your fields of study, post-secondary institutions, degrees, and possibly even attended
                            the same high school as you.
                        </p>

                        <div class="text-center">
                            <a href="{{url('/matches')}}" class="btn btn-pink col-md-2 col-md-offset-5">Find Matches</a>
                        </div>
                    @elseif(Auth::user()->type == 'Student')
                        <p>
                            Matches are a great way for you to find alumni that are able to answer your questions and give you personal experience related to your specific education interests.
                        </p>
                        <p>
                            These alumni are attending post-secondary institutions, in fields of study, and pursuing degrees you are interested in.
                            Some may have even attended the same high school as you.
                        </p>

                        <div class="text-center">
                            <a href="{{url('/matches')}}" class="btn btn-pink col-md-2 col-md-offset-5">Find Matches</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFive" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <h4 class="panel-title">
                    How do I search for someone?
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                <div class="panel-body">
                    <p>
                        You can search for specific people by using <a href="{{url('/discover')}}">Discover</a>.
                        There are two ways to search: by name or by filter.
                    </p>
                    Filters include:
                    <ul>
                        <li>
                            Account type (Alumni or Student)
                        </li>
                        <li>
                            High school
                        </li>
                        <li>
                            Post-secondary institution
                        </li>
                        <li>
                            Fields of study
                        </li>
                        <li>
                            Degrees
                        </li>
                    </ul>
                    <br/>

                    <div class="text-center">
                        <a href="{{url('/discover')}}" class="btn btn-pink col-md-2 col-md-offset-5">Use Discover</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingSix" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                <h4 class="panel-title">
                    How do I message someone?
                </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                <div class="panel-body">
                    There are multiple ways you can start a conversation with someone:
                    <ul>
                        <li>On a users profile</li>
                        <li>From <a href="{{url('/matches')}}">Matches</a></li>
                        <li>From <a href="{{url('/discover')}}">Discover</a></li>
                    </ul>
                    <p>There is a Message button next to a persons name for each result in Matches or Discover, click this button and it will open a window for you to message this person.</p>
                    <p>There are also Message buttons on a person's profile.</p>
                    <small>Some people may have messages disabled for their account, and these buttons will not be visible.</small>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingSeven" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                <h4 class="panel-title">
                    What are points?
                </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                <div class="panel-body">
                    <p>Points are a way to show how active you are on the site. You can compete with other users and see your position in the
                    <a href="{{url('rankings')}}">Rankings.</a></p>
                    <a href="{{url('/pointsystem')}}">Learn how to get points here.</a>
                </div>
            </div>
        </div>
    </div>

    <h4 class="text-center"><strong>My Account</strong></h4>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingEight" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                <h4 class="panel-title">
                    What are Favourites?
                </h4>
            </div>
            <div id="collapseEight" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingEight">
                <div class="panel-body">
                    <p>Favourites allows you to have a personal list of people who you can message or view their profile any time.</p>
                    <p>Your Favourites are only viewable by you and people that you have favourited do not know they are in your Favourites list.</p>
                    <p>To Favourite someone, click on the star on their profile. When the star is filled in with blue, it means they are in your Favourites list. Click the star again to remove them.</p>
                    <p>To view your favourites, you can click the link on the Personal sidebar.</p>

                    <br/>
                    <div class="text-center">
                        <a href="{{url('/favourites')}}" class="btn btn-pink col-md-2 col-md-offset-5">My Favourites</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingNine" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                <h4 class="panel-title">
                    How do I update my profile?
                </h4>
            </div>
            <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                <div class="panel-body">
                    <p>To update your profile, go to your My Profile and click the Edit Profile button. Fill in the information you want
                    to change and click Save.</p>
                    You can change the following when editing your profile:
                    <ul>
                        <li>Profile picture</li>
                        <li>Name</li>
                        <li>High school</li>
                        <li>Post-secondary institutions</li>
                        <li>Fields of study</li>
                        <li>Degrees</li>
                        <li>Bio</li>
                    </ul>
                    If your high school, post-secondary institution, field of study, or degree is not listed. You can enter it in manually by
                     clicking the link below each field.
                    <br/>
                    <div class="text-center">
                        <a href="{{url('/profile/edit')}}" class="btn btn-pink col-md-2 col-md-offset-5">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTen"  data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                <h4 class="panel-title">
                    How do I unsubscribe or manage email preferences?
                </h4>
            </div>
            <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                <div class="panel-body">
                    <p>You can unsubscribe anytime by clicking the Unsubscribe button at the bottom of an email.</p>
                    <p>You can edit your email preferences by going to Settings and unchecking which emails you no longer wish
                    to receive.</p>

                    <br/>
                    <div class="text-center">
                        <a href="{{url('/settings')}}" class="btn btn-pink col-md-2 col-md-offset-5">Settings</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwelve" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                <h4 class="panel-title">
                    How do I block or report someone?
                </h4>
            </div>
            <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
                <div class="panel-body">
                    <p>You can report or block someone by clicking the More button on someone's profile or the down arrow button in
                    a direct message with someone and selecting Block or Report.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingEleven" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                <h4 class="panel-title">
                    How do I delete my account?
                </h4>
            </div>
            <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
                <div class="panel-body">
                    <p>If you wish to delete your account, you will have to request it to be deleted by clicking the button below.</p>
                    <br/>
                    <div class="text-center">
                        <a href="{{url('/profile/delete')}}" class="btn btn-danger col-md-2 col-md-offset-5">Delete Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <br/>
        <p>If you have any questions, please <a href="{{url('/contact')}}">contact us.</a></p>
    </div>

    <div style="font-style: italic; font-size: 12px;" class="text-right">
        <a target="_blank" href="http://rachel.shellborn.com">RS Web Development</a> &copy; 2017<br/>
        Graphics created by Melayna Vergara
    </div>
@endsection

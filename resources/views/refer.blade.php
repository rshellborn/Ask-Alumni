@extends('layouts.maincontent')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('scripts')
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '225735057958380',
                xfbml      : true,
                version    : 'v2.10'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        var url = $('#url').val();
        document.getElementById('shareBtn').onclick = function() {
            FB.ui({
                method: 'share',
                mobile_iframe: true,
                href: url,
                quote: 'Get advice about post-secondary or share your post-secondary experiences at Ask Alumni'
            }, function(response){});
        };

        function copyToClipboard(text, el) {
            var copyTest = document.queryCommandSupported('copy');
            var elOriginalText = el.attr('data-original-title');

            if (copyTest === true) {
                var copyTextArea = document.createElement("textarea");
                copyTextArea.value = text;
                document.body.appendChild(copyTextArea);
                copyTextArea.select();
                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'Copied!' : 'Whoops, not copied!';
                    el.attr('data-original-title', msg).tooltip('show');
                } catch (err) {
                    console.log('Oops, unable to copy');
                }
                document.body.removeChild(copyTextArea);
                el.attr('data-original-title', elOriginalText);
            } else {
                // Fallback if browser doesn't support .execCommand('copy')
                window.prompt("Copy to clipboard: Ctrl+C or Command+C, Enter", text);
            }
        }

        $(document).ready(function() {
            $('.js-tooltip').tooltip();
            $('.js-copy').click(function() {
                var text = $(this).attr('data-copy');
                var el = $(this);
                copyToClipboard(text, el);
            });
        });
    </script>

@endsection

@section('title')
    Refer a Friend
@endsection

@section('subtitle')
    Refer someone to sign up and if they complete their registration, you and your friend will both receive 15 points!
@endsection

@section('content')
    @if(session()->has('sent'))
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="alert alert-success alert-dismissable text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span>{{session()->get('sent')}}</span>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h4 class="text-center"><strong>Your referral code is </strong></h4>
            <div class="input-group col-md-4 col-md-offset-4">
                <input type="text" class="form-control" value="{{ $referCode }}">
                <span class="input-group-btn">
                    <button class="btn btn-pink btn-copy js-tooltip js-copy" data-toggle="tooltip" data-placement="bottom" data-copy="{{ $referCode }}" title="Copy to clipboard"><i class="fa fa-clipboard fa-lg" aria-hidden="true"></i></button>
                </span>
            </div>
        </div>
    </div>
    <br/>
    <p class="text-center">Your friend can enter this code after they complete registration if they prefer to login with Facebook, Twitter, or Google.</p>
    <hr class="thick-hr"/>

    <h4 class="text-center"><strong>Share via Email</strong></h4>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/refer') }}"
          xmlns="http://www.w3.org/1999/html">
        {{ csrf_field() }}
        <input type="hidden" id="url" value="{{ url('/register/' . $referCode) }}" />

        <div class="col-md-10 col-md-offset-2">
            <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Your friend's email:</label>
                <div class="col-md-7">
                    <input type="email" name="email" class="form-control"/><br/>
                </div>
            </div>
        </div>

        <br/>
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-pink">
                    Send Email
                </button>
            </div>
        </div>
    </form>
    <br/>
    <div class="row">
        <div class="col-md-5"><hr class="thick-hr"/></div>
        <div class="col-md-2"><h4 class="text-center"><strong>Or</strong></h4></div>
        <div class="col-md-5"><hr class="thick-hr"/></div>
    </div>
    <br/>
    <h4 class="text-center"><strong>Share this link</strong></h4>
    <br/>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="input-group">
                <input type="text" class="form-control" value="{{ url('/register/' . $referCode) }}"  id="link">
                <span class="input-group-btn">
                    <button class="btn btn-pink btn-copy js-tooltip js-copy" data-toggle="tooltip" data-placement="bottom" data-copy="{{url('/register/' . $referCode) }}" title="Copy to clipboard"><i class="fa fa-clipboard fa-lg" aria-hidden="true"></i></button>
                </span>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-6 col-md-offset-4">
            <div class="col-sm-4" style="margin-bottom: 5px;">
                <div class="btn btn-block" id="shareBtn" style="background-color: #3B5998; color: white;">
                    <i class="fa fa-facebook"></i> Share
                </div>
            </div>
            <div class="col-sm-4">
                <a class="btn btn-block"
                   href="{{ "https://twitter.com/share?url=" . url('/register/' . $referCode) . "&via=askalumni&text=Get%20advice%20about%20post-secondary%20or%20share%20your%20post-secondary%20experiences%20at" }}"
                   target="_blank" style="background-color: #55ACEE; color: white;">
                    <i class="fa fa-twitter"></i> Tweet
                </a>
            </div>
        </div>
    </div>

@endsection

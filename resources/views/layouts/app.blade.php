<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (config('webpush.gcm.sender_id'))
        <link rel="manifest" href="/manifest.json">
    @endif


    <title>{{ config('app.name', 'Ask Alumni') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'user' => Auth::user(),
            'csrfToken' => csrf_token(),
            'vapidPublicKey' => config('webpush.vapid.public_key'),
            'pusher' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
        ]) !!};
    </script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet">

    <style>
        a {
            color:#FF715b;
        }
        a:hover {
            color:#FF6146;
        }
        .convoSelect {
            background-color: transparent;
        }
        .toggleWhite {
            color: black;
        }
        .toggleWhite:hover {
            color: white;
        }
        .convoSelectIndex {
            color: black;
        }
        .convoSelectIndex:hover {
            background-color: #ff715b;
            cursor: hand;
            cursor: pointer;
            border-radius: 10px;
            color: white;
        }
        .convoSelect:hover {
            background-color: #1ea896;
            cursor: hand;
            cursor: pointer;
        }
        .profileNav:hover {
            background-color: #178e7f;
            cursor: hand;
            cursor: pointer;
            color: white;
        }
        #favourite:hover {
            cursor: hand;
            cursor: pointer;
        }
        #unfavourite:hover {
            cursor: hand;
            cursor: pointer;
        }
        .profileNavLink:hover {
            text-decoration: none;
            color: white;
        }
        .profileNav {
            background-color: #1ea896;
        }
        .profileNavLink {
            text-decoration: none;
            color: white;
        }
        @media (min-width: 768px) {
            .navbar-nav.navbar-center {
                position: absolute;
                left: 50%;
                transform: translatex(-50%);
            }
        }
        .navbar-default .navbar-nav>li>a, .navbar-default .navbar-text {
            color: #fff;
        }
        .navbar-default:hover .navbar-nav>li>a:hover, .navbar-default:hover .navbar-text:hover {
            background-color: #1EA896;
            color: #fff;
        }
        .navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
            color: #fff;
        }
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
            background-color: #1EA896;
            color: #fff;
        }
        body {
            background-color: #e9ebee;
        }
        .breadcrumb>li+li:before {
            content: "/";
            padding: 0 5px;
            color: #ccc;
        }
        .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover {
            background-color: #1EA896;
        }
        .btn-pink {
            background-color: #FF715b;
            border-color: #FF715b;
            color: white;
        }
        .btn-pink:hover {
            background-color: #FF6146;
            border-color: #FF6146;
            color: white;
        }
        .nav>li>a:focus, .nav>li>a:hover {
            background-color: #4C5454;
            color: white;
        }
        .nav>li>a:focus, .nav>li>a {
            color: #1EA896;
        }
        .thick-hr {
            display: block;
            height: 1px;
            border: 0;
            border-top: 1px solid #ccc;
            margin: 1em 0;
            padding: 0;
            background-color: #FF715b;
        }
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            z-index: 3;
            color: #fff;
            background-color: #1ea896;
            border-color: #1ea896;
            cursor: default;
        }
        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: left;
            padding: 6px 12px;
            line-height: 1.6;
            text-decoration: none;
            color: #1ea896;
            background-color: #fff;
            border: 1px solid #ddd;
            margin-left: -1px;
        }
    </style>

    @yield('styles')
</head>
<body>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-78732046-5', 'auto');
    ga('send', 'pageview');

</script>
    <div id="app" v-cloak style="margin-bottom:10px">
        <nav class="navbar navbar-default" style="background-color: #4C5454;">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        @if (Auth::check())
                            <a href="{{ url('/forum') }}">
                                <img style="float:left; margin-right:5px" width="30px" src="{{ url('/alumnilogo.png') }}"/>
                            </a>
                            <a class="navbar-brand" href="{{ url('/forum') }}" style="color: white;">
                                {{ config('app.name', 'Ask Alumni') }}
                            </a>
                        @else
                            <a href="{{ url('/') }}">
                                <img style="float:left; margin-right:5px" width="30px" src="{{ url('/alumnilogo.png') }}"/>
                            </a>
                            <a class="navbar-brand" href="{{ url('/') }}" style="color: white;">
                                {{ config('app.name', 'Ask Alumni') }}
                            </a>
                        @endif
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-center">
                        @if (Auth::check())
                            <li><a href="{{ url('/forum') }}">Forums</a></li>
                            <li><a href="{{ url('/matches') }}">Matches</a></li>
                            <li><a href="{{ url('/discover') }}">Discover</a></li>
                            <li><a href="{{ url('/messages') }}">Messages</a></li>
                            <li><a href="{{ url('/rankings') }}">Rankings</a></li>
                        @endif
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::check())
                            <notifications-dropdown></notifications-dropdown>
                        @endif
                    <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @endif
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        @yield('modal')
        <div class="container-fluid">
            <div class="row content">
                <div class="col-md-2 sidenav hidden-xs text-center">
                    @if (Auth::check() && !request()->is('messages'))
                        @include('partials.peoplelist')
                    @endif
                </div>
                <div class="col-md-8">
                    @yield('body')
                </div>
                <div class="col-md-2 sidenav text-center">
                    @if (Auth::check())
                        @include('partials.personinfo')
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="/js/app.js"></script>
    @yield('scripts')
</body>
</html>

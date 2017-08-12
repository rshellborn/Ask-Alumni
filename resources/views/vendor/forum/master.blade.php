<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (isset($thread))
            {{ $thread->title }} -
        @endif
        @if (isset($category))
            {{ $category->title }} -
        @endif
        {{ trans('forum::general.home_title') }}
    </title>



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>

        textarea {
            min-height: 200px;
        }

        .deleted {
            opacity: 0.65;
        }
    </style>


    <!-- GCM Manifest (optional if VAPID is used) -->
    @if (config('webpush.gcm.sender_id'))
        <link rel="manifest" href="/manifest.json">
@endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel ={!! json_encode([
            'user' => Auth::user(),
            'csrfToken' => csrf_token(),
            'vapidPublicKey' => config('webpush.vapid.public_key'),
            'pusher' => [
                'key' => config('broadcasting.connections.pusher.key'),
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            ],
        ]) !!};
    </script>

    <script type="text/javascript">
        $(function(){
            $('#up-vote').click(function(e){
                e.preventDefault();
                var threadId = $('input[name="threadID"]').val();
                var userId = $('input[name="userID"]').val();
                var authorId = $('input[name="authorID"]').val();
                console.log(threadId);
                console.log(userId);
                console.log(authorId);
                var data = { thread: threadId, user: userId, author: authorId };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'/post/post_vote_up',
                    type:'POST',
                    data:JSON.stringify(data),
                    contentType:"application/json",
                    processData:false,
                    success:function(data){
                        console.log(data.author);
                        $('#likes').text(data.likes);
                        $('#up-vote').hide();
                        $('<img id="up-vote" src=" {{url('/thumbsupfilled.png') }}"/>').appendTo('#filled');
                    },
                    error:function(data, error, info){
                        console.log('error ' +info);
                    }
                });
            })
        });
    </script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet">
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
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a href="{{ url('/') }}">
                    <img style="float:left; margin-right:5px" width="30px" src="{{ url('/alumnilogo.png') }}"/>
                </a>
                @if (Auth::check())
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        {{ config('app.name', 'Ask Alumni') }}
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Ask Alumni') }}
                    </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <ul class="nav navbar-nav">
                        @if (Auth::check())
                            <li><a href="{{ url('/forum') }}">Forums</a></li>
                            <li><a href="{{ url('/matches') }}">Matches</a></li>
                            <li><a href="{{ url('/discover') }}">Discover</a></li>
                            <li><a href="{{ url('/messages') }}">Messages</a></li>
                            <li><a href="{{ url('/rankings') }}">Rankings</a></li>
                        @endif
                    </ul>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <notifications-dropdown></notifications-dropdown>
                    @endif
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/profile') }}">
                                        My Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/favourites') }}">
                                        Favourites
                                    </a>
                                </li>
                                <li>
                                @if (Auth::check())
                                    @if (Auth::user()->email == 'rachel@shellborn.com')
                                        <a href="{{ url('/reports') }}">Reports</a>
                                    @endif
                                @endif
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>

<div class="container">
    @include ('forum::partials.breadcrumbs')
    @include ('forum::partials.alerts')

    @yield('content')
</div>

<script>
    var toggle = $('input[type=checkbox][data-toggle-all]');
    var checkboxes = $('table tbody input[type=checkbox]');
    var actions = $('[data-actions]');
    var forms = $('[data-actions-form]');
    var confirmString = "{{ trans('forum::general.generic_confirm') }}";

    function setToggleStates() {
        checkboxes.prop('checked', toggle.is(':checked')).change();
    }

    function setSelectionStates() {
        checkboxes.each(function() {
            var tr = $(this).parents('tr');

            $(this).is(':checked') ? tr.addClass('active') : tr.removeClass('active');

            checkboxes.filter(':checked').length ? $('[data-bulk-actions]').removeClass('hidden') : $('[data-bulk-actions]').addClass('hidden');
        });
    }

    function setActionStates() {
        forms.each(function() {
            var form = $(this);
            var method = form.find('input[name=_method]');
            var selected = form.find('select[name=action] option:selected');
            var depends = form.find('[data-depends]');

            selected.each(function() {
                if ($(this).attr('data-method')) {
                    method.val($(this).data('method'));
                } else {
                    method.val('patch');
                }
            });

            depends.each(function() {
                (selected.val() == $(this).data('depends')) ? $(this).removeClass('hidden') : $(this).addClass('hidden');
            });
        });
    }

    setToggleStates();
    setSelectionStates();
    setActionStates();

    toggle.click(setToggleStates);
    checkboxes.change(setSelectionStates);
    actions.change(setActionStates);

    forms.submit(function() {
        var action = $(this).find('[data-actions]').find(':selected');

        if (action.is('[data-confirm]')) {
            return confirm(confirmString);
        }

        return true;
    });

    $('form[data-confirm]').submit(function() {
        return confirm(confirmString);
    });
</script>

<script src="/js/app.js"></script>
@yield('footer')
</body>
</html>

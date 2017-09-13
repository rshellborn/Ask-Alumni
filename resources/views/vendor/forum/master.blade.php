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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
        textarea {
            min-height: 200px;
        }
        .deleted {
            opacity: 0.65;
        }
        a {
            color:#1ea896;
        }
        a:hover {
            color:#178e7f;
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
            background-color: #1ea896;
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
            margin-top: 80px;
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
            background-color: #1ea896;
            border-color: #1ea896;
            color: white;
        }
        .btn-pink:hover {
            background-color: #178e7f;
            border-color: #178e7f;
            color: white;
        }
        #up-vote:hover {
            cursor: pointer;
            cursor: hand;
        }
        .label-primary {
            background-color: #1ea896;
            border-color: #1ea896;
        }
    </style>

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

                $('#up-vote').hide();
                $('<img id="up-vote" src=" {{url('/thumbsupfilled.png') }}"/>').appendTo('#filled');
                $likes = parseInt($('input[name="likes"]').val());
                $('#likes').text($likes + 1);

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
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #4C5454;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @if (Auth::check())
                    <a href="{{ url('/forum') }}">
                        <img src="{{ url('/brand.png') }}"/>
                    </a>
                @else
                    <a href="{{ url('/') }}">
                        <img src="{{ url('/brand.png') }}"/>
                    </a>
                @endif
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

    <div class="container-fluid">
        <div class="row content">
            <div class="col-md-2" style="padding-left: 0;">
                <div class="sidebar-nav-fixed affix hidden-xs hidden-sm">
                    {{--<div class="col-md-2 sidebar-nav-fixed affix hidden-xs text-center">--}}
                    @if (Auth::check() && !request()->is('messages'))
                        @include('partials.peoplelist')
                    @endif
                </div>
            </div>
            <div class="col-md-8" style="margin-bottom: 10px;">
                @include ('forum::partials.breadcrumbs')
                @include ('forum::partials.alerts')
                @yield('content')
            </div>
            <div>
                @if (Auth::check())
                    @include('partials.personinfo')
                @endif
            </div>
        </div>
    </div>
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

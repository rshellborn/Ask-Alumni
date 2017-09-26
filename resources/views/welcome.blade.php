<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ask Alumni</title>

    <!-- Bootstrap core CSS -->
    <link href="{{url('welcome/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{url('welcome/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/bootstrap-social@5.1.1/bootstrap-social.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Plugin CSS -->
    <link href="{{url('welcome/vendor/magnific-popup/magnific-popup.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{url('welcome/css/creative.min.css')}}" rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        function onSubmit(token) {
            document.getElementById("registerForm").submit();
        }
    </script>

    <style>
        .grecaptcha-badge {
            display: none;
        }
    </style>
</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><img id="bannerImg" src="welcome/img/banner.png"/></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/register">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="masthead">
    <div class="header-content">
        <div class="header-content-inner"><br/><br/>
            @if(Auth::check())
                <a class="btn btn-primary btn-xl js-scroll-trigger" style="margin-top: 30px; margin-bottom: 10px" href="/home">Continue to the site</a>
            @endif
            <div class="row">
            <div class="col-md-8">
                <h5 style="color: #ccc; max-width: 100%; margin-top: 80px;"><strong>Are you a high school student?</strong></h5>
                <div style="color: #ccc; max-width: 100%;">Get advice and personal stories from alumni who are attending schools, pursuing degrees, and enrolled in programs you are interested in.</div>
                <br/>
                <h5 style="color: #ccc; max-width: 100%; margin-top: 30px;"><strong>Are you an alumni?</strong></h5>
                <div style="color: #ccc; max-width: 100%;"> Share your experiences and advice with high school students to help them on their post-secondary journey. Wanting to pursue a higher degree? Talk to alumni which are enrolled in the program you are considering.</div>
                <br/>
                <a class="btn btn-primary btn-xl js-scroll-trigger" style="margin-top: 30px; margin-bottom: 10px" href="#about">Find Out More</a>
            </div>
            <div class="col-md-4" style="background: rgba(255,255,255,0.2); padding: 10px; border-radius: 10px;">
                <h3>Sign Up Now</h3><br/>
                    <div class="col-md-12">
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <a class="btn btn-block btn-social btn-facebook" href="{{ url('/auth/facebook') }}">
                                <span class="fa fa-facebook"></span>
                                Sign up with Facebook
                            </a>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <a class="btn btn-block btn-social btn-twitter" href="{{ url('/auth/twitter') }}">
                                <span class="fa fa-twitter"></span>
                                Sign up with Twitter
                            </a>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <a class="btn btn-block btn-social btn-google" href="{{ url('/auth/google') }}">
                                <span class="fa fa-google"></span>
                                Sign up with Google
                            </a>
                        </div>
                    </div>
                    <br/>
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" id="registerForm">
                            {{ csrf_field() }}

                            @if(!empty($referral_code))
                                <input type="hidden" name="referral_code" value="{{$referral_code}}" />
                            @endif

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                                @if ($errors->has('name'))
                                    <small>{{ $errors->first('name') }}</small>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                @if ($errors->has('email'))
                                    <small>{{ $errors->first('email') }}</small>

                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <small>{{ $errors->first('password') }}</small>

                                @endif
                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block g-recaptcha"
                                        data-sitekey="6Lc-Zi4UAAAAAJdiGPQs-xUxeqmRitXasgls6roi"
                                        data-callback='onSubmit'>
                                    Register
                                </button>
                            </div>
                        </form>

                        <small><a href="/login">Already have an account? Sign in.</a></small>
                        <div class="col-md-12 text-center">
                            <small class="text-muted">protected by reCAPTCHA <a target="_blank" class="text-muted" href="https://www.google.com/intl/en/policies/privacy/">Privacy</a> &bull; <a target="_blank" class="text-muted" href="https://www.google.com/intl/en/policies/terms/">Terms</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="about" style="padding-top: 0">
    <div class="call-to-action bg-dark">
        <div class="container text-center">
            <h2>What is Ask Alumni?</h2>
            <div class="row">
                <div class="col-md-12">
                    <p>Ask Alumni is a social network where high school students can get advice about post-secondary and Alumni can share their experiences.</p>

                    <p>The purpose of this site is to make a bridge to allow high school students to get in contact with Alumni and get personal experiences and answers to their questions.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-center"><strong>Benefits for Students</strong></h4>
                    <ul class="text-left">
                        <li>Ask questions to alumni who are attending post-secondary schools, studying in fields, and pursuing degrees you are interested in</li>
                        <li>Get personal advice from alumni</li>
                        <li>Discuss with other high school students</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <h4 class="text-center"><strong>Benefits for Alumni</strong></h4>
                    <ul class="text-left">
                        <li>Share experiences and advice with students about post-secondary that will help them in their post-secondary journey</li>
                        <li>Get advice and information from alumni which are pursuing higher degrees that you are interested in</li>
                        <li>Discuss with other alumni</li>
                    </ul>
                </div>
            </div>


        </div>
    </div>
</section>

<section id="features" style="padding-top: 0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Features</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-3x fa-comments text-primary sr-icons" style="margin: 8px"></i>
                    <h3>Forums</h3>
                    <p class="text-muted">Browse, discuss, and ask questions on various topics on post-secondary life.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-3x fa-users text-primary sr-icons" style="margin: 8px"></i>
                    <h3>Matches</h3>
                    <p class="text-muted">Get matched with people that have the same educational interests as you.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-3x fa-envelope text-primary sr-icons" style="margin: 8px"></i>
                    <h3>Messages</h3>
                    <p class="text-muted">Privately message so you can ask questions and share experiences.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-3x fa-star text-primary sr-icons" style="margin: 8px"></i>
                    <h3>Points</h3>
                    <p class="text-muted">Compete with other students by earning points from being active on the site.</p>
                </div>
            </div>
        </div>
    </div>
</section>



    <section class="bg-primary" id="skills" style="color: white">
        <div class="container text-center">
            <a class="btn btn-default btn-xl js-scroll-trigger" href="/register">Register</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <p class="copyright text-muted small text-center" style="margin-top: 25px">Copyright &copy; RS Web Development 2017<br/><a href="/privacy">Privacy</a> &bull; <a href="/terms">Terms</a></p>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{url('welcome/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('welcome/vendor/popper/popper.min.js')}}"></script>
    <script src="{{url('welcome/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- Plugin JavaScript -->
    <script src="{{url('welcome/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{url('welcome/vendor/scrollreveal/scrollreveal.min.js')}}"></script>
    <script src="{{url('welcome/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{url('welcome/js/creative.min.js')}}"></script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ask Alumni</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="/css/app.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .row {
                margin: 10px;
            }

            .content, .featureTitle {
                text-align: center;
            }

            .title {
                font-size: 50px;
                font-weight: bold;
            }

            .subtitle {
                font-size: 20px;
                font-style: italic;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .feature {
                text-align: left;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref" style="padding: 50px;">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title">
                <img width="80px" src="{{ url('/alumnilogo.png') }}"/><br/>
                    Ask Alumni
                </div>
                <div class="subtitle m-b-md">
                    Where high school students can communicate with Alumni about post-secondary experiences.
                </div>

                <div class="row">
                    <div class="col-md-3 feature">
                        <h1 class="featureTitle">Forums</h1>
                        <p>Browse, discuss, and ask questions on different topics ranging from applying to what post-secondary is really like.</p>
                        <div class="text-center">
                            <button class="btn btn-primary" onclick="window.location='{{ url("forum") }}'">Browse Forums</button>
                        </div>
                    </div>
                    <div class="col-md-3 feature">
                        <h1 class="featureTitle">Matches</h1>
                        <p>Get matched with Alumni who:
                        <ul>
                            <li>Graduated from your high school</li>
                            <li>Went to a post-secondary institution you're interested in</li>
                            <li>Studying in a field you're interested in</li>
                            <li>Taking a degree that you are considering to pursue</li>
                        </ul>
                    </div>
                    <div class="col-md-3 feature">
                        <h1 class="featureTitle">Advice</h1>
                        <p>Get valuable advice from Alumni on how to survive post-secondary.</p>
                    </div>
                    <div class="col-md-3 feature">
                        <h1 class="featureTitle">Messages</h1>
                        <p>Privately message Alumni that you are matched with.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <footer class="footer">
        <div class="container text-center">
            <p style="font-style: italic; font-size: 12px;" class="text-center"><a target="_blank" href="http://rachelshellborn.me">RS Web Development</a> &copy; 2017<br/>
                Ask Alumni logo created by Melayna Vergara</p>
        </div>
    </footer>
</html>

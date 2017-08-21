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

            .featureTitle {
                color: #178e7f;
            }

            .title {
                font-size: 50px;
                font-weight: bold;
                color: #1ea896;
            }

            .subtitle {
                font-size: 20px;
                font-style: italic;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .feature {
                text-align: left;
            }
            a {
                color:#1ea896;
            }
            a:hover {
                color:#178e7f;
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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">
            <div class="content">
                <div class="title">
                <img width="80px" src="{{ url('/alumnilogo.png') }}"/><br/>
                    Ask Alumni
                </div>
                <div class="subtitle m-b-md">
                    A social network for high school students and alumni.
                </div>


                @if (Route::has('login'))
                    @if (Auth::check())
                        <button class="btn btn-pink" onclick="window.location='{{ url("about") }}'">Continue to site</button>
                    @else
                        <button class="btn btn-pink" onclick="window.location='{{ url("login") }}'">Login</button>
                        <button class="btn btn-pink" onclick="window.location='{{ url("register") }}'">Register</button>
                    @endif
                @endif

                <div class="row">
                    <div class="col-md-3 feature">
                        <h1 class="featureTitle">Forums</h1>
                        <p>Browse, discuss, and ask questions on different topics including advice, how to apply, and what post-secondary is really like.</p>
                        {{--<div class="text-center">--}}
                            {{--<button class="btn btn-primary" onclick="window.location='{{ url("forum") }}'">Browse Forums</button>--}}
                        {{--</div>--}}
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
                        <p>Alumni also get matched with high school students so you can share your experiences with them.</p>
                    </div>
                    <div class="col-md-3 feature">
                        <h1 class="featureTitle">Messages</h1>
                        <p>Privately message students so you can ask questions and share experiences.</p>
                        <p>Message students you are matched with or search them using the Discover feature.</p>
                    </div>
                    <div class="col-md-3 feature">
                        <h1 class="featureTitle">Points</h1>
                        <p>Compete with other students by earning points from being active on the site!</p>
                        <p>Rank up through the four rankings: Bronze, Silver, Gold, and Platinum.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <footer class="footer">
        <div class="container text-center">
            <p style="font-style: italic; font-size: 12px;" class="text-center"><a target="_blank" href="http://rachelshellborn.me">RS Web Development</a> &copy; 2017<br/>
                Graphics created by Melayna Vergara</p>
        </div>
    </footer>
</html>

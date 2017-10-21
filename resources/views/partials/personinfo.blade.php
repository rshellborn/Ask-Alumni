<div class="hidden-md hidden-lg">
    <div class="col-md-2 text-center">
        <div class="row" style="background-color: #4c5454; margin-left: 2px; margin-right: 2px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
            <a href="/profile" style="text-decoration: none;">
                <img src="{{url('/avatars/' . Auth::user()->avatar)}}" style="width: 100px; height: 100px; border-radius:50px;margin-top:10px" />
                <h4 style="color: white;">{{Auth::user()->name}}</h4>
            </a>
            <a href="/rankings" style="text-decoration: none;">
                <div>
                    <img src="{{url(strtolower(Auth::user()->rank) . '-cap.png')}}" />
                    <h5 style="color: white; display:inline">{{Auth::user()->points}} points</h5>
                </div>
            </a>
        </div>
        <div class="row" style="background-color: #1ea896; margin-left: 2px; margin-right: 2px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <div class="list-group" style="margin-bottom: 0;">
                <a href="/profile" class="profileNavLink">
                    <div class="list-group-item profileNav">
                        My Profile
                    </div>
                </a>
                <a href="/favourites" class="profileNavLink">
                    <div class="list-group-item profileNav">
                        Favourites
                    </div>
                </a>
                <a href="/settings" class="profileNavLink">
                    <div class="list-group-item profileNav">
                        Settings
                    </div>
                </a>

                @if(Auth::user()->email == 'rachel@shellborn.com')
                    <a href="/reports" class="profileNavLink">
                        <div class="list-group-item profileNav">
                            Reports
                        </div>
                    </a>
                @endif

                <a href="/logout" class="profileNavLink">
                    <div class="list-group-item profileNav">
                        <a href="{{ url('/logout') }}" style="text-decoration: none; color:white;"
                           onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </a>
            </div>
            <div style="background-color: #4c5454; margin-right: 2px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                <div class="col-md-12">
                    <a target="_blank" href="https://www.facebook.com/askalumni.ca/" style="color:#262a2a;"><span class="fa-stack fa"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack fa-inverse"></i></span></a>
                    <a target="_blank" href="https://twitter.com/askalumni/" style="color:#262a2a;"><span class="fa-stack fa"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack fa-inverse"></i></span></a>
                    <a target="_blank" href="https://www.instagram.com/ask_alumni/" style="color:#262a2a;"><span class="fa-stack fa"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack fa-inverse"></i></span></a>
                </div>
                <small style="color: white;"><a href="/faq" style="color: white;">FAQ</a> &bull; <a href="/contact" style="color: white;">Contact</a> &bull; <a href="/privacy" style="color: white;">Privacy</a> &bull; <a href="/terms" style="color: white;">Terms</a></small><br/>
                <small style="color: white;"><a href="http://rachel.shellborn.com" target="_blank" style="color: white;">RS Web Development</a> &copy; 2017</small>
            </div>
        </div>
        <div class="col-md-12" style="margin-top:10px;">
            <a href="/refer" class="btn btn-pink btn-block">Refer a Friend</a>
        </div>
    </div>
</div>

<div class="hidden-sm hidden-xs">
    <div class="col-md-2" style="width: 15%;">
        <div class="sidebar-nav-fixed pull-right affix text-center">
            <div class="row" style="background-color: #1ea896; margin-left: 15px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                <div class="row" style="background-color: #4c5454;border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <a href="/profile" style="text-decoration: none;">
                        <img src="{{url('/avatars/' . Auth::user()->avatar)}}" style="width: 100px; height: 100px; border-radius:50px;margin-top:10px" />
                        <h4 style="color: white;">{{Auth::user()->name}}</h4>
                    </a>
                    <a href="/rankings" style="text-decoration: none;">
                        <div>
                            <img src="{{url(strtolower(Auth::user()->rank) . '-cap.png')}}" />
                            <h5 style="color: white; display:inline">{{Auth::user()->points}} points</h5>
                        </div>
                    </a>
                </div>
                <div class="row">
                    <div class="list-group" style="margin-bottom: 0;">
                        <a href="/profile" class="profileNavLink">
                            <div class="list-group-item profileNav">
                                My Profile
                            </div>
                        </a>
                        <a href="/favourites" class="profileNavLink">
                            <div class="list-group-item profileNav">
                                Favourites
                            </div>
                        </a>
                        <a href="/settings" class="profileNavLink">
                            <div class="list-group-item profileNav">
                                Settings
                            </div>
                        </a>

                        @if(Auth::user()->email == 'rachel@shellborn.com')
                            <a href="/reports" class="profileNavLink">
                                <div class="list-group-item profileNav">
                                    Reports
                                </div>
                            </a>
                        @endif

                        <a href="/logout" class="profileNavLink">
                            <div class="list-group-item profileNav">
                                <a href="{{ url('/logout') }}" style="text-decoration: none; color:white;"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </a>

                        <div class="list-group-item" style="background-color: #4c5454; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <div class="col-md-12">
                                <a target="_blank" href="https://www.facebook.com/askalumni.ca/" style="color:#262a2a;"><span class="fa-stack fa"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack fa-inverse"></i></span></a>
                                <a target="_blank" href="https://twitter.com/askalumni/" style="color:#262a2a;"><span class="fa-stack fa"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack fa-inverse"></i></span></a>
                                <a target="_blank" href="https://www.instagram.com/ask_alumni/" style="color:#262a2a;"><span class="fa-stack fa"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack fa-inverse"></i></span></a>
                            </div>
                            <br/>
                            <small style="color: white;"><a href="/faq" style="color: white;">FAQ</a> &bull; <a href="/contact" style="color: white;">Contact</a> &bull; <a href="/privacy" style="color: white;">Privacy</a> &bull; <a href="/terms" style="color: white;">Terms</a></small><br/>
                            <small style="color: white;"><a href="http://rachel.shellborn.com" target="_blank" style="color: white;">RS Web Development</a> &copy; 2017</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-left: 15px;margin-top:10px;">
                <a href="/refer" class="btn btn-pink btn-block">Refer a Friend</a>
            </div>
        </div>
    </div>
</div>
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
                <small style="color: white;"><a href="/about" style="color: white;">About</a> | </small>
                <a href="/contact" style="color: white;"><small>Contact</small></a><br/>
                <small style="color: white;"><a href="http://rachelshellborn.me" target="_blank" style="color: white;">RS Web Development</a> &copy; 2017</small><br/>
            </div>
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
                            <small style="color: white;"><a href="/about" style="color: white;">About</a> | </small>
                            <a href="/contact" style="color: white;"><small>Contact</small></a><br/>
                            <small style="color: white;"><a href="http://rachelshellborn.me" target="_blank" style="color: white;">RS Web Development</a> &copy; 2017</small><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
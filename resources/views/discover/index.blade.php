@extends('layouts.maincontent')

@section('scripts')
    <script>
        $('#otherHS').hide();
        $('#showInputHS').click(function() {
            $('#showInputHS').hide();
            $('#highSchool').hide();
            $('#otherHS').show();
        });

        $('#otherPS').hide();
        $('#showInputPS').click(function() {
            $('#showInputPS').hide();
            $('#school').hide();
            $('#otherPS').show();
        });

        $('#otherF').hide();
        $('#showInputF').click(function() {
            $('#showInputF').hide();
            $('#field').hide();
            $('#otherF').show();
        });

        $('#otherD').hide();
        $('#showInputD').click(function() {
            $('#showInputD').hide();
            $('#degree').hide();
            $('#otherD').show();
        });
    </script>
@endsection

@section('title')
    Discover
@endsection

@section('subtitle')
    Search for alumni or high school students you wish to talk to.
@endsection

@section('content')
    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/discover/search') }}">
            {{ csrf_field() }}
            <input type="hidden" value="name" name="search"/>
            <h4 class="text-center">Search by Name</h4>
            <div class="form-group">
                <div class="text-center col-md-6 col-md-offset-3">
                    <input type="text" name="name" class="form-control" placeholder="Name" />
                </div>
            </div>
            <div class="form-group">
                <div class="text-center">
                    @if(Auth::guest())
                        <a href="login" class="btn btn-pink">Search</a>
                    @else
                        <button type="submit" class="btn btn-pink  col-md-2 col-md-offset-5">
                            Search
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <hr/>

    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/discover/search') }}">
            {{ csrf_field() }}
            <input type="hidden" value="filter" name="search"/>
            <h4 class="text-center">Search by Filter</h4>
            <div id="fields" class="form-group">
                <label for="type" class="col-md-3 control-label">User Type</label>
                <div class="col-md-7">
                    <select name="type" class="form-control">
                        <option value="Alumni" selected="selected">Alumni</option>
                        <option value="Student">Student</option>
                        <option value="All">All</option>
                    </select>
                </div>
            </div>

            <div id="fields" class="form-group">
                <label for="highSchool" class="col-md-3 control-label">High School</label>
                <div class="col-md-7">
                    <select name="highSchool" class="form-control" id="highSchool">
                        <option value="All" selected="selected">All</option>
                        @foreach($highschools as $highSchool)
                            <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                        @endforeach
                    </select>

                    <div id="otherHS">
                        <input type="text" name="otherHS" class="form-control" placeholder="Enter high school"/>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <a href="javascript:void(0);" id="showInputHS">Enter Manually</a>
                </div>
            </div>

            <div id="fields" class="form-group">
                <label for="school" class="col-md-3 control-label">Post-Secondary Institution</label>
                <div class="col-md-7">
                    <select name="school" class="form-control" id="school">
                        <option value="All" selected="selected">All</option>
                        @foreach($schools as $school)
                            <option value="{{ $school }}">{{ $school }}</option>
                        @endforeach
                    </select>

                    <div id="otherPS">
                        <input type="text" name="otherPS" class="form-control" placeholder="Enter post-secondary school"/>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <a href="javascript:void(0);" id="showInputPS">Enter Manually</a>
                </div>
            </div>

            <div id="fields" class="form-group">
                <label for="field" class="col-md-3 control-label">Field of Study</label>
                <div class="col-md-7">
                    <select name="field" class="form-control" id="field">
                        <option value="All" selected="selected">All</option>
                        @foreach($fields as $field)
                            <option value="{{ $field }}">{{ $field }}</option>
                        @endforeach
                    </select>

                    <div id="otherF">
                        <input type="text" name="otherF" class="form-control" placeholder="Enter field of study"/>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <a href="javascript:void(0);" id="showInputF">Enter Manually</a>
                </div>
            </div>

            <div id="fields" class="form-group">
                <label for="degree" class="col-md-3 control-label">Degree</label>
                <div class="col-md-7">
                    <select name="degree" class="form-control" id="degree">
                        <option value="All" selected="selected">All</option>
                        @foreach($degrees as $degree)
                            <option value="{{ $degree }}">{{ $degree }}</option>
                        @endforeach
                    </select>
                    <div id="otherD">
                        <input type="text" name="otherD" class="form-control" placeholder="Enter degree"/>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <a href="javascript:void(0);" id="showInputD">Enter Manually</a>
                </div>
            </div>

            <div class="form-group">
                <div class="text-center">
                    @if(Auth::guest())
                        <a href="login" class="btn btn-pink">Search</a>
                    @else
                        <button type="submit" class="btn btn-pink  col-md-2 col-md-offset-5">
                            Search
                        </button>
                    @endif
                </div>
            </div>

        </form>
    </div>
@endsection

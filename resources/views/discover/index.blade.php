@extends('layouts.maincontent')

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
                    <button type="submit" class="btn btn-pink">
                        Search
                    </button>
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
                <label for="type" class="col-md-4 control-label">User Type</label>
                <div class="col-md-8">
                    <select name="type" class="form-control">
                        <option value="Alumni" selected="selected">Alumni</option>
                        <option value="Student">Student</option>
                        <option value="All">All</option>
                    </select>
                </div>
            </div>

            <div id="fields" class="form-group">
                <label for="highSchool" class="col-md-4 control-label">High School</label>
                <div class="col-md-8">
                    <select name="highSchool" class="form-control">
                        <option value="All" selected="selected">All</option>
                        @foreach($highschools as $highSchool)
                            <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="fields" class="form-group">
                <label for="school" class="col-md-4 control-label">Post-Secondary Institution</label>
                <div class="col-md-8">
                    <select name="school" class="form-control">
                        <option value="All" selected="selected">All</option>
                        @foreach($schools as $school)
                            <option value="{{ $school }}">{{ $school }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="fields" class="form-group">
                <label for="field" class="col-md-4 control-label">Field of Study</label>
                <div class="col-md-8">
                    <select name="field" class="form-control">
                        <option value="All" selected="selected">All</option>
                        @foreach($fields as $field)
                            <option value="{{ $field }}">{{ $field }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="fields" class="form-group">
                <label for="degree" class="col-md-4 control-label">Degree</label>
                <div class="col-md-8">
                    <select name="degree" class="form-control">
                        <option value="All" selected="selected">All</option>
                        @foreach($degrees as $degree)
                            <option value="{{ $degree }}">{{ $degree }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-pink">
                        Search
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection

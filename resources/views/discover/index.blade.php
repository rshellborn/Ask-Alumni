@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Discover</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/discover/search') }}">
                            {{ csrf_field() }}
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
                                <label for="degree" class="col-md-4 control-label">Degrees</label>
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
                                    <button type="submit" class="btn btn-success">
                                        Search
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

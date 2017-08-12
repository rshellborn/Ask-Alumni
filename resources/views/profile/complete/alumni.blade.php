@extends('layouts.app')

@section('scripts')
    <script>
        $('#other').hide();

        $('#showInput').click(function() {
            $('#showInput').hide();
            $('#ddHighSchool').hide();
            $('#other').show();
        });

    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h4><strong>Alumni Registration</strong></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name" class="col-md-6 control-label text-right">You are currently registering as an Alumni.</label>
                            <div class="text-center">
                                <button class="btn btn-warning" onclick="window.location='{{ url('/profile/complete/student') }}'">Switch to Student</button>
                            </div>
                        </div>

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/profile/edit') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="accType" value="Alumni"/>

                            <div id="fields" class="form-group">
                                <div class="col-md-6 text-right">
                                    <label for="highSchool" class="control-label">Which high school did you graduate from?</label><br/>
                                    <a href="#" id="showInput">School not listed? Click here.</a>
                                </div>
                                <div class="col-md-6">
                                    <select name="highSchool" class="form-control" id="ddHighSchool">
                                        @foreach($highschools as $highSchool)
                                            <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                                        @endforeach
                                    </select>
                                    <div id="other">
                                        <input type="text" name="otherHighSchool" class="form-control" placeholder="Enter your high school"/>
                                    </div>
                                </div>
                            </div>

                            <div id="fields" class="form-group">
                                <label for="inSchool" class="col-md-6 control-label">Are you still attending a post-secondary institution?</label>

                                <div class="col-md-4">
                                    <input type="radio" name="inSchool" value="true" checked>Yes<br/>
                                    <input type="radio" name="inSchool" value="false">No<br/>
                                </div>
                            </div>

                            <div id="fields" class="form-group">
                                <label for="fieldOfStudy" class="col-md-6 control-label">What are you studying or did you study in post secondary?</label>

                                <div class="col-md-12">
                                    <div class="col-md-5">
                                        @foreach($fields1 as $field)
                                            <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}">{{ $field->name }}<br/>
                                        @endforeach
                                    </div>

                                    <div class="col-md-5">
                                        @foreach($fields2 as $field)
                                            <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}">{{ $field->name }}<br/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div id="fields" class="form-group">
                                <label for="school" class="col-md-6 control-label">Which school(s) are you attending or did you attend?</label>

                                <div class="col-md-12">
                                    <div class="col-md-5">
                                        @foreach($schools1 as $school)
                                            <input type="checkbox" name="school[]" value="{{ $school->name }}">{{ $school->name }}<br/>
                                        @endforeach
                                    </div>

                                    <div class="col-md-5">
                                        @foreach($schools2 as $school)
                                            <input type="checkbox" name="school[]" value="{{ $school->name }}">{{ $school->name }}<br/>
                                        @endforeach
                                        <input type="checkbox" name="school[]" value="other"> <input type="text" name="otherSchool" placeholder="Other school..." /><br/>
                                    </div>
                                </div>
                            </div>

                            <div id="fields" class="form-group">
                                <label for="degree" class="col-md-6 control-label">Which degree(s) are you pursuing or have achieved?</label>

                                <div class="col-md-4">
                                    @foreach($degrees as $degree)
                                        <input type="checkbox" name="degree[]" value="{{ $degree->name }}">{{ $degree->name }}<br/>
                                    @endforeach
                                </div>
                            </div>

                            <div id="fields" class="form-group">
                                <label for="inSchool" class="col-md-6 control-label">Tell us a bit about yourself.</label>

                                <div class="col-md-12">
                                    <textarea name="bio" id="bio" rows ="3" placeholder="Current student at {school} studying {field} and am expected to graduate in June 2018..." class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Save
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
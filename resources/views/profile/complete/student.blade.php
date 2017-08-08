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
                            <h4><strong>Student Registration</strong></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name" class="col-md-6 control-label text-right">You are currently registering as a Student.</label>
                            <div class="text-center">
                                <button class="btn btn-warning" onclick="window.location='{{ url('/profile/complete/alumni') }}'">Switch to Alumni</button>
                            </div>
                        </div>

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('profile/edit') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="accType" value="Student"/>


                            <div id="fields" class="form-group">
                                <div class="col-md-6 text-right">
                                    <label for="highSchool" class="control-label">Which high school do you attend?</label><br/>
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
                                <label for="fieldOfStudy" class="col-md-6 control-label">Which fields of study are you interested in?</label>
                                <br/>
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
                                <label for="school" class="col-md-6 control-label">Which schools are you interested in?</label>

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
                                <label for="degree" class="col-md-6 control-label">Which degree(s) are you interested in?</label>

                                <div class="col-md-4">
                                    @foreach($degrees as $degree)
                                        <input type="checkbox" name="degree[]" value="{{ $degree->name }}">{{ $degree->name }}<br/>
                                    @endforeach
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
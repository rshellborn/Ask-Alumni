@extends('layouts.app')

@section('scripts')
    <script type="text/javascript">
        checkAccType();
        function checkAccType() {
            if (document.getElementById('studentAcc').checked) {
                //Male radio button is checked
                console.log("student");
                document.getElementById("studentForm").style.display = "block";
                document.getElementById("alumniForm").style.display = "none";
            } else if (document.getElementById('alumniAcc').checked) {
                //Female radio button is checked
                console.log("alumni");
                document.getElementById("studentForm").style.display = "none";
                document.getElementById("alumniForm").style.display = "block";
            }
        }
        $('input[type=radio][name=accType]').change(function() {
            checkAccType();
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $heading }}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url($url) }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name" class="col-md-6 control-label">Are you a current high school student or an alumni?</label>

                                <div class="col-md-4">
                                    <input type="radio" name="accType" id="studentAcc" value="Student" checked> Student<br>
                                    <input type="radio" name="accType" id="alumniAcc" value="Alumni"> Alumni
                                </div>
                            </div>

                            <div id="studentForm">
                                <div id="fields" class="form-group">
                                    <label for="highSchool" class="col-md-6 control-label">What high school do you attend?</label>
                                    <div class="col-md-6">
                                        <select name="highSchool" class="form-control">
                                            @foreach($highschools as $highSchool)
                                                <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="fields" class="form-group">
                                    <label for="fieldOfStudy" class="col-md-6 control-label">What fields of study are you interested in?</label>
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
                                    <label for="school" class="col-md-6 control-label">What schools are you interested in?</label>

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
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="alumniForm">
                                <div id="fields" class="form-group">
                                    <label for="highSchool" class="col-md-6 control-label">What high school did you graduate from?</label>
                                    <div class="col-md-6">
                                        <select name="highSchool" class="form-control">
                                            @foreach($highschools as $highSchool)
                                                <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="fields" class="form-group">
                                    <label for="fieldOfStudy" class="col-md-6 control-label">What did you study?</label>

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
                                    <label for="degree" class="col-md-6 control-label">What kind of degree(s) are you pursuing or have achieved?</label>

                                    <div class="col-md-4">
                                        @foreach($degrees as $degree)
                                            <input type="checkbox" name="degree[]" value="{{ $degree->name }}">{{ $degree->name }}<br/>
                                        @endforeach
                                    </div>
                                </div>

                                <div id="fields" class="form-group">
                                    <label for="school" class="col-md-6 control-label">Which school(s) did or are attending?</label>

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
                                        </div>
                                    </div>
                                </div>

                                <div id="fields" class="form-group">
                                    <label for="inSchool" class="col-md-6 control-label">Tell us a bit about yourself.</label>

                                    <div class="col-md-12">
                                        <textarea name="bio" id="bio" rows ="3" placeholder="Current student at {school} studying {field} and am expected to graduate in June 2018..." class="form-control"></textarea>
                                    </div>
                                </div>

                                <div id="fields" class="form-group">
                                    <label for="inSchool" class="col-md-6 control-label">Are you still in university/college?</label>

                                    <div class="col-md-4">
                                        <input type="radio" name="inSchool" value="true" checked>Yes<br/>
                                        <input type="radio" name="inSchool" value="false">No<br/>
                                    </div>
                                </div>

                                <div id="fields" class="form-group">
                                    <label for="allowEmail" class="col-md-6 control-label">Allow students to email you with direct questions?</label>

                                    <div class="col-md-4">
                                        <input type="radio" name="allowEmail" value="true" checked>Yes<br/>
                                        <input type="radio" name="allowEmail" value="false">No<br/>
                                    </div>
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
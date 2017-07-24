@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $heading }}</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="GET" action="{{ url('/profile/complete') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name" class="col-md-6 control-label">You are currently registered as {{$type}}.</label>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-warning">Switch to {{$otherType}}</button>
                                </div>
                            </div>
                        </form>
                        @if($accType == 'Student')
                            <form class="form-horizontal" role="form" method="POST" action="{{ url($url) }}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $accType }}" name="accType" />

                                <div id="studentForm">
                                    <div id="fields" class="form-group">
                                        <label for="highSchool" class="col-md-6 control-label">What high school do you attend?</label>
                                        <div class="col-md-6">
                                            <select name="highSchool" class="form-control">
                                                @foreach($highschools as $highSchool)
                                                    @if($student == 'checked' && $highSchool == $selHighSchool)
                                                        <option value="{{ $highSchool }}" selected>{{ $highSchool }}</option>
                                                    @else
                                                        <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                                                    @endif
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
                                                    @if($student == 'checked' && in_array($field->name, $selFields))
                                                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}" checked>{{ $field->name }}<br/>
                                                    @else
                                                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}">{{ $field->name }}<br/>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <div class="col-md-5">
                                                @foreach($fields2 as $field)
                                                    @if($student == 'checked' && in_array($field->name, $selFields))
                                                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}" checked>{{ $field->name }}<br/>
                                                    @else
                                                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}">{{ $field->name }}<br/>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div id="fields" class="form-group">
                                        <label for="school" class="col-md-6 control-label">What schools are you interested in?</label>

                                        <div class="col-md-12">
                                            <div class="col-md-5">
                                                @foreach($schools1 as $school)
                                                    @if($student == 'checked' && in_array($school->name, $selSchools))
                                                        <input type="checkbox" name="school[]" value="{{ $school->name }}" checked>{{ $school->name }}<br/>
                                                    @else
                                                        <input type="checkbox" name="school[]" value="{{ $school->name }}">{{ $school->name }}<br/>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <div class="col-md-5">
                                                @foreach($schools2 as $school)
                                                    @if($student == 'checked' && in_array($school->name, $selSchools))
                                                        <input type="checkbox" name="school[]" value="{{ $school->name }}" checked>{{ $school->name }}<br/>
                                                    @else
                                                        <input type="checkbox" name="school[]" value="{{ $school->name }}">{{ $school->name }}<br/>
                                                    @endif
                                                @endforeach
                                            </div>
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
                        @endif


                        @if($accType == 'Alumni')
                            <form class="form-horizontal" role="form" method="POST" action="{{ url($url) }}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $accType }}" name="accType" />
                                <div id="alumniForm">
                                    <div id="fields" class="form-group">
                                        <label for="highSchool" class="col-md-6 control-label">What high school did you graduate from?</label>
                                        <div class="col-md-6">
                                            <select name="highSchool" class="form-control">
                                                @foreach($highschools as $highSchool)
                                                    @if($alumni == 'checked' && $highSchool == $selHighSchool)
                                                        <option value="{{ $highSchool }}" selected>{{ $highSchool }}</option>
                                                    @else
                                                        <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div id="fields" class="form-group">
                                        <label for="fieldOfStudy" class="col-md-6 control-label">What did you study?</label>

                                        <div class="col-md-12">
                                            <div class="col-md-5">
                                                @foreach($fields1 as $field)
                                                    @if($alumni == 'checked' && in_array($field->name, $selFields))
                                                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}" checked>{{ $field->name }}<br/>
                                                    @else
                                                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}">{{ $field->name }}<br/>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <div class="col-md-5">
                                                @foreach($fields2 as $field)
                                                    @if($alumni == 'checked' && in_array($field->name, $selFields))
                                                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}" checked>{{ $field->name }}<br/>
                                                    @else
                                                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}">{{ $field->name }}<br/>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div id="fields" class="form-group">
                                        <label for="degree" class="col-md-6 control-label">What kind of degree(s) are you pursuing or have achieved?</label>

                                        <div class="col-md-4">
                                            @foreach($degrees as $degree)
                                                @if($alumni == 'checked' && in_array($degree->name, $selDegrees))
                                                    <input type="checkbox" name="degree[]" value="{{ $degree->name }}" checked>{{ $degree->name }}<br/>
                                                @else
                                                    <input type="checkbox" name="degree[]" value="{{ $degree->name }}">{{ $degree->name }}<br/>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div id="fields" class="form-group">
                                        <label for="school" class="col-md-6 control-label">Which school(s) did or are attending?</label>

                                        <div class="col-md-12">
                                            <div class="col-md-5">
                                                @foreach($schools1 as $school)
                                                    @if($alumni == 'checked' && in_array($school->name, $selSchools))
                                                        <input type="checkbox" name="school[]" value="{{ $school->name }}" checked>{{ $school->name }}<br/>
                                                    @else
                                                        <input type="checkbox" name="school[]" value="{{ $school->name }}">{{ $school->name }}<br/>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <div class="col-md-5">
                                                @foreach($schools2 as $school)
                                                    @if(in_array($school->name, $selSchools))
                                                        <input type="checkbox" name="school[]" value="{{ $school->name }}" checked>{{ $school->name }}<br/>
                                                    @else
                                                        <input type="checkbox" name="school[]" value="{{ $school->name }}">{{ $school->name }}<br/>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div id="fields" class="form-group">
                                        <label for="inSchool" class="col-md-6 control-label">Tell us a bit about yourself.</label>

                                        <div class="col-md-12">
                                            <textarea name="bio" id="bio" rows ="3" placeholder="Current student at {school} studying {field} and am expected to graduate in June 2018..." class="form-control">@if($alumni == 'checked') {{$bio}} @endif</textarea>
                                        </div>
                                    </div>

                                    <div id="fields" class="form-group">
                                        <label for="inSchool" class="col-md-6 control-label">Are you still in university/college?</label>

                                        <div class="col-md-4">
                                            <input type="radio" name="inSchool" value="true" <?php echo  $inSchool ?>>Yes<br/>
                                            <input type="radio" name="inSchool" value="false" <?php echo $notInSchool ?>>No<br/>
                                        </div>
                                    </div>

                                    <div id="fields" class="form-group">
                                        <label for="allowEmail" class="col-md-6 control-label">Allow students to email you with direct questions?</label>

                                        <div class="col-md-4">
                                            <input type="radio" name="allowMessage" value="true" <?php echo $allowMessage ?>>Yes<br/>
                                            <input type="radio" name="allowMessage" value="false" <?php echo $notAllowMessage ?>>No<br/>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
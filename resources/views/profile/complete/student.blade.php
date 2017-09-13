@extends('layouts.maincontent')

@section('scripts')
    <script>
        $('#otherHS').hide();
        $('#showInputHS').click(function() {
            $('#showInputHS').hide();
            $('#ddHighSchool').hide();
            $('#otherHS').show();
        });

        $('#otherPS').hide();
        $('#showInputPS').click(function() {
            $('#showInputPS').hide();
            $('#otherPS').show();
        });

        $('#otherFOS').hide();
        $('#showInputFOS').click(function() {
            $('#showInputFOS').hide();
            $('#otherFOS').show();
        });

        $('#otherD').hide();
        $('#showInputD').click(function() {
            $('#showInputD').hide();
            $('#otherD').show();
        });
    </script>
@endsection

@section('title')
    Student Registration
@endsection

@section('modal')
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="background-color: #1ea896; color: white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><strong>Upload Profile Picture</strong></h4>
                </div>
                <div class="modal-body text-center">
                    <form enctype="multipart/form-data" action="/profile/avatar" method="POST">
                        <label>Update Profile Image</label>
                        <input class="form-control" type="file" name="avatar">
                        <input type="hidden" name="action" value="upload">
                        <input type="hidden" name="fromUrl" value="student">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <br/>
                        <input type="submit" class="btn btn-pink" value="Upload">
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="form-group">
            <h4 class="col-md-6 control-label text-right">You are currently registering as Student.</h4>
            <div class="text-center">
                <button class="btn btn-warning" onclick="window.location='{{ url('/profile/complete/alumni') }}'">Switch to Alumni</button>
            </div>
        </div>
    </div>
    <hr class="thick-hr"/>

    <div class="row">
        <div class="col-md-12 text-center">
            <h4><strong>Profile Picture</strong></h4>
            <div class="row">
                <img src="/avatars/{{ $avatar }}" style="width:50px; height:50px; border-radius: 50px; margin-bottom: 5px">
            </div>
            <div class="row">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Upload</button>
                <form style="display: inline" role="form" method="POST" action="/profile/avatar">
                    {{ csrf_field() }}
                    <input type="hidden" name="action" value="delete" />
                    <input type="hidden" name="type" value="a Student">
                    <input type="hidden" name="fromUrl" value="student">
                    <input type="submit" class="btn btn-danger" value="Delete" />
                </form>
            </div>
        </div>
    </div>
    <hr class="thick-hr"/>

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/profile/edit') }}">
        {{ csrf_field() }}
        <input type="hidden" name="accType" value="Student"/>

        <div class="row">
            <div class="col-md-12 text-center">
                <h4><strong>Education</strong></h4>
                <div class="col-md-6 col-md-offset-3">
                    <label for="ddhighschool">Which high school did you attend?</label>
                    <select name="highSchool" class="form-control" id="ddHighSchool">
                        @foreach($highschools as $highSchool)
                            <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                        @endforeach
                    </select>
                    <a href="javascript:void(0);" id="showInputHS">High school not listed? Click here.</a>
                    <div id="otherHS">
                        <input type="text" name="otherHighSchool" class="form-control" placeholder="Enter your high school"/>
                    </div>
                </div>
            </div>
        </div>
        <hr/>

        <div class="row">
            <div class="col-md-12 text-center">
                <label for="school[]">Which post secondary institutions are you interested in?</label>
            </div>
            <div class="col-md-5 col-md-offset-2">
                @foreach($schools1 as $school)
                    <input type="checkbox" name="school[]" value="{{ $school->name }}"> {{ $school->name }}<br/>
                @endforeach
            </div>

            <div class="col-md-5">
                @foreach($schools2 as $school)
                    <input type="checkbox" name="school[]" value="{{ $school->name }}"> {{ $school->name }}<br/>
                @endforeach
            </div>
            <div class="col-md-6 col-md-offset-3 text-center">
                <br/>
                <a href="javascript:void(0);" id="showInputPS">Post secondary institution not listed? Click here.</a>
                <div id="otherPS">
                    <label>Enter in schools separated by commas</label>
                    <input type="text" name="otherSchools" class="form-control" placeholder="Example University,Example College"/>
                </div>
            </div>
        </div>
        <hr/>

        <div class="row">
            <div class="col-md-12 text-center">
                <label for="fieldOfStudy[]">Which fields of study are you interested in?</label>
            </div>
            <div class="col-md-5 col-md-offset-2">
                @foreach($fields1 as $field)
                    <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}"> {{ $field->name }}<br/>
                @endforeach
            </div>

            <div class="col-md-5">
                @foreach($fields2 as $field)
                    <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}"> {{ $field->name }}<br/>
                @endforeach
            </div>
            <div class="col-md-6 col-md-offset-3 text-center">
                <br/>
                <a href="javascript:void(0);" id="showInputFOS">Field of study not listed? Click here.</a>
                <div id="otherFOS">
                    <label>Enter in fields of study separated by commas</label>
                    <input type="text" name="otherFields" class="form-control" placeholder="Example,Example2"/>
                </div>
            </div>
        </div>
        <hr/>

        <div class="row">
            <div class="col-md-12 text-center">
                <label for="degree[]">Which degrees are you interested in?</label>
            </div>
            <div class="col-md-6 col-md-offset-5">
                @foreach($degrees as $degree)
                    <input type="checkbox" name="degree[]" value="{{ $degree->name }}"> {{ $degree->name }}<br/>
                @endforeach
            </div>

            <div class="col-md-6 col-md-offset-3 text-center">
                <br/>
                <a href="javascript:void(0);" id="showInputD">Degree not listed? Click here.</a>
                <div id="otherD">
                    <label>Enter in degrees separated by commas</label>
                    <input type="text" name="otherDegrees" class="form-control" placeholder="Example,Example2"/>
                </div>
            </div>
        </div>
        <hr/>

        @if(Auth::user()->type == null)
            <div class="row">
                <div class="col-md-12 text-center">
                    <input type="checkbox" name="subscribe" value="true" checked> I would like to receive email notifications<br/>
                    <small>This includes when you receive a new message. You can edit your preferences after you complete your registration.</small>
                    <br/>
                </div>
            </div>
            <hr/>
        @endif

        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-pink">
                    Save
                </button>
            </div>
        </div>
    </form>
@endsection
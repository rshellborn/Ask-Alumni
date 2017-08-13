@extends('layouts.app')

@section('scripts')
    <script>
        $('#other').hide();

        $('#showInput').click(function() {
            $('#showInput').hide();
            $('#ddHighSchool').hide();
            $('#other').show();
        });

        $(function(){
            $('#uploadAvatar').click(function(e){
                e.preventDefault();
                var image = $('input[name="avatar"]').val();
                var data = { avatar: image, action: 'upload' };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'/profile/avatar',
                    type:'POST',
                    data:JSON.stringify(data),
                    contentType:"application/json",
                    processData:false,
                    success:function(data){
                        if(data.error) {
                            $('<p>' + data.errorDescription + '</p>').appendTo('#uploaded');
                        } else {
                            $('#myModal').modal('toggle');
                            $('<p>Profile picture uploaded!</p>').appendTo('#uploaded');
                        }
                    },
                    error:function(data){
                        console.log('error ' +data.responseJSON);
                    }
                });
            })
        });
    </script>
@endsection

@section('content')
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Profile Picture</h4>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="/profile/avatar" method="POST">
                        <label>Update Profile Image</label>
                        <input type="file" name="avatar">
                        <input type="hidden" name="action" value="upload">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h4><strong>Edit Profile</strong></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="name" class="col-md-6 control-label text-right">You are currently registered as {{$type}}.</label>
                            <div class="text-center">
                                <button class="btn btn-warning" onclick="window.location='{{ url('/profile/complete/' . strtolower($otherType)) }}'">Switch to {{$otherType}}</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <img src="/avatars/{{ $avatar }}" style="width:50px; height:50px; float:left; margin-right:25px;">
                            <label for="name" class="col-md-6 control-label text-right">Profile Picture</label>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Upload</button>
                            <form class="form-horizontal" role="form" method="POST" action="/profile/avatar">
                                {{ csrf_field() }}
                                <input type="hidden" name="action" value="delete" />
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="submit" class="btn btn-danger" value="Delete" />
                            </form>
                        </div>
                        @if($accType == 'Student')
                            <form class="form-horizontal" role="form" method="POST" action="{{ url($url) }}">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $accType }}" name="accType" />

                                <div id="studentForm">
                                    <div id="fields" class="form-group">
                                        <div class="col-md-6 text-right">
                                            <label for="highSchool" class="control-label">Which high school do you attend?</label><br/>
                                            <a href="#" id="showInput">School not listed? Click here.</a>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="highSchool" class="form-control" id="ddHighSchool">
                                                @foreach($highschools as $highSchool)
                                                    @if($alumni == 'checked' && $highSchool == $selHighSchool)
                                                        <option value="{{ $highSchool }}" selected>{{ $highSchool }}</option>
                                                    @else
                                                        <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                                                    @endif
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
                                        <label for="school" class="col-md-6 control-label">Which schools are you interested in?</label>

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
                                                <input type="checkbox" name="school[]" value="other"> <input type="text" name="otherSchool" placeholder="Other school..." /><br/>
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
                                        <div class="col-md-6 text-right">
                                            <label for="highSchool" class="control-label">Which high school did you graduate from?</label><br/>
                                            <a href="#" id="showInput">School not listed? Click here.</a>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="highSchool" class="form-control" id="ddHighSchool">
                                                @foreach($highschools as $highSchool)
                                                    @if($alumni == 'checked' && $highSchool == $selHighSchool)
                                                        <option value="{{ $highSchool }}" selected>{{ $highSchool }}</option>
                                                    @else
                                                        <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                                                    @endif
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
                                            <input type="radio" name="inSchool" value="true" <?php echo  $inSchool ?>>Yes<br/>
                                            <input type="radio" name="inSchool" value="false" <?php echo $notInSchool ?>>No<br/>
                                        </div>
                                    </div>

                                    <div id="fields" class="form-group">
                                        <label for="fieldOfStudy" class="col-md-6 control-label">What are you studying or did you study in post secondary?</label>

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
                                        <label for="school" class="col-md-6 control-label">Which school(s) are you attending or did you attend?</label>

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
                                                <input type="checkbox" name="school[]" value="other"> <input type="text" name="otherSchool" placeholder="Other school..." /><br/>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="fields" class="form-group">
                                        <label for="degree" class="col-md-6 control-label">Which degree(s) are you pursuing or have achieved?</label>

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
                                        <label for="inSchool" class="col-md-6 control-label">Tell us a bit about yourself.</label>

                                        <div class="col-md-12">
                                            <textarea name="bio" id="bio" rows ="3" placeholder="Current student at {school} studying {field} and am expected to graduate in June 2018..." class="form-control">@if($alumni == 'checked') {{$bio}} @endif</textarea>
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
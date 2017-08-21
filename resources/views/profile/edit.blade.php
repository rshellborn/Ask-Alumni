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

@section('title')
    Edit Profile
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
    @if(session()->has('error'))
        <div class="alert alert-danger text-center" role="alert">
            <span>{{session()->get('error')}}</span>
        </div>
    @endif

    <div class="row">
        <div class="form-group">
            <h4 class="col-md-6 control-label text-right">You are currently registered as {{$type}}.</h4>
            <div class="text-center">
                <button class="btn btn-warning" onclick="window.location='{{ url('/profile/complete/' . strtolower($otherType)) }}'">Switch to {{$otherType}}</button>
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
                    <input type="hidden" name="type" value="{{$type}}">
                    <input type="submit" class="btn btn-danger" value="Delete" />
                </form>
            </div>
        </div>
    </div>
    <hr class="thick-hr"/>

    <form class="form-horizontal" role="form" method="POST" action="{{url('/profile/edit') }}">
        {{ csrf_field() }}
        <input type="hidden" value="{{ $accType }}" name="accType" />

        <div class="row">
            <div class="col-md-12 text-center">
                <h4><strong>Education</strong></h4>
                <div class="col-md-6 col-md-offset-3">
                    @if($accType == 'Alumni')
                        <label for="ddhighschool">Which high school did you attend?</label>
                    @elseif($accType == 'Student')
                        <label for="ddhighschool">Which high school do you attend?</label>
                    @endif
                    <select name="highSchool" class="form-control" id="ddHighSchool">
                        @foreach($highschools as $highSchool)
                            @if($alumni == 'checked' && $highSchool == $selHighSchool)
                                <option value="{{ $highSchool }}" selected>{{ $highSchool }}</option>
                            @else
                                <option value="{{ $highSchool }}">{{ $highSchool }}</option>
                            @endif
                        @endforeach
                    </select>
                    <a href="javascript:void(0);" id="showInputHS">High school not listed? Click here.</a>
                    <div id="otherHS">
                        <input type="text" name="otherHighSchool" class="form-control" placeholder="Enter your high school"/>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
                <div class="col-md-12 text-center">
                    @if($accType == 'Alumni')
                        <label for="school[]">Which post secondary institutions are you attending or did you attend?</label>
                    @elseif($accType == 'Student')
                        <label for="school[]">Which post secondary institutions are you interested in?</label>
                    @endif
                </div>
                <div class="col-md-5 col-md-offset-2">
                    @foreach($schools1 as $school)
                        @if(in_array($school->name, $selSchools))
                            <input type="checkbox" name="school[]" value="{{ $school->name }}" checked> {{ $school->name }}<br/>
                        @else
                            <input type="checkbox" name="school[]" value="{{ $school->name }}"> {{ $school->name }}<br/>
                        @endif
                    @endforeach
                </div>

                <div class="col-md-5">
                    @foreach($schools2 as $school)
                        @if(in_array($school->name, $selSchools))
                            <input type="checkbox" name="school[]" value="{{ $school->name }}" checked> {{ $school->name }}<br/>
                        @else
                            <input type="checkbox" name="school[]" value="{{ $school->name }}"> {{ $school->name }}<br/>
                        @endif
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

        @if($accType == 'Alumni')
            <div class="row text-center">
                <label for="inSchool">Are you still attending a post secondary institution?</label>
                <div class="col-md-6 col-md-offset-3 text-center">

                    <input type="radio" name="inSchool" value="true" <?php echo  $inSchool ?>> Yes<br/>
                    <input type="radio" name="inSchool" value="false" <?php echo $notInSchool ?>> No<br/>
                </div>
            </div>
        <hr />
        @endif

        <div class="row">
            <div class="col-md-12 text-center">
                @if($accType == 'Alumni')
                    <label for="fieldOfStudy[]">What are you studying or did you study in post secondary?</label>
                @elseif($accType == 'Student')
                    <label for="fieldOfStudy[]">Which fields of study are you interested in?</label>
                @endif
            </div>
            <div class="col-md-5 col-md-offset-2">
                @foreach($fields1 as $field)
                    @if(in_array($field->name, $selFields))
                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}" checked> {{ $field->name }}<br/>
                    @else
                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}"> {{ $field->name }}<br/>
                    @endif
                @endforeach
            </div>

            <div class="col-md-5">
                @foreach($fields2 as $field)
                    @if(in_array($field->name, $selFields))
                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}" checked> {{ $field->name }}<br/>
                    @else
                        <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}"> {{ $field->name }}<br/>
                    @endif
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
                @if($accType == 'Alumni')
                    <label for="degree[]">What are you studying or did you study in post secondary?</label>
                @elseif($accType == 'Student')
                    <label for="degree[]">Which fields of study are you interested in?</label>
                @endif
            </div>
            <div class="col-md-6 col-md-offset-5">
                @foreach($degrees as $degree)
                    @if(in_array($degree->name, $selDegrees))
                        <input type="checkbox" name="degree[]" value="{{ $degree->name }}" checked> {{ $degree->name }}<br/>
                    @else
                        <input type="checkbox" name="degree[]" value="{{ $degree->name }}"> {{ $degree->name }}<br/>
                    @endif
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

        @if($accType == 'Alumni')
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <label for="bio">Tell everyone a bit about yourself.</label>
                    <textarea name="bio" id="bio" rows ="3" placeholder="Current student at {school} studying {field} and am expected to graduate in June 2018..." class="form-control">@if($alumni == 'checked') {{$bio}} @endif</textarea>
                </div>
            </div>
            <hr/>
        @endif

        <div class="row text-center">
            <button type="submit" class="btn btn-pink">
                Save
            </button>
        </div>
    </form>
@endsection
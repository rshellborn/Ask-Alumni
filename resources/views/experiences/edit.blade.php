@extends('layouts.maincontent')

@section('styles')
    <style>
        .panel-default > .panel-heading{
            background-color: #f7f7f7;
        }
        .panel-default > .panel-heading:hover{
            cursor: pointer;
            font-weight: bold;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $('#collapseOne').collapse("show");
        $('#collapseTwo').collapse("show");
        $('#collapseThree').collapse("show");

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
    Share your post-secondary experience
@endsection

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/experiences/edit/' . $id) }}">
        {{ csrf_field() }}

        <div class="form-group">
            <div class="col-md-12">
                <input type="text" name="title" placeholder="Title" class="form-control" value="{{$title}}" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <textarea name="body" placeholder="Tell everyone about your experience at post-secondary" class="form-control" rows="8" required>{{ $body }}</textarea>
            </div>
        </div>




        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <h4 class="panel-title">
                        Select post-secondary institution
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="col-md-5 col-md-offset-2">
                            @foreach($schools1 as $school)
                                @if(in_array($school->name, $selSchools))
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="school[]" value="{{ $school->name }}" checked> {{ $school->name }}
                                        </label>
                                    </div>
                                @else
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="school[]" value="{{ $school->name }}"> {{ $school->name }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="col-md-5">
                            @foreach($schools2 as $school)
                                @if(in_array($school->name, $selSchools))
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="school[]" value="{{ $school->name }}" checked> {{ $school->name }}
                                        </label>
                                    </div>
                                @else
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="school[]" value="{{ $school->name }}"> {{ $school->name }}
                                        </label>
                                    </div>
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
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <h4 class="panel-title">
                        Select field of study
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <div class="col-md-12 text-center">
                            <label for="fieldOfStudy[]">Select one or more field of study for this experience.</label>
                        </div>
                        <div class="col-md-5 col-md-offset-2">
                            @foreach($fields1 as $field)
                                @if(in_array($field->name, $selFields))
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}" checked> {{ $field->name }}</label>
                                    </div>
                                @else
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}"> {{ $field->name }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="col-md-5">
                            @foreach($fields2 as $field)
                                @if(in_array($field->name, $selFields))
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}" checked> {{ $field->name }}
                                        </label>
                                    </div>
                                @else
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="fieldOfStudy[]" value="{{ $field->name }}"> {{ $field->name }}
                                        </label>
                                    </div>
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
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <h4 class="panel-title">
                        Select degree
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <div class="col-md-6 col-md-offset-5">
                            @foreach($degrees as $degree)
                                @if(in_array($degree->name, $selDegrees))
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="degree[]" value="{{ $degree->name }}" checked> {{ $degree->name }}
                                        </label>
                                    </div>
                                @else
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="degree[]" value="{{ $degree->name }}"> {{ $degree->name }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="text-center">
            <button type="submit" class="btn btn-pink">Update Experience</button>
        </div>
    </form>

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/experiences/delete/' . $id) }}">
        {{ csrf_field() }}
        <div class="text-center" style="margin-top: 30px;">
            <button type="submit" class="btn btn-danger">Delete</button>
        </div>
    </form>
@endsection

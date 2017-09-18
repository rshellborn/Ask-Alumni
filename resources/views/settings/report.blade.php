@extends('layouts.maincontent')

@section('title')
    Report User
@endsection

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/report') }}"
          xmlns="http://www.w3.org/1999/html">
        {{ csrf_field() }}

        <div class="col-md-10 col-md-offset-2">
            <div class="form-group">
                <label for="userName" class="col-sm-3 control-label">Reporting user:</label>
                <div class="col-md-7">
                    <input type="hidden" name="id" value="{{$user->id}}"/>
                    <input type="text" name="userName" class="form-control" value="{{$user->name}}" readonly/><br/>
                </div>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-2">
            <div class="form-group">
                <label for="reason" class="col-sm-3 control-label">Why are you reporting this person?</label>
                <div class="col-md-7">
                    <textarea name="reason" class="form-control" rows="5" required></textarea><br/>
                </div>
            </div>
        </div>

        <br/>
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-danger">
                    Report User
                </button>
            </div>
        </div>
    </form>
@endsection
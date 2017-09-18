@extends('layouts.maincontent')

@section('title')
    Block User
@endsection

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/block') }}"
          xmlns="http://www.w3.org/1999/html">
        {{ csrf_field() }}

        <div class="col-md-10 col-md-offset-2">
            <div class="form-group">
                <label for="userName" class="col-sm-3 control-label">Blocking user:</label>
                <div class="col-md-7">
                    <input type="hidden" name="id" value="{{$user->id}}"/>
                    <input type="text" name="userName" class="form-control" value="{{$user->name}}" readonly/><br/>
                </div>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-2">
            <div class="form-group">
                <label for="reason" class="col-sm-3 control-label">Reason for blocking:</label>
                <div class="col-md-7">
                    <textarea name="reason" class="form-control" rows="5"></textarea><br/>
                </div>
            </div>
        </div>

        <div class="col-md-offset-3">
            <p>Blocking this person means: </p>
            <ul>
                <li>They can't message you or view your profile</li>
                <li>They can't search for your profile and will not be matched with you</li>
                <li>All previous messages with this person will be deleted</li>
            </ul>
        </div>

        <br/>
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-danger">
                    Block User
                </button>
            </div>
        </div>
    </form>
@endsection
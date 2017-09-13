@extends('layouts.maincontent')

@section('title')
    {{ $log }} Log
@endsection

@section('content')
    <textarea class="col-md-12 form-control" rows="25">{{$contents}}</textarea>
@endsection

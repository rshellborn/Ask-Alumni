@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><strong>Share some advice with high school students</strong></h4>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/advice/edit/' . $id) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="action" value="save">

                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" name="title" placeholder="Title" class="form-control" required value="{{$title}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea name="body" placeholder="What is your advice to high school students going to post-secondary?" class="form-control" rows="8" required>{{$body}}</textarea>
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-12">--}}
                                    {{--<label for="tags" class="col-md-6 control-label">Tags (separate by a comma)</label>--}}
                                    {{--<input type="text" name="tags" placeholder="first year, essential, textbooks" class="form-control">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/advice/edit/' . $id) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="action" value="delete">
                            <div class="text-center">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Searches Report</div>
                    <div class="panel-body">
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>User Type</th>
                                <th>High School</th>
                                <th>School</th>
                                <th>Field</th>
                                <th>Degree</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($searches as $search)
                                <tr>
                                    <td>{{\DB::table('users')->where('id', $search->user_id)->value('name')}}</td>
                                    <td>{{$search->user_type}}</td>
                                    <td>{{$search->high_school}}</td>
                                    <td>{{$search->school}}</td>
                                    <td>{{$search->field}}</td>
                                    <td>{{$search->degree}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

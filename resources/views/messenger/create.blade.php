@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4><strong>New Conversation</strong></h4>
                    </div>

                    <div class="panel-body">
                        {!! Form::open(['route' => 'messages.store']) !!}
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Recipient:</strong> {{ $user->name }}
                            </div>

                            <!-- Subject Form Input -->
                            <div class="form-group">
                                {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
                                <input type="text" name="subject" class="form-control" required />
                            </div>

                            <!-- Message Form Input -->
                            <div class="form-group">
                                {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
                                <textarea class="form-control" name="message" required></textarea>
                            </div>

                            {{--@if($users->count() > 0)--}}
                                {{--<div class="checkbox">--}}
                                    {{--@foreach($users as $user)--}}
                                        {{--<label title="{{ $user->name }}"><input type="checkbox" name="recipients[]" value="{{ $user->id }}">{!!$user->name!!}</label>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--@endif--}}

                            <input type="hidden" name="recipients[]" value="{{ $user->id }}">
                            <input type="hidden" name="trigger" value="{{ $trigger }}">

                        <!-- Submit Form Input -->
                            <div class="form-group">
                                {!! Form::submit('Send', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

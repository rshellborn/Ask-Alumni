@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="contact" method="POST" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="type">I have...</label><br/>
                                <select id='type' name="type" class="form-control">
                                    <option value="Idea">an idea</option>
                                    <option value="Question">a question</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="message" name="message" rows="10" required></textarea>
                            </div>

                            <div class="text-center">
                                <button id="submit" name="submit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

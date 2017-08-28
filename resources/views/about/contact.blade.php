@extends('layouts.maincontent')

@section('title')
    Contact
@endsection

@section('content')
    <form action="contact" method="POST" >
        {{ csrf_field() }}
        <div class="form-group">
            <label for="type">Reason for contacting us</label><br/>
            <select id='type' name="type" class="form-control">
                <option value="QuestionIssueBug">Question/Issue/Bug Found</option>
                <option value="Idea">Suggestion for the site</option>
                <option value="Request">Request to add school, field, or degree</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" rows="10" required></textarea>
        </div>

        <div class="text-center">
            <button id="submit" name="submit" type="submit" class="btn btn-pink">Submit</button>
        </div>
    </form>
@endsection

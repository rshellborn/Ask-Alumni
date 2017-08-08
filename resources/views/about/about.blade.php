@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="text-center">What is Ask Alumni?</h3>
                        <p>Ask Alumni is a website where high school students can discuss, ask questions, and communicate with
                            Alumni.</p>
                        <p>The purpose of this site was to make a bridge to allow high school students to get in contact with
                            Alumni and get personal experiences and answers to their questions.</p>

                        <h3 class="text-center">Benefits for Students</h3>
                        <ul>
                            <li>Ask questions to Alumni who are attending post-secondary schools, studying in fields, and pursuing degrees you are interested in</li>
                            <li>Discuss with other high school students</li>
                            <li>Get personal advice from Alumni</li>
                        </ul>

                        <h3 class="text-center">Benefits for Alumni</h3>
                        <ul>
                            <li>Share your stories and experiences with students</li>
                            <li>Give students information about schools, fields of study, and degrees they would not be able to get anywhere else</li>
                            <li>Give advice to students that will help them in their post-secondary journey</li>
                            <li>Discuss with other alumni</li>
                        </ul>

                        <h3 class="text-center">Have an idea for the website or any questions?</h3>
                        <h4 class="text-center"><button class="btn btn-primary" onclick="window.location='{{ url('contact') }}'">Click here!</button></h4>

                        <p style="font-style: italic; font-size: 12px;" class="text-right"><a target="_blank" href="http://rachelshellborn.me">RS Web Development</a> &copy; 2017<br/>
                        Graphics created by Melayna Vergara</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

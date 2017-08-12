@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-center">
                            <h4><strong>Point System</strong></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                        <h4 class="text-center"><strong>How to Earn Points</strong></h4>
                        <p class="text-center">You receive the following points each time you do the following...</p>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Action</th>
                                <th>Points Earned</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Receive a like on your Advice thread</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>Create a thread in the forums</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Create a post in the forums</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Start a conversation with someone</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>Receive points from someone in private messages</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>Successfully registering</td>
                                    <td>10</td>
                                </tr>
                            </tbody>
                        </table>
                        <br/>
                        <h4 class="text-center"><strong>Ranks</strong></h4>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Points Range</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><img style="display:inline;" src="{{ url('bronze-cap.png') }}" /> Bronze</td>
                                <td>0-149</td>
                            </tr>
                            <tr>
                                <td><img style="display:inline;" src="{{ url('silver-cap.png') }}" /> Silver</td>
                                <td>150-399</td>
                            </tr>
                            <tr>
                                <td><img style="display:inline;" src="{{ url('gold-cap.png') }}" /> Gold</td>
                                <td>400-799</td>
                            </tr>
                            <tr>
                                <td><img style="display:inline;" src="{{ url('platinum-cap.png') }}" /> Platinum</td>
                                <td>800</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

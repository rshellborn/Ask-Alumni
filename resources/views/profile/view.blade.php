@extends('layouts.maincontent')

@section('scripts')
    @if($displayModal)
        <script>
            $('#myModal').modal('show');
        </script>
    @endif

    <script type="text/javascript">
        $(function(){
            $('#favourite').click(function(e){
                e.preventDefault();
                $('#favourite').hide();
                $('#unfavourite').show();
                var userId = $('input[name="user"]').val();
                var data = { user: userId };
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'/profile/addfavourite',
                    type:'POST',
                    data:JSON.stringify(data),
                    contentType:"application/json",
                    processData:false,
                    success:function(data){
                    },
                    error:function(data){
                        console.log('error ' +data.responseJSON);
                    }
                });
            });

            $('#unfavourite').click(function(e){
                e.preventDefault();
                $('#favourite').show();
                $('#unfavourite').hide();
                var userId = $('input[name="user"]').val();
                var data = { user: userId };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'/profile/removefavourite',
                    type:'POST',
                    data:JSON.stringify(data),
                    contentType:"application/json",
                    processData:false,
                    success:function(data){
                    },
                    error:function(data){
                        console.log('error ' +data.responseJSON);
                    }
                });
            });
        });
    </script>
@endsection

@section('modal')
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-header" style="background-color: #1ea896; color: white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Congratulations!</strong></h4>
                </div>
                <div class="modal-body">
                    <h4>You just earned 10 points for registering!</h4><br/>
                    <button class="btn btn-pink" onclick="window.location='{{ url('/pointsystem') }}'">What are points?</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-2" style="padding-bottom: 10px">
                        @if($id != Auth::user()->id)
                            <a href="{{route('message.read', ['id'=>$id])}}" class="btn btn-pink">Message</a>
                        @endif

                        @if($usersProfile)
                            <button class="btn btn-pink" onclick="window.location='{{ url('/profile/edit') }}'">Edit Profile</button>
                        @endif
                    </div>

                    <div class="col-md-8 text-center" style="padding-bottom: 10px;">
                        <div class="row" style="background-color: #4c5454;border-radius: 10px">
                            <div class="media">
                                <div class="media-left" style="background-color: #1ea896; padding-right: 0; border-top-left-radius: 10px; border-bottom-left-radius: 10px">
                                    <img src="{{url('/avatars/' . $avatar)}}" style="width: 200px; height: 200px; border-radius:100px;margin:10px" />
                                </div>
                                <div class="media-body media-middle" style="background-color: #4c5454; color: white; border-radius: 10px">
                                    <h4 style="font-weight: bold;">{{$name}}</h4>
                                    <h4>{{$type}}</h4>
                                    <a href="/rankings" style="text-decoration: none;">
                                        <div>
                                            <img src="{{url(strtolower(Auth::user()->rank) . '-cap.png')}}" />
                                            <h5 style="color: white; display:inline">Rank {{ $rank }} - {{$points}} points</h5>
                                        </div>
                                    </a>
                                    @if($type == 'Alumni')
                                        <h5>Attended {{$highSchool}}</h5>
                                        @if(!$inSchool)
                                            <p>Graduated from post-secondary.</p>
                                        @else
                                            <p>Currently attending a post-secondary institution.</p>
                                        @endif
                                    @elseif($type == 'Student')
                                        <h5>Attends {{$highSchool}}</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 text-right">
                        <input type="hidden" name="user" value="{{$id}}" />
                        @if($id != Auth::user()->id)
                            @if(\DB::table('users')->where('id', Auth::user()->id)->where('favourites_user_ids', 'like', '%'.$id.'%')->count() == 0)
                                <img id="favourite" style="cursor: pointer; cursor: hand;"  src="{{url('star.png')}}" />
                                <img id="unfavourite" style="cursor: pointer; cursor: hand; display:none;" src="{{url('star-filled.png')}}" />
                            @else
                                <img id="favourite" style="cursor: pointer; cursor: hand; display:none;"  src="{{url('star.png')}}" />
                                <img id="unfavourite" style="cursor: pointer; cursor: hand;" src="{{url('star-filled.png')}}" />
                            @endif
                        @endif
                    </div>
                </div>

                <div class="row" style="padding-right: 20px; padding-left: 20px">

                    @if($type == 'Alumni')
                        <p class="text-center" style="font-weight: bold; padding-bottom: 20px">{{$bio}}</p>
                    @endif

                    <div class="row">
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading text-center" style="background-color: #1ea896; color: white; font-weight: bold;">
                                    @if($type == 'Alumni')
                                        Post Secondary Institutions
                                    @elseif($type == 'Student')
                                        Post secondary institutions interested in
                                    @endif
                                </div>
                                <div class="panel-body">
                                    @foreach($schools as $school)
                                        <p>{{$school}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="panel panel-default">
                                <div class="panel-heading text-center" style="background-color: #1ea896; color: white; font-weight: bold;">
                                    @if($type == 'Alumni')
                                        Degrees
                                    @elseif($type == 'Student')
                                        Degrees interested in
                                    @endif
                                </div>
                                <div class="panel-body">
                                    @foreach($degrees as $degree)
                                        <p>{{$degree}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading text-center" style="background-color: #1ea896; color: white; font-weight: bold;">
                                    @if($type == 'Alumni')
                                        Fields of Study
                                    @elseif($type == 'Student')
                                        Fields of study interested in
                                    @endif
                                </div>
                                <div class="panel-body">
                                    @foreach($fields as $field)
                                        <p>{{$field}}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
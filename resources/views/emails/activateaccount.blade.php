Hello {{$name}}, Welcome to Ask Alumni. <br>
Please click <a href="{!! url('/activate', ['code'=>$verification_code]) !!}"> Here</a> to activate your account.
{{$verification_code}}
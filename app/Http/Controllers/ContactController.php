<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) { Talk::setAuthUserId(Auth::user()->id); return $next($request); });

        View::composer('partials.peoplelist', function($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
    }

    public function send() {
        $data = array();

        $data['name'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;
        $data['type'] = Input::get('type');
        $data['body'] = Input::get('message');


        Mail::send('emails.contact', $data, function($message) use ($data)
        {
            $message->subject("Contact - Ask Alumni");
            $message->to('rachel@shellborn.com');
        });

        return view('about.thankyou');
    }
}
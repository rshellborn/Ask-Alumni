<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use Nahid\Talk\Facades\Talk;
use View;
use Illuminate\Support\Facades\Input;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) { Talk::setAuthUserId(Auth::user()->id); return $next($request); });

        View::composer('partials.peoplelist', function($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
    }

    public function index() {
        session_start();
        $user = Auth::user();
        $unsearchable = "";
        $weeklyEmails = "";
        $messageEmails = "";

        if($user->searchable == 0) {
            $unsearchable = "checked";
        }

        if($user['emails-weekly'] == 1) {
            $weeklyEmails = "checked";
        }

        if($user['emails-messages'] == 1) {
            $messageEmails = "checked";
        }

        return view('settings.index', compact('unsearchable', 'weeklyEmails', 'messageEmails'));
    }

    public function unsubscribeView() {
        return view('settings.unsubscribe');
    }

    public function update(Request $request) {
        $newMessage   = Input::get('newMessage');
        $weeklyEmails = Input::get('weeklyEmails');
        $unsearchable = Input::get('unsearchable');

        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'emails-weekly'   => $weeklyEmails == "subscribe" ? true : false,
                'emails-messages' => $newMessage == "subscribe" ? true : false,
                'searchable'      => $unsearchable == "true" ? false : true,
            ]);

        $request->session()->flash('updated', 'Your settings have been saved.');
        return redirect()->action('SettingsController@index');
    }
}

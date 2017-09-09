<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewMessageEmail;
use App\User;
use Illuminate\Http\Request;
use Nahid\Talk\Facades\Talk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use View;
use App\Http\Controllers\NotificationController;

class MessageController extends Controller
{
    protected $authUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) { Talk::setAuthUserId(Auth::user()->id); return $next($request); });

        View::composer('partials.peoplelist', function($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
    }

    public function index() {
        $threads = Talk::threads('desc', 0, 1000);

        if(count($threads) == 0) {
            $flag = true;
        } else {
            $flag = false;
        }

        return view('messenger.index', compact('threads', 'flag'));
    }

    public function chatHistory($id)
    {
        $conversations = Talk::getMessagesByUserId($id);
        $user = '';
        $messages = [];
        if(!$conversations) {
            $user = User::find($id);
        } else {
            $user = $conversations->withUser;
            $messages = $conversations->messages;
        }

        return view('messenger.chat', compact('messages', 'user'));
    }

    public function ajaxSendMessage(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'message-data'=>'required',
                '_id'=>'required'
            ];

            $this->validate($request, $rules);

            $body = $request->input('message-data');
            $userId = $request->input('_id');

            //attempting to create notification
            $notifyUser = User::where('id', $userId)->first();
            $notification = new NotificationController();
            $notification->storeMessage($notifyUser, Auth::user()->id);

            if($notifyUser['emails-messages'] == 1) {
                dispatch(new SendNewMessageEmail($notifyUser));
            }

            $conversations = Talk::getMessagesByUserId($userId);
            if(!$conversations) {
                //give points
                $this->givePoints();
            }

            if ($message = Talk::sendMessageByUserId($userId, $body)) {
                $html = view('ajax.newMessageHtml', compact('message'))->render();
                return response()->json(['status'=>'success', 'html'=>$html], 200);
            }
        }
    }

    public function ajaxDeleteMessage(Request $request, $id)
    {
        if ($request->ajax()) {
            if(Talk::deleteMessage($id)) {
                return response()->json(['status'=>'success'], 200);
            }

            return response()->json(['status'=>'errors', 'msg'=>'something went wrong'], 401);
        }
    }

    public function givePoints() {
        //Give user who created the conversation 5 points
        $points = DB::table('users')->where('id', Auth::user()->id)->value('points');
        $oldPoints = $points;
        $points += 5;
        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'points' => $points,
            ]);
        //check if user has reached next rank
        if($points > 149 && $oldPoints < 149) {
            \DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
                [
                    'rank' => 'Silver',
                ]);
            //attempting to create notification
            $user = User::where('id', Auth::user()->id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Silver');
        } else if ($points > 399 && $oldPoints < 399) {
            \DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
                [
                    'rank' => 'Gold',
                ]);
            //attempting to create notification
            $user = User::where('id', Auth::user()->id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Gold');
        } else if ($points > 799 && $oldPoints < 799) {
            \DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
                [
                    'rank' => 'Platinum',
                ]);
            //attempting to create notification
            $user = User::where('id', Auth::user()->id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Platinum');
        }
    }
}

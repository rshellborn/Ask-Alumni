<?php

namespace App\Http\Controllers;


use App\User;
use Carbon\Carbon;
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
        $searchable = "";
        $allowMessage = "";
        $weeklyEmails = "";
        $featureEmails = "";
        $messageEmails = "";

        if($user->searchable == 1) {
            $searchable = "checked";
        }

        if($user->allowMessage == 1 || $user->allowMessage === null) {
            $allowMessage = "checked";
        }

        if($user['emails-weekly'] == 1) {
            $weeklyEmails = "checked";
        }

        if($user['emails-messages'] == 1) {
            $messageEmails = "checked";
        }

        if($user->emails_news == 1) {
            $featureEmails = "checked";
        }

        //blocked users
        $userIds = $user->blockedUsers;
        $userIds = explode(',', $userIds);


        if($userIds[0] == "") {
            $blockedUsers = null;
        } else {
            $blockedUsers = array();
            foreach($userIds as $userid) {
                $user = DB::table('users')->where('id', $userid)->first();
                array_push($blockedUsers, $user);
            }
        }

        return view('settings.index', compact('allowMessage', 'searchable', 'featureEmails', 'weeklyEmails', 'messageEmails', 'blockedUsers'));
    }

    public function unsubscribeView() {
        return view('settings.unsubscribe');
    }

    public function unsubscribe(Request $request) {
        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'emails-weekly'   => false,
                'emails-messages' => false,
                'emails_news' => false,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

        $request->session()->flash('updated', 'You will no longer receive emails from us.
        You can always update your preferences here if you want to receive emails again.');
        return redirect()->action('SettingsController@index');
    }

    public function update(Request $request) {
        $newMessage   = Input::get('newMessage');
        $allowMessage = Input::get('allowMessage');
        $weeklyEmails = Input::get('weeklyEmails');
        $featureEmails = Input::get('featureEmails');
        $unsearchable = Input::get('unsearchable');


        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'emails-weekly'   => $weeklyEmails == "subscribe" ? true : false,
                'emails-messages' => $newMessage   == "subscribe" ? true : false,
                'emails_news'     => $featureEmails == "subscribe" ? true : false,
                'searchable'      => $unsearchable == "true" ? true : false,
                'allowMessage'    => $allowMessage == "true" ? true : false,
                'updated_at'      => Carbon::now()->toDateTimeString(),
            ]);

        $request->session()->flash('updated', 'Your settings have been saved.');
        return redirect()->action('SettingsController@index');
    }

    public function blockView($id) {
        $user = DB::table('users')->where('id', $id)->first();

        return view('settings.block', compact('user'));
    }

    public function block(Request $request) {
        $id = Input::get('id');
        $reason = Input::get('reason');

        $blockedUsers = DB::table('users')->where('id', Auth::id())->value('blockedUsers');
        $user = DB::table('users')->where('id', $id)->value('name');

        if($blockedUsers == "") {
            $blockedUsers = $id;
        } else {
            $blocked = false;
            //check if user is already blocked
            if (strpos($blockedUsers, ',') == false && $id == $blockedUsers) {
                $blocked = true;
            } else {
                $blockedUsers = explode(',', $blockedUsers);
                foreach($blockedUsers as $blockedUser) {
                    if($blockedUser == $id) {
                        $blocked = true;
                    }
                }
            }

            if($blocked) {
                $request->session()->flash('updated', $user . ' is already blocked.');
                return redirect()->action('SettingsController@index');
            }

            array_push($blockedUsers, $id);
            $blockedUsers = implode(',', $blockedUsers);
        }

        //delete messages from user if there are any
        DB::table('conversations')->where(['user_one' => $id, 'user_two' => Auth::id()])->orWhere(['user_two' => $id, 'user_one' => Auth::id()])->delete();

        //add to this users blocked users
        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'blockedUsers'   => $blockedUsers,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

        //add this user to blocked_by table
        $users_blocked_by = DB::table('users_blocked_by')->where('user_id', $id)->value('blocked_by');

        //check if this user is already in users_blocked_by
        if(strlen($users_blocked_by) == 0) {
            DB::table('users_blocked_by')->where('user_id', $id)->delete();
        }

        if($users_blocked_by == null) {
            //insert into table since no one has blocked this person before
            DB::table('users_blocked_by')->insert(
                [
                    'user_id' => $id,
                    'blocked_by' => Auth::id(),
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]
            );
        } else {
            $users_blocked_by = explode(",", $users_blocked_by);
            //add this user
            array_push($users_blocked_by, Auth::id());
            $users_blocked_by = implode(',', $users_blocked_by);

            DB::table('users_blocked_by')->where('user_id', $id)->limit(1)->update(
                [
                    'blocked_by'   => $users_blocked_by,
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
        }


        //store in blocked users table
        if($reason == null) {
            $reason = "N/A";
        }

        DB::table('user_blocks')->insert(
            [
                'user_id' => Auth::id(),
                'blocked_user_id' => $id,
                'reason' => $reason,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]
        );

        //show flash messsage
        $request->session()->flash('updated', $user . ' has been blocked.');

        return redirect()->action('SettingsController@index');
    }

    public function unblock(Request $request, $userId) {
        $blockedUsers = DB::table('users')->where('id', Auth::user()->id)->value('blockedUsers');
        $blockedUsers = explode(',', $blockedUsers);

        $index = array_search($userId, $blockedUsers);
        unset($blockedUsers[$index]);

        $blockedUsers = implode(',', $blockedUsers);

        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'blockedUsers' => $blockedUsers,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

        //edit blocked_by table
        $blocked_by = DB::table('users_blocked_by')->where('user_id', $userId)->value('blocked_by');
        $blocked_by = explode(',', $blocked_by);
        $index = array_search(Auth::id(), $blocked_by);
        unset($blocked_by[$index]);
        $blocked_by = implode(',', $blocked_by);

        DB::table('users_blocked_by')->where('user_id', $userId)->limit(1)->update(
            [
                'blocked_by' => $blocked_by,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

        //remove user block in this table
        DB::table('user_blocks')->where('user_id', Auth::id())->where('blocked_user_id', $userId)->delete();

        $user = DB::table('users')->where('id', $userId)->value('name');
        //show flash messsage
        $request->session()->flash('updated', $user . ' has been unblocked.');
        // show blocked users tab

        return redirect()->action('SettingsController@index');
    }

    public function reportView($id) {
        $user = DB::table('users')->where('id', $id)->first();

        return view('settings.report', compact('user'));
    }

    public function report(Request $request) {
        $id = Input::get('id');
        $reason = Input::get('reason');

        //store in blocked users table
        DB::table('reported_users')->insert(
            ['user_id' => Auth::id(), 'reported_user_id' => $id, 'reason' => $reason, 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()]
        );

        $notification = new NotificationController();
        $user = User::where('email', 'rachel@shellborn.com')->first();
        $notification->storeReport($user);

        $user = DB::table('users')->where('id', $id)->value('name');

        //show flash messsage
        $request->session()->flash('updated', $user . ' has been reported.');

        return redirect()->action('SettingsController@index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Http\Requests;
use Image;

class ProfileController extends Controller
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
        $displayModal = false;
        if(isset($_SESSION["registered"])) {
            unset($_SESSION['registered']);
            $displayModal = true;
        }

        $user = Auth::user();

        $avatar = $user->avatar;
        $type = $user->type;
        $points = $user->points;
        $rank = $user->rank;

        $fields = $user->fields;
        $fields = explode(",", $fields);
        $schools = $user->schools;
        $schools = explode(",", $schools);
        $email = $user->email;
        $name = $user->name;
        $highSchool = $user->highSchool;
        $inSchool = $user->inSchool;

        $usersProfile = true;

        $id = $user->id;
        $url = 'profile/edit';

        $degrees = $user->degrees;
        $degrees = explode(",", $degrees);

        if($type == "Alumni") {
            $bio = $user->bio;

            return view('profile.alumni', compact('url', 'avatar', 'displayModal', 'rank', 'points', 'usersProfile', 'highSchool', 'id', 'name', 'bio', 'email', 'fields', 'schools', 'degrees', 'inSchool'));
        }

        return view('profile.student', compact('highSchool', 'avatar', 'displayModal', 'email', 'rank', 'degrees', 'url', 'id', 'points', 'usersProfile', 'name', 'fields', 'schools', 'inSchool'));
    }

    public function view($id) {
        $displayModal = false;
        $user = DB::table('users')->where('id', $id)->first();

        $usersProfile = false;

        $type = $user->type;
        $points = $user->points;
        $rank = $user->rank;
        $avatar = $user->avatar;

        $fields = $user->fields;
        $fields = explode(",", $fields);
        $schools = $user->schools;
        $schools = explode(",", $schools);
        $email = $user->email;
        $name = $user->name;
        $highSchool = $user->highSchool;
        $id = $user->id;

        $degrees = $user->degrees;
        $degrees = explode(",", $degrees);

        $url = 'profile/edit';

        if($type == "Alumni") {
            $inSchool = $user->inSchool;

            $bio = $user->bio;

            return view('profile.alumni', compact('url', 'avatar', 'displayModal', 'points', 'rank', 'usersProfile', 'highSchool', 'id', 'name', 'bio', 'email', 'fields', 'schools', 'degrees', 'inSchool'));
        }

        return view('profile.student', compact('highSchool', 'avatar', 'displayModal', 'email', 'degrees', 'rank', 'url', 'id', 'points', 'usersProfile', 'name', 'fields', 'schools', 'inSchool'));
    }

    public function edit() {
        $user = Auth::user();

        $url = 'profile/edit';

        $avatar = $user->avatar;

        $type = $user->type;
        $accType = $type;

        $selHighSchool = $user->highSchool;
        $selSchools = explode(',', $user->schools);
        $selFields = explode(',', $user->fields);
        $selDegrees = explode(',', $user->degrees);

        if($type == 'Alumni') {
            $alumni = 'checked';
            $student = '';
        } else if ($type == 'Student') {
            $alumni = '';
            $student = 'checked';
        }

        if($type == 'Alumni') {
            $inSchool = $user->inSchool;

            if($inSchool) {
                $inSchool = "checked";
                $notInSchool = "";
            } else {
                $inSchool = "";
                $notInSchool = "checked";
            }

            $bio = $user->bio;
        }

        //get high schools
        $allhighschools = \App\HighSchool::all();

        $highschools = array();

        foreach($allhighschools as $school) {
            $highschools[$school->name] = $school->name;
        }

        //get degrees
        $degrees = DB::table('degrees')->get();

        //get post secondary schools
        $schools = DB::table('schools')->get()->toArray();
        $splitSize = ceil(sizeof($schools) / 2);
        $schools1 = array_slice($schools, 0, $splitSize);
        $schools2 = array_slice($schools, $splitSize);

        //get fields of study
        $fields = DB::table('fields')->get()->toArray();
        $splitSize = ceil(sizeof($fields) / 2);
        $fields1 = array_slice($fields, 0, $splitSize);
        $fields2 = array_slice($fields, $splitSize);

        $otherType = $type == 'Alumni' ? 'Student' : 'Alumni';
        $type = $type == 'Alumni' ? 'an Alumni' : 'a Student';


        return view('profile.edit',  compact('url', 'avatar', 'accType', 'otherType', 'type', 'student', 'alumni', 'selDegrees', 'selFields', 'selSchools', 'selHighSchool', 'bio', 'inSchool', 'notInSchool', 'highschools', 'schools1', 'schools2', 'fields1', 'fields2', 'degrees'));
    }

    public function alumniComplete() {
        //get high schools
        $allhighschools = \App\HighSchool::all();

        $highschools = array();

        foreach($allhighschools as $school) {
            $highschools[$school->name] = $school->name;
        }

        //get degrees
        $degrees = DB::table('degrees')->get();

        //get post secondary schools
        $schools = DB::table('schools')->get()->toArray();
        $splitSize = ceil(sizeof($schools) / 2);
        $schools1 = array_slice($schools, 0, $splitSize);
        $schools2 = array_slice($schools, $splitSize);

        //get fields of study
        $fields = DB::table('fields')->get()->toArray();
        $splitSize = ceil(sizeof($fields) / 2);
        $fields1 = array_slice($fields, 0, $splitSize);
        $fields2 = array_slice($fields, $splitSize);

        return view('profile.complete.alumni',  compact('schools1', 'schools2', 'fields1', 'fields2', 'degrees', 'highschools'));
    }

    public function studentComplete() {
        //get high schools
        $allhighschools = \App\HighSchool::all();

        $highschools = array();

        foreach($allhighschools as $school) {
            $highschools[$school->name] = $school->name;
        }

        //get degrees
        $degrees = DB::table('degrees')->get();

        //get post secondary schools
        $schools = DB::table('schools')->get()->toArray();
        $splitSize = ceil(sizeof($schools) / 2);
        $schools1 = array_slice($schools, 0, $splitSize);
        $schools2 = array_slice($schools, $splitSize);

        //get fields of study
        $fields = DB::table('fields')->get()->toArray();
        $splitSize = ceil(sizeof($fields) / 2);
        $fields1 = array_slice($fields, 0, $splitSize);
        $fields2 = array_slice($fields, $splitSize);

        return view('profile.complete.student',  compact('schools1', 'schools2', 'fields1', 'fields2', 'degrees', 'highschools'));
    }

    public function save() {
        $accType = Input::get('accType');
        $fields = Input::get('fieldOfStudy');
        $schools = Input::get('school');
        $highSchool = Input::get('highSchool');
        $degree = Input::get('degree');

        //check if user selected other high school or school
        $otherHighSchool = Input::get('otherHighSchool');

        if($otherHighSchool != null) {
            $highSchool = $otherHighSchool;
        }

        if($schools != null) {
            $replaceFlag = false;
            if (in_array('other', $schools)) {
                $replaceFlag = true;
            }
        }

        if(count($fields) > 0) {
            $fields = implode(",", $fields);
        } else {
            $fields = '';
        }
        if(count($schools) > 0) {
            $schools = implode(",", $schools);
            if($replaceFlag) {
                $schools = str_replace('other', Input::get('otherSchool'), $schools);
            }
        } else {
            $schools = '';
        }
        if(count($degree) > 0) {
            $degree = implode(",", $degree);
        }

        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'type' => $accType,
                'fields' => $fields,
                'schools' => $schools,
                'degrees' => $degree,
                'highSchool' => $highSchool,
            ]);

        if($accType == "Alumni") {
            $bio = Input::get('bio');
            $inSchool = Input::get('inSchool');

            DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
                [
                    'bio' => $bio,
                    'inSchool' => $inSchool == "true" ? true : false,
                ]);
        }

        if(Auth::user()->avatar == 'default') {
            $user = Auth::user();

            if($accType == 'Alumni') {
                $user->avatar = 'default-alumni.png';
            } elseif ($accType == 'Student') {
                $user->avatar = 'default-student.png';
            }

            $user->save();
        }

        return redirect()->action('ProfileController@index');
    }

    public function addfavourite(Request $request) {
        $userID   = $request->input('user');

        $favourites = DB::table('users')->where('id', Auth::user()->id)->value('favourites');
        $users = DB::table('users')->where('id', Auth::user()->id)->value('favourites_user_ids');
        if($favourites == 0) {
            $users = $userID;
        } else if($favourites == 1) {
            $users = $users . ',' . $userID;
        } else {
            $users = explode(',', $users);
            array_push($users, $userID);
            $users = implode(',', $users);
        }

        $favourites++;
        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'favourites_user_ids' => $users,
                'favourites' => $favourites
            ]);
    }

    public function removefavourite(Request $request) {
        $userID   = $request->input('user');

        $favourites = DB::table('users')->where('id', Auth::user()->id)->value('favourites');
        $users = DB::table('users')->where('id', Auth::user()->id)->value('favourites_user_ids');

        $favourites--;
        if($favourites == 0) {
            $users = '';
        } else if($favourites == 1) {
            $usersArr = explode(',', $users);
            $index = array_search($userID, $usersArr);
            $users = $index == 1 ? $usersArr[0]: $usersArr[1];
        } else {
            $usersArr = explode(',', $users);
            $index = array_search($userID, $usersArr);
            unset($usersArr[$index]);
            $users = implode(',', $usersArr);
        }

        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'favourites_user_ids' => $users,
                'favourites' => $favourites
            ]);
    }

    public function favourites() {
        $favourites = DB::table('users')->where('id', Auth::user()->id)->value('favourites');
        $userids = DB::table('users')->where('id', Auth::user()->id)->value('favourites_user_ids');
        $userids = explode(',', $userids);

        $users = array();
        foreach($userids as $userid) {
            $user = DB::table('users')->where('id', $userid)->first();
            array_push($users, $user);
        }

        return view('profile.favourites',  compact('favourites', 'users'));
    }

    public function avatar(Request $request) {
        // Handle the user upload of avatar
        if($request->input('action') == 'upload') {
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $prevAvatar = DB::table('users')->where('id', Auth::user()->id)->value('avatar');

                Image::make($avatar)->fit(300)->save(public_path('/avatars/' . $filename));

                if($prevAvatar != 'default-student.png' && $prevAvatar != 'default-alumni.png') {
                    if (file_exists(public_path('/avatars/' . $prevAvatar))) {
                        unlink(public_path('/avatars/' . $prevAvatar));
                    }
                }

                $user = Auth::user();
                $user->avatar = $filename;
                $user->save();
            }
        } else if ($request->input('action') == 'delete') {
            $prevAvatar = DB::table('users')->where('id', Auth::user()->id)->value('avatar');

            if($prevAvatar != 'default-student.png' && $prevAvatar != 'default-alumni.png') {
                if (file_exists(public_path('/avatars/' . $prevAvatar))) {
                    unlink(public_path('/avatars/' . $prevAvatar));
                }
            }

            if($request->input('type') == 'a Student') {
                $filename = 'default-student.png';
            } else if($request->input('type') == 'an Alumni') {
                $filename = 'default-alumni.png';
            }

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return $this->edit();
    }
}
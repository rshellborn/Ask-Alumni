<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Http\Requests;
use Image;
use Nahid\Talk\Facades\Talk;
use View;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function type() {
        return view('profile.type');
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
        }

        return view('profile.view', compact('highSchool', 'bio', 'type', 'inSchool', 'avatar', 'displayModal', 'email', 'degrees', 'rank', 'url', 'id', 'points', 'usersProfile', 'name', 'fields', 'schools', 'inSchool'));
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

        $inSchool = false;
        $bio = "";

        if($type == "Alumni") {
            $inSchool = $user->inSchool;

            $bio = $user->bio;
        }

        return view('profile.view', compact('highSchool', 'bio', 'type', 'inSchool', 'avatar', 'displayModal', 'email', 'degrees', 'rank', 'url', 'id', 'points', 'usersProfile', 'name', 'fields', 'schools', 'inSchool'));
    }

    public function edit() {
        $user = Auth::user();

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
        $degrees = DB::table('degrees')->orderBy('name')->get();

        //get post secondary schools
        $schools = DB::table('schools')->orderBy('name')->get()->toArray();
        $splitSize = ceil(sizeof($schools) / 2);
        $schools1 = array_slice($schools, 0, $splitSize);
        $schools2 = array_slice($schools, $splitSize);

        //get fields of study
        $fields = DB::table('fields')->orderBy('name')->get()->toArray();
        $splitSize = ceil(sizeof($fields) / 2);
        $fields1 = array_slice($fields, 0, $splitSize);
        $fields2 = array_slice($fields, $splitSize);

        $otherType = $type == 'Alumni' ? 'Student' : 'Alumni';
        $type = $type == 'Alumni' ? 'an Alumni' : 'a Student';


        return view('profile.edit',  compact('avatar', 'accType', 'otherType', 'type', 'student', 'alumni', 'selDegrees', 'selFields', 'selSchools', 'selHighSchool', 'bio', 'inSchool', 'notInSchool', 'highschools', 'schools1', 'schools2', 'fields1', 'fields2', 'degrees'));
    }

    public function alumniComplete() {
        $avatar = Auth::user()->avatar;

        //get high schools
        $allhighschools = \App\HighSchool::all();

        $highschools = array();

        foreach($allhighschools as $school) {
            $highschools[$school->name] = $school->name;
        }

        //get degrees
        $degrees = DB::table('degrees')->orderBy('name')->get();

        //get post secondary schools
        $schools = DB::table('schools')->orderBy('name')->get()->toArray();
        $splitSize = ceil(sizeof($schools) / 2);
        $schools1 = array_slice($schools, 0, $splitSize);
        $schools2 = array_slice($schools, $splitSize);

        //get fields of study
        $fields = DB::table('fields')->orderBy('name')->get()->toArray();
        $splitSize = ceil(sizeof($fields) / 2);
        $fields1 = array_slice($fields, 0, $splitSize);
        $fields2 = array_slice($fields, $splitSize);

        return view('profile.complete.alumni',  compact('avatar', 'schools1', 'schools2', 'fields1', 'fields2', 'degrees', 'highschools'));
    }

    public function studentComplete() {
        $avatar = Auth::user()->avatar;

        //get high schools
        $allhighschools = \App\HighSchool::all();

        $highschools = array();

        foreach($allhighschools as $school) {
            $highschools[$school->name] = $school->name;
        }

        //get degrees
        $degrees = DB::table('degrees')->orderBy('name')->get();

        //get post secondary schools
        $schools = DB::table('schools')->orderBy('name')->get()->toArray();
        $splitSize = ceil(sizeof($schools) / 2);
        $schools1 = array_slice($schools, 0, $splitSize);
        $schools2 = array_slice($schools, $splitSize);

        //get fields of study
        $fields = DB::table('fields')->orderBy('name')->get()->toArray();
        $splitSize = ceil(sizeof($fields) / 2);
        $fields1 = array_slice($fields, 0, $splitSize);
        $fields2 = array_slice($fields, $splitSize);

        return view('profile.complete.student',  compact('avatar', 'schools1', 'schools2', 'fields1', 'fields2', 'degrees', 'highschools'));
    }

    public function save(Request $request) {
        $accType = Input::get('accType');
        $fields = Input::get('fieldOfStudy');
        $schools = Input::get('school');
        $highSchool = Input::get('highSchool');
        $degree = Input::get('degree');
        $subscribe = Input::get('subscribe');

        //check if user selected other high school or school
        $otherHighSchool = Input::get('otherHighSchool');

        if($otherHighSchool != null) {
            $highSchool = ucwords($otherHighSchool);
        }

        //check if they entered any extra stuff
        $otherInputs = Input::get('otherSchools');
        if($otherInputs != null) {
            $otherInputs = explode(',', $otherInputs);
            foreach($otherInputs as $school) {
                $formatted = trim($school);
                $formatted = ucwords($formatted);
                if(count($schools) > 0) {
                    array_push($schools, $formatted);
                } else {
                    $schools = $formatted;
                }
            }
        }

        $otherInputs = Input::get('otherFields');
        if($otherInputs != null) {
            $otherInputs = explode(',', $otherInputs);
            foreach($otherInputs as $school) {
                $formatted = trim($school);
                $formatted = ucwords($formatted);
                if(count($fields) > 0) {
                    array_push($fields, $formatted);
                } else {
                    $fields = $formatted;
                }
            }
        }

        $otherInputs = Input::get('otherDegrees');
        if($otherInputs != null) {
            $otherInputs = explode(',', $otherInputs);
            foreach($otherInputs as $school) {
                $formatted = trim($school);
                $formatted = ucwords($formatted);
                if(count($degree) > 0) {
                    array_push($degree, $formatted);
                } else {
                    $degree = $formatted;
                }
            }
        }

        if(count($fields) > 1) {
            $fields = implode(",", $fields);
        } else if (count($fields) == 0) {
            $fields = '';
        } else {
            $fields = end($fields);
        }

        if(count($schools) > 1) {
            $schools = implode(",", $schools);
        } else if(count($schools) == 0) {
            $schools = '';
        } else {
            $schools = end($schools);
        }

        if(count($degree) > 1) {
            $degree = implode(",", $degree);
        } else if(count($degree) == 0) {
            $degree = '';
        } else {
            $degree = end($degree);
        }

//        dd($degree);

        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'type' => $accType,
                'fields' => $fields,
                'schools' => $schools,
                'degrees' => $degree,
                'highSchool' => $highSchool,
                'emails-weekly' => $subscribe == "true" ? true : false,
                'emails-messages' => $subscribe == "true" ? true : false,
            ]);

        if($accType == "Alumni") {
            $bio = Input::get('bio');
            $inSchool = Input::get('inSchool');

            if($this->wordFilter($bio)) {
                $request->session()->flash('error', 'Your bio cannot contain profanity.');
                return back();
            }

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

    private function wordFilter($text) {
        $words = file(base_path('resources/assets/profanitylist.txt'), FILE_IGNORE_NEW_LINES);

        foreach($words as $word) {
            if (strpos($text, $word) !== false) {
                return true;
            }
        }
        return false;
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

        if($favourites == -1) {

        }

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

        if($request->input('return') == 'true') {
            $favourites = DB::table('users')->where('id', Auth::user()->id)->value('favourites');
            $userids = DB::table('users')->where('id', Auth::user()->id)->value('favourites_user_ids');
            $userids = explode(',', $userids);

            $users = array();
            foreach($userids as $userid) {
                $user = DB::table('users')->where('id', $userid)->first();
                array_push($users, $user);
            }

            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            // Create a new Laravel collection from the array data
            $itemCollection = collect($users);
            // Define how many items we want to be visible in each page
            $perPage = 10;
            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            // Create our paginator and pass it to the view
            $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

            // set url path for generted links
            $paginatedItems->setPath($request->url());
            return view('profile.favourites', ['users' => $paginatedItems, 'favourites' => $favourites]);
        }
    }

    public function favourites(Request $request) {
        $favourites = DB::table('users')->where('id', Auth::user()->id)->value('favourites');
        $userids = DB::table('users')->where('id', Auth::user()->id)->value('favourites_user_ids');
        $userids = explode(',', $userids);

        $users = array();
        foreach($userids as $userid) {
            $user = DB::table('users')->where('id', $userid)->first();
            array_push($users, $user);
        }

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($users);
        // Define how many items we want to be visible in each page
        $perPage = 10;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());
        return view('profile.favourites', ['users' => $paginatedItems, 'favourites' => $favourites]);
    }

    public function avatar(Request $request) {
        // Handle the user upload of avatar
        if($request->input('action') == 'upload') {
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                $prevAvatar = DB::table('users')->where('id', Auth::user()->id)->value('avatar');

                Image::make($avatar)->fit(200)->save(public_path('/avatars/' . $filename));

                if($prevAvatar != 'default-student.png' && $prevAvatar != 'default-alumni.png' && $prevAvatar != "") {
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
            } else {
                $filename = "";
            }

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        if($request->input('fromUrl') == 'edit') {
            return $this->edit();
        } else if($request->input('fromUrl') == 'alumni') {
            return $this->alumniComplete();
        } else if($request->input('fromUrl') == 'student'){
            return $this->studentComplete();
        } else {
            return view('errors.500');
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;

class ProfileController extends Controller
{
    public function index() {
        $user = Auth::user();

        $type = $user->type;

        $fields = $user->fields;
        $fields = explode(",", $fields);
        $schools = $user->schools;
        $schools = explode(",", $schools);
        $email = $user->email;
        $name = $user->name;
        $highSchool = $user->highSchool;

        $usersProfile = true;

        if($type == "Alumni") {
            $degrees = $user->degrees;
            $degrees = explode(",", $degrees);

            $allowMessage = $user->allowMessage;
            $inSchool = $user->inSchool;

            $bio = $user->bio;

            $id = $user->id;

            $url = 'profile/edit';

            return view('profile.alumni', compact('url', 'usersProfile', 'highSchool', 'id', 'name', 'bio', 'email', 'fields', 'schools', 'degrees', 'allowMessage', 'inSchool'));
        }

        return view('profile.student', compact('highSchool', 'name', 'fields', 'schools'));
    }

    public function view($id) {
        $user = DB::table('users')->where('id', $id)->first();

        $usersProfile = false;

        $type = $user->type;

        $fields = $user->fields;
        $fields = explode(",", $fields);
        $schools = $user->schools;
        $schools = explode(",", $schools);
        $email = $user->email;
        $name = $user->name;
        $highSchool = $user->highSchool;

        if($type == "Alumni") {
            $degrees = $user->degrees;
            $degrees = explode(",", $degrees);

            $allowMessage = $user->allowMessage;
            $inSchool = $user->inSchool;

            $bio = $user->bio;

            $id = $user->id;

            $url = 'profile/edit';

            return view('profile.alumni', compact('url', 'usersProfile', 'highSchool', 'id', 'name', 'bio', 'email', 'fields', 'schools', 'degrees', 'allowMessage', 'inSchool'));
        }

        return view('profile.student', compact('highSchool', 'name', 'fields', 'schools'));
    }

    public function edit() {
        $heading = "Edit your profile";

        $user = Auth::user();

        $url = 'profile/edit';

        $type = $user->type;

        $selHighSchool = $user->highSchool;
        $selSchools = explode(',', $user->schools);
        $selFields = explode(',', $user->fields);

        if($type == 'Alumni') {
            $alumni = 'checked';
            $student = '';
        } else if ($type == 'Student') {
            $alumni = '';
            $student = 'checked';
        }

        if($type == 'Alumni') {
            $bio = $user->bio;
            $selDegrees = explode(',', $user->degrees);
            $inSchool = $user->inSchool;
            $allowMessage = $user->allowMessage;

            if($allowMessage) {
                $allowMessage = "checked";
                $notAllowMessage = "";
            } else {
                $allowMessage = "";
                $notAllowMessage = "checked";
            }

            if($inSchool) {
                $inSchool = "checked";
                $notInSchool = "";
            } else {
                $inSchool = "";
                $notInSchool = "checked";
            }
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


        return view('profile.edit',  compact('url', 'student', 'alumni', 'selDegrees', 'selFields', 'selSchools', 'selHighSchool', 'bio', 'allowMessage', 'notAllowMessage', 'inSchool', 'notInSchool', 'heading', 'highschools', 'schools1', 'schools2', 'fields1', 'fields2', 'degrees'));
    }

    public function complete() {
        if(Auth::user()->type != null) {
            return redirect('home');
        }

        $heading = "We just need a little more information about yourself";

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

        $url = 'profile/edit';

        return view('profile.complete',  compact('schools1', 'url', 'heading', 'schools2', 'fields1', 'fields2', 'degrees', 'highschools'));
    }

    public function save() {
        $accType = Input::get('accType');
        $fields = Input::get('fieldOfStudy');
        $schools = Input::get('school');
        $highSchool = Input::get('highSchool');

        if(count($fields) > 0) {
            $fields = implode(",", $fields);
        } else {
            $fields = '';
        }
        if(count($schools) > 0) {
            $schools = implode(",", $schools);
        } else {
            $schools = '';
        }

        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'type' => $accType,
                'fields' => $fields,
                'schools' => $schools,
                'highSchool' => $highSchool
            ]);

        if($accType == "Alumni") {
            $degree = Input::get('degree');
            $allowMessage = Input::get('allowMessage');
            $inSchool = Input::get('inSchool');
            $bio = Input::get('bio');

            if(count($degree) > 0) {
                $degree = implode(",", $degree);
            }

            DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
                [
                    'bio' => $bio,
                    'degrees' => $degree,
                    'inSchool' => $inSchool == "true" ? true : false,
                    'allowMessage' => $allowMessage == "true" ? true : false
                ]);
        }

        return redirect()->action('ProfileController@view', Auth::user()->id);
    }
}
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
        $points = $user->points;
        $rank = $user->rank;

        $fields = $user->fields;
        $fields = explode(",", $fields);
        $schools = $user->schools;
        $schools = explode(",", $schools);
        $email = $user->email;
        $name = $user->name;
        $highSchool = $user->highSchool;

        $usersProfile = true;

        $id = $user->id;
        $url = 'profile/edit';

        $degrees = $user->degrees;
        $degrees = explode(",", $degrees);

        if($type == "Alumni") {
            $inSchool = $user->inSchool;

            $bio = $user->bio;

            return view('profile.alumni', compact('url', 'rank', 'points', 'usersProfile', 'highSchool', 'id', 'name', 'bio', 'email', 'fields', 'schools', 'degrees', 'inSchool'));
        }

        return view('profile.student', compact('highSchool', 'email', 'rank', 'degrees', 'url', 'id', 'points', 'usersProfile', 'name', 'fields', 'schools'));
    }

    public function view($id) {
        $user = DB::table('users')->where('id', $id)->first();

        $usersProfile = false;

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
        $id = $user->id;

        $degrees = $user->degrees;
        $degrees = explode(",", $degrees);

        $url = 'profile/edit';

        if($type == "Alumni") {
            $inSchool = $user->inSchool;

            $bio = $user->bio;

            return view('profile.alumni', compact('url', 'points', 'rank', 'usersProfile', 'highSchool', 'id', 'name', 'bio', 'email', 'fields', 'schools', 'degrees', 'inSchool'));
        }

        return view('profile.student', compact('highSchool', 'email', 'degrees', 'rank', 'url', 'id', 'points', 'usersProfile', 'name', 'fields', 'schools'));
    }

    public function edit() {
        $user = Auth::user();

        $url = 'profile/edit';

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
            $bio = $user->bio;
            $inSchool = $user->inSchool;

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

        $otherType = $type == 'Alumni' ? 'Student' : 'Alumni';
        $type = $type == 'Alumni' ? 'an Alumni' : 'a Student';


        return view('profile.edit',  compact('url', 'accType', 'otherType', 'type', 'student', 'alumni', 'selDegrees', 'selFields', 'selSchools', 'selHighSchool', 'bio', 'inSchool', 'notInSchool', 'highschools', 'schools1', 'schools2', 'fields1', 'fields2', 'degrees'));
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

        $replaceFlag = false;
        if(in_array('other', $schools)) {
            $replaceFlag = true;
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
                'highSchool' => $highSchool
            ]);

        if($accType == "Alumni") {
            $inSchool = Input::get('inSchool');
            $bio = Input::get('bio');


            DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
                [
                    'bio' => $bio,
                    'inSchool' => $inSchool == "true" ? true : false,
                ]);
        }

        return redirect()->action('ProfileController@index');
    }
}
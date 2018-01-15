<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Nahid\Talk\Facades\Talk;
use View;
use App\User;

class ExperiencesController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::guest()) {
                return;
            }

            if(Auth::check()) {
                Talk::setAuthUserId(Auth::user()->id);
            }
            return $next($request);
        });

        View::composer('partials.peoplelist', function ($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
    }

    public function index() {
        $posts = DB::table('experiences')->paginate(10);

        if(Auth::guest()) {
            $type = null;
        } else {
            $type = Auth::user()->type;
        }

        return view('experiences.index', compact('posts', 'type'));
    }

    public function post() {
        session_start();
        $user = Auth::user();

        $title = Input::get('title');
        $body = Input::get('body');
        $body = nl2br(e($body));

        $fields     = Input::get('fieldOfStudy');
        $schools    = Input::get('school');
        $degrees     = Input::get('degree');

        if($schools == null) {
            $schools = array();
        }

        $otherInputs = Input::get('otherSchools');
        if($otherInputs != null) {
            $otherInputs = explode(',', $otherInputs);
            foreach($otherInputs as $school) {
                $formatted = trim($school);
                $formatted = ucwords($formatted);
                array_push($schools, $formatted);
            }
        }

        if($fields == null) {
            $fields = array();
        }

        $otherInputs = Input::get('otherFields');
        if($otherInputs != null) {
            $otherInputs = explode(',', $otherInputs);
            foreach($otherInputs as $field) {
                $formatted = trim($field);
                $formatted = ucwords($formatted);
                array_push($fields, $formatted);
            }
        }

        if($degrees == null) {
            $degrees = array();
        }

        $otherInputs = Input::get('otherDegrees');
        if($otherInputs != null) {
            $otherInputs = explode(',', $otherInputs);
            foreach($otherInputs as $degree) {
                $formatted = trim($degree);
                $formatted = ucwords($formatted);
                array_push($degrees, $formatted);
            }
        }


        if(count($fields) >= 1) {
            $fields = implode(",", $fields);
        } else if (count($fields) == 0) {
            $fields = '';
        }

        if(count($schools) >= 1) {
            $schools = implode(",", $schools);
        } else if(count($schools) == 0) {
            $schools = '';
        }

        if(count($degrees) >= 1) {
            $degrees = implode(",", $degrees);
        } else if(count($degrees) == 0) {
            $degrees = '';
        }

        DB::table('experiences')->insert(
            [
                'title' => $title,
                'body' => $body,
                'user_id' => $user->id,
                'schools' => $schools,
                'fields' => $fields,
                'degrees' => $degrees,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

        return $this->index();
    }

    public function newPost() {
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

        return view('experiences.post', compact('schools1', 'schools2', 'fields1', 'fields2', 'degrees'));
    }

    public function edit($id) {
        $experience = DB::table('experiences')->where('id', $id)->first();
        $title = $experience->title;
        $body = str_replace("<br />", "", $experience->body);

        $selSchools = explode(',', $experience->schools);
        $selFields = explode(',', $experience->fields);
        $selDegrees = explode(',', $experience->degrees);

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

        return view('experiences.edit', compact('title', 'body', 'id', 'degrees', 'schools1', 'schools2', 'fields1', 'selDegrees', 'selFields', 'selSchools', 'fields2'));
    }

    public function save($id) {
        $user = Auth::user();

        $title = Input::get('title');
        $body = Input::get('body');
        $body = nl2br(e($body));

        $fields     = Input::get('fieldOfStudy');
        $schools    = Input::get('school');
        $degrees     = Input::get('degree');

        if($schools == null) {
            $schools = array();
        }

        $otherInputs = Input::get('otherSchools');
        if($otherInputs != null) {
            $otherInputs = explode(',', $otherInputs);
            foreach($otherInputs as $school) {
                $formatted = trim($school);
                $formatted = ucwords($formatted);
                array_push($schools, $formatted);
            }
        }

        if($fields == null) {
            $fields = array();
        }

        $otherInputs = Input::get('otherFields');
        if($otherInputs != null) {
            $otherInputs = explode(',', $otherInputs);
            foreach($otherInputs as $field) {
                $formatted = trim($field);
                $formatted = ucwords($formatted);
                array_push($fields, $formatted);
            }
        }

        if($degrees == null) {
            $degrees = array();
        }

        $otherInputs = Input::get('otherDegrees');
        if($otherInputs != null) {
            $otherInputs = explode(',', $otherInputs);
            foreach($otherInputs as $degree) {
                $formatted = trim($degree);
                $formatted = ucwords($formatted);
                array_push($degrees, $formatted);
            }
        }


        if(count($fields) >= 1) {
            $fields = implode(",", $fields);
        } else if (count($fields) == 0) {
            $fields = '';
        }

        if(count($schools) >= 1) {
            $schools = implode(",", $schools);
        } else if(count($schools) == 0) {
            $schools = '';
        }

        if(count($degrees) >= 1) {
            $degrees = implode(",", $degrees);
        } else if(count($degrees) == 0) {
            $degrees = '';
        }

        DB::table('experiences')->where('id', $id)->limit(1)->update(
            [
                'title' => $title,
                'body' => $body,
                'user_id' => $user->id,
                'schools' => $schools,
                'fields' => $fields,
                'degrees' => $degrees,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

        return $this->index();
    }

    public function view($id) {
        $experience = DB::table('experiences')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $experience->user_id)->first();

        return view('experiences.view', compact('experience', 'user', 'id'));
    }

    public function delete($id) {
        DB::table('experiences')->where('id', $id)->limit(1)->delete();

        return redirect('experiences');
    }
}
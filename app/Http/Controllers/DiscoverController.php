<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use Nahid\Talk\Facades\Talk;
use View;

class DiscoverController extends Controller
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
        $highschools = DB::table('highschools')->pluck('name');
        $schools     = DB::table('schools')->pluck('name');
        $fields      = DB::table('fields')->pluck('name');
        $degrees     = DB::table('degrees')->pluck('name');

        return view('discover.index', compact('highschools', 'schools', 'fields', 'degrees'));
    }

    public function search() {
        if(Input::get('search') == 'name') {
            $query = User::query();

            $query = $query->where('name', 'like', '%'. Input::get('name') .'%');

            //Do not show current user in results
            $query = $query->where('id', '!=', Auth::id());

            $query = $query->where('searchable', 1);

            $totalResults = count($query->get());

            $results = $query->paginate(10);

            return view('discover.results', ['results' => $results, 'totalResults' => $totalResults]);
        }



        $highSchool = Input::get('highSchool');
        $school     = Input::get('school');
        $field      = Input::get('field');
        $degree     = Input::get('degree');
        $type       = Input::get('type');

        DB::table('search_queries')->insert(
            [
                'user_id' => Auth::id(),
                'user_type' => $type,
                'high_school' => $highSchool,
                'school' => $school,
                'field' => $field,
                'degree' => $degree,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]);

        $query = User::query();

        $query = $query->where('active', 1);
        $query = $query->where('searchable', 1);

        if ($type != 'All') {
            $query = $query->where('type', $type);
        } else {
            $query = $query->where('type', '<>', null);
        }

        if ($highSchool != 'All') {
            $query = $query->where('highSchool', $highSchool);
        }

        if ($school != 'All') {
            $query = $query->where('schools', 'like', '%'.$school.'%');
        }

        if ($field != 'All') {
            $query = $query->where('fields', 'like', '%'.$field.'%');
        }

        if ($degree != 'All') {
            $query = $query->where('degrees', 'like', '%'.$degree.'%');
        }

        //Do not show current user in results
        $query = $query->where('id', '!=', Auth::id());

        $totalResults = count($query->get());

        $results = $query->paginate(10);

        return view('discover.results', ['results' => $results, 'totalResults' => $totalResults]);
    }

}
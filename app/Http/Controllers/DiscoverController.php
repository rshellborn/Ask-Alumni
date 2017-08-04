<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;

class DiscoverController extends Controller
{
    public function index() {
        $highschools = DB::table('highschools')->pluck('name');
        $schools     = DB::table('schools')->pluck('name');
        $fields      = DB::table('fields')->pluck('name');
        $degrees     = DB::table('degrees')->pluck('name');

        return view('discover.index', compact('highschools', 'schools', 'fields', 'degrees'));
    }

    public function search() {
        $highSchool = Input::get('highSchool');
        $school     = Input::get('school');
        $field      = Input::get('field');
        $degree     = Input::get('degree');

        $query = User::query();

        if ($highSchool != 'All') {
            $query->where([
                ['highSchool', $highSchool],
                ['type', 'Alumni']
            ]);
        } else {
            $query->where('type', 'Alumni');
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

        $results = $query->paginate(10);

        return view('discover.results', ['results' => $results]);
    }

}
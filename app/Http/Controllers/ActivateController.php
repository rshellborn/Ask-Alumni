<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;

class ActivateController extends Controller
{
    public function index($code) {
        $active = DB::table('users')->where('verification_code', $code)->limit(1)->value('active');

        if($active == 1) {
            return view('auth.login');
        } else {
            DB::table('users')->where('verification_code', $code)->limit(1)->update(
                [
                    'active' => 1,
                    'points' => 10
                ]);


            session_start();
            $_SESSION['registered'] = 'true';

            return view('activate');
        }
    }
}

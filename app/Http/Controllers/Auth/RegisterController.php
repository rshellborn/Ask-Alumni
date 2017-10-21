<?php

namespace App\Http\Controllers\Auth;

use App\Jobs\SendAdminNotificationEmail;
use App\Jobs\SendVerificationEmail;
use App\Mail\VerifyAccount;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }

        $authUser = User::where('email', $user->email)->first();
        if($authUser) {
            return $authUser;
        }

        $filename = time() . '.jpg';
        Image::make($user->avatar_original)->fit(200)->save(public_path('/avatars/' . $filename));

        session_start();
        $_SESSION['registered'] = 'true';

        $user = User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'avatar' => $filename,
            'points' => 10,
        ]);


        //send email to notify me of new user
        dispatch(new SendAdminNotificationEmail("NEW USER ---", $user->name . " " . $provider));

        return $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if(Input::get('referral_code') != null) {
            $referred_by = DB::table('users')->where('referral_code', Input::get('referral_code'))->value('id');
        } else {
            $referred_by = 0;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verification_code' => base64_encode($data['email']),
            'referred_by' => $referred_by
        ]);

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

        dispatch(new SendVerificationEmail($user));

        //send email to notify me of new user
        dispatch(new SendAdminNotificationEmail("NEW USER ---", $user->name . " " . $user->provider));

        return $this->registered($request) ?: redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request)
    {
        Auth::logout();
        $request->session()->flash('registered', 'Please check your email to activate your account.');
        return redirect('login');
    }

}

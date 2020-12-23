<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function socialRedirect($social)
    {

        $user = Socialite::driver($social)->user();

        $name = $user->name ?? $name = $user->nickname;
       
        $user = User::firstOrCreate([
            'email' => $user->email
        ], [
            'name' => $name,
            'password' => bcrypt(Str::random(5)),
            'role_id' => config('constant.role_id'),
        ]);

        Auth::login($user, true);

        return redirect('/home');
    }

}

<?php

namespace App\Http\Controllers\Auth;

use Adldap\Laravel\Facades\Adldap;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

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

    protected function attemptLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        $email = $credentials['email'];
        $password = $credentials['password'];

        if (!get_title('is_ad_login')) {

            $user = User::where('email', $email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                if (Auth::loginUsingId($user->id)) {
                    return redirect('/dashboard')->with('success', 'You have Successfully loggedin');
                }
            }
        } else {
            if (Adldap::auth()->attempt($email, $password, $bindAsUser = true)) {
                $user = User::where('email', $email)->first();

                if (!$user) {

                    Artisan::call('adldap:import', [
                        '--no-interaction',
                        '--filter' => "(userprincipalname=" . $email . ")",
                    ]);
                    $user = User::where('email', $email)->first();
                    $user->assignRole(2);
                }

                $this->guard()->login($user, true);
                return true;
            } else {
                $user = User::where('email', $email)->first();
                if ($user && Hash::check($request->password, $user->password)) {
                    if (Auth::loginUsingId($user->id)) {
                        return redirect('/dashboard')->with('success', 'You have Successfully loggedin');
                    }
                }
            }
        }

        return false;;
    }
}

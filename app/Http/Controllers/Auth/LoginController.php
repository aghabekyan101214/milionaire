<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->middleware('guest')->except(['logout', 'adminLogout', 'playerLogout']);
        $this->middleware('guest:admin')->except(['logout', 'adminLogout', 'playerLogout']);
        $this->middleware('guest:player')->except(['logout', 'adminLogout', 'playerLogout']);
    }

//    admin login part
    public function showAdminLoginForm()
    {
        return view('auth.admin_login');
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/admin');
        }
        return back()->withInput($request->only('email'));
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

//    player login part
    public function showPlayerLoginForm()
    {
        return view('auth.player_login');
    }

    public function playerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('player')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/player');
        }
        return back()->withInput($request->only('email'));
    }

    public function playerLogout(Request $request)
    {
        Auth::guard('player')->logout();
        return redirect('/player/login');
    }
}

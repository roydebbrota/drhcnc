<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectTo(): string
    {
        if((auth()->user()->role == 'SuperAdmin')){
            $this->redirectTo = RouteServiceProvider::DASHBOARD;
                return $this->redirectTo;
        }elseif((auth()->user()->role == 'Student')){
            $this->redirectTo = RouteServiceProvider::STUDENTDASHBOARD;
                return $this->redirectTo;
        }elseif((auth()->user()->role == 'Account')){
            $this->redirectTo = RouteServiceProvider::ACCOUNTDASHBOARD;
                return $this->redirectTo;
        }else{
            $this->redirectTo = RouteServiceProvider::LOGIN;
                return $this->redirectTo;
        }
    }
    public function username()
    {
        return 'phone';
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
}

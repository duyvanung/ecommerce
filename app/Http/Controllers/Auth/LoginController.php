<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Barryvdh\Debugbar\Facade as Debugbar;
use App\Category;

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
    //protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function showLoginForm()
    {
        $categories = new Category();
        return view('auth.login')->with('categories', $categories->getAllWithUrl());
    }

    protected function authenticated()
    {
        if (auth()->user()->admin == 1){
            return redirect('/admin');
        }
        else{
            if (Session::has('link')){
                return redirect(Session::get('link'));
            }
            return redirect()->back();
        }
    }
}

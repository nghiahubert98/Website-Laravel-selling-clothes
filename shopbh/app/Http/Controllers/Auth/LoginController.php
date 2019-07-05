<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\User;
use Auth;
use Alert;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function getLogin(){
        return view('auth.login');
    }
    public function postLogin(LoginRequest $request){
        if (Auth::attempt(['username' => $request->txtUsername,'password' => $request->txtPass], $request->remember)) {
          Alert::success('Login Success!');
          if (Auth::check())
            if( Auth::user()->level == 1)
              return redirect('PageAdmin');
            else return redirect('index');
        }else{
          Alert::error('Your Username or Password incorrect', 'Login Fail!');
          return redirect()->back()->withInput();;
        }
    }
    public function postLogincheckout(LoginRequest $request){
        if (Auth::attempt(['username' => $request->txtUsername,'password' => $request->txtPass], $request->remember)) {
          Alert::success('Login Success!');
          return redirect('check-out');
        }else{
          Alert::error('Your Username or Password incorrect', 'Login Fail!');
          return redirect()->back()->withInput();;
        }
    }
    public function logout(Request $request) {
      $request->session()->flush();
      Auth::logout();
      Alert::success('See You Again Soon!');
      return redirect('/index');
    }
}

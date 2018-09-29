<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',['only'=>'showLoginForm']);
    }

    public function login()
    {
        $remember = request()->input('remember');
        $credentialas = $this->validate(request(),[
            $this->username()=>'required',
            'password'=>'string|required'
        ]);

        if(Auth::attempt($credentialas, $remember))
        {
            return redirect()->route('dashboard');
        }

        return back()
            ->withErrors([$this->username()=>trans('Auth.failed')])
            ->withInput(request([$this->username()]));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function username()
    {
        return 'name';
    }
}

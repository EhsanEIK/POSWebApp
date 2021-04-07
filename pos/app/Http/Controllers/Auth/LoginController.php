<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Login()
    {
    	$this->data['headline']	 = 'LogIn';
    	$this->data['button']	 = 'Log In';

    	return view('login.form',$this->data);
    }

    public function Authenticate(LoginRequest $request)
    {
    	$data= $request->only(['email','password']);

    	if (Auth::attempt($data))
        {
	        return redirect()->intended('dashboard');
	    }
	    return redirect()->to('login')->withErrors('Invalid password!');
    }

    public function Logout()
    {
    	Auth::Logout();
    	return redirect()->to('login');
    }
}

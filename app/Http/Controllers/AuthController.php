<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Auth;

class AuthController extends Controller
{
    /**
     * Process RegisterRequest sent by register page form, save new user to db and redirect to login page.
     */
    public function postRegister(RegisterRequest $request){
    	$newUser = new User;
    	
    	$newUser->username = $request->get('username');
    	$newUser->name = $request->get('full_name');
    	$newUser->email = $request->get('email');
    	$newUser->password = Hash::make($request->get('password'));
    	$newUser->type = 1;
    	$newUser->status = 1;

    	$newUser->save();

    	return redirect('admin/login')->with('status','New user created successfully!');
    }

    /**
     * Process LoginRequest sent by login page form and redirect to dashboard if user is authenticated or back with errors if else.
     */
    public function postLogin(LoginRequest $request){
    	$remember = false;
    	if($request->has('remember') ){
    		$remember = true;
    	}
    	if (Auth::attempt(['username' => $request->get('username'), 'password' => $request->get('password')], $remember)) {
		    return redirect('admin/dashboard');
		}else{
			return redirect('admin/login')->withErrors('Login failed. Bad credentials.');
		}
    }

    /**
     * Do logout user and redirect to home page.
     */
    public function doLogout(){
        Auth::logout();
        return redirect ('/');
    }
}

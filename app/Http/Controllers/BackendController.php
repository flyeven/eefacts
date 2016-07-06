<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Draw;
use App\User;


class BackendController extends Controller
{
    /**
     * Show login page
     */
    public function getLoginPage(){
    	return view('back.login');
    }

     /**
     * Show register page
     */
    public function getRegisterPage(){
    	return view('back.register');
    }

     /**
     * Show dashboard page
     */
    public function getDashboardPage(){
    	$countDraws = Draw::where('status', 1)->count();
    	$countUsers = User::where('status', 1)->count();
    	return view('back.dashboard')
    			->with('countDraws', $countDraws)
    			->with('countUsers', $countUsers);
    }
}

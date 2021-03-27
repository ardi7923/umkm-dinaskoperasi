<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
    	if(Auth::user()->role == 'CUSTOMER'){
    		return redirect('/');	
    	}else{
    		return view('pages.admin.dashboard.index');
    	}
    	
    }
}

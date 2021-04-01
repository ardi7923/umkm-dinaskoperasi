<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Umkm;
use App\Models\Product;
use App\Models\Bank;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
    	if(Auth::user()->role == 'CUSTOMER'){
    		return redirect('/');	
    	}else{
			$umkms    = Umkm::count();
			$products = Product::count();
			$banks    = Bank::count();
			$orders   = Order::count();
    		return view('pages.admin.dashboard.index',compact('umkms','products','banks','orders'));
    	}
    	
    }
}

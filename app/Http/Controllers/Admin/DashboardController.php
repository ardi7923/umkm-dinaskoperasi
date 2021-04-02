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
            $statistik = $this->statistik();
    		return view('pages.admin.dashboard.index',compact('umkms','products','banks','orders','statistik'));
    	}
    	
    }

    private function statistik()
    {

        return [
                'jan' => $this->queryStatistik(1),
                'feb' => $this->queryStatistik(2),
                'mar' => $this->queryStatistik(3),
                'apr' => $this->queryStatistik(4),
                'mei' => $this->queryStatistik(5),
                'jun' => $this->queryStatistik(6),
                'jul' => $this->queryStatistik(7),
                'ags' => $this->queryStatistik(8),
                'sep' => $this->queryStatistik(9),
                'oct' => $this->queryStatistik(10),
                'nov' => $this->queryStatistik(11),
                'des' => $this->queryStatistik(12),
               ];
    }


    private function queryStatistik($month)
    {
        return Order::whereMonth('date',$month)->count();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Umkm;
use App\Models\OrderList;

class StatistikUmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::whereHas('orderList.order', function ($q) {
            return $q->where('sts', 2);
        })->get();

        foreach ($umkms as $u)
        {
            $u->ammount = OrderList::whereHas('order',function($q){
                return $q->where('sts',2);
            })->whereHas('product',function($q) use ($u){
                $q->where('umkm_id',$u->id);
            })->sum('ammount');
        }

        $datas = collect($umkms)->sortByDesc('ammount');
       
        return view('pages.admin.statistik-umkm.index', compact('datas'));
    }
}

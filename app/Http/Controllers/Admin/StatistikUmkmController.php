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
        $umkms = Umkm::whereHas('orderList',function($q){
            return $q->whereHas('order',function($query){
                return $query->where('sts',2);
            });
        })->limit(10)->get()->sortByDesc(function($umkms)
        {
                return $umkms->orderList()->sum('ammount');
        });
        
        
        return view('pages.admin.statistik-umkm.index',compact('umkms'));
    }
}

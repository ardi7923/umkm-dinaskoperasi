<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderList;

class StatistikProductController extends Controller
{
    public function index()
    {
        $products = Product::with('orders')->limit(10)->get()->sortByDesc(function($products)
		{
			    return $products->orders->where('sts',2)->count();
		});

        foreach($products as $p){
            $p->total_order = OrderList::whereHas('order',function($q){
                return $q->where('sts',2);
            })->where('product_id',$p->id)->sum('ammount');
        }

        return view('pages.admin.statistik-product.index',compact('products'));
    }
}

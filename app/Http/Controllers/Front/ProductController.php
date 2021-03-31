<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    public function index(Request $request)
    {
		$q     =  $request->q;

        if($q){
            $products = Product::where('name','like','%'.$q.'%')->verified()
                             ->orWhereHas('category',function(Builder $query) use ($q){
                                return $query->where('name','like','%'.$q.'%');
                             })->verified()
                             ->get();
        }else{
            $products = Product::verified()->get();
        }
        

    	

    	return view('pages.front.product.index',compact('products','q'));
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
    	$products = Product::verified()->get();

    	return view('pages.front.product.index',compact('products'));
    }
}

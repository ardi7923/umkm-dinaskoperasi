<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
    	
    	$categories = Category::with('product')->get();

    	$best_sellers = Product::with('orderlists')->limit(3)->get()->sortByDesc(function($best_sellers)
		{
			    return $best_sellers->orderlists->count();
		});

		$on_sales = Product::WhereHas('orderlists')->with('orderlists')->limit(3)->get()->sortByDesc(function($on_sales)
		{
			    return $on_sales->orderlists->count();
		});

		$recomendeds = Product::with('orderlists')->get()->random(3);




    	return view('pages.front.home.index',compact('categories','best_sellers','on_sales','recomendeds'));
    }
}

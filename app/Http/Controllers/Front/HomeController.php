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
    	
    	$categories = Category::with('product.orderlists')->get();

    	$best_sellers = Product::with('orderlists')->limit(3)->get()->sortByDesc(function($best_sellers)
		{
				return $best_sellers->orderlists()->sum('ammount');
		});

		$on_sales = Product::WhereHas('orderlists')->with('orderlists')->limit(3)->get()->sortByDesc(function($best_sellers)
		{
				return $best_sellers->orderlists()->sum('ammount');
		});

		$recomendeds = Product::with('orderlists')->get();

		if ($recomendeds->count() > 3) {
			$recomendeds = $recomendeds->random(3);
		}




    	return view('pages.front.home.index',compact('categories','best_sellers','on_sales','recomendeds'));
    }
}

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
    	
    	$categories = Category::whereHas('product',function($q){
			return $q->where('stock','>',0)->verified();
		})->with('product.orderlists')->get();

    	$best_sellers = Product::where('stock','>',0)->verified()->with('orderlists')->limit(3)->get()->sortByDesc(function($best_sellers)
		{
				return $best_sellers->orderlists()->sum('ammount');
		});

		$on_sales = Product::where('stock','>',0)->verified()->WhereHas('orderlists')->with('orderlists')->limit(3)->get()->sortByDesc(function($best_sellers)
		{
				return $best_sellers->orderlists()->sum('ammount');
		});

		$recomendeds = Product::where('stock','>',0)->verified()->with('orderlists')->get();

		if ($recomendeds->count() > 3) {
			$recomendeds = $recomendeds->random(3);
		}




    	return view('pages.front.home.index',compact('categories','best_sellers','on_sales','recomendeds'));
    }
}

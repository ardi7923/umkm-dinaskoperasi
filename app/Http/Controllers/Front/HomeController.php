<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
    	$categories = Category::with('product')->get();
    	return view('pages.front.home.index',compact('categories'));
    }
}

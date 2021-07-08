<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Umkm;

class UmkmController extends Controller
{
    public function index()
    {
    	$umkms = Umkm::verify()->get();
    	return view('pages.front.umkm.index',compact('umkms'));
    }

    public function show($slug)
    {
    	$umkm = Umkm::where('slug',$slug)->with('products')->first();
    	return view('pages.front.umkm.show',compact('umkm'));
    }
}

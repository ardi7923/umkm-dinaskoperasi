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
}

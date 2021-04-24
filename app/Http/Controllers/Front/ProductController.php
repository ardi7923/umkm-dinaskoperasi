<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use MainService;
use App\Models\OrderList;
use App\Models\Keyword;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // mengambil keyword
        $q     =  $request->q;

        // check keyword
        if ($q) {
            // menyimpan keyword di database
                Keyword::create([
                    'keyword'   => strtolower($q)
                ]);

            /**
             * mengambil data produk yang memiliki stok, terverifikasi berdasarkan keyword
             * kondisi : 
             * 1. kabupaten umkm
             * 2. nama kategori
             * 3. nama produk
             */
            $products = Product::where('name', 'like', '%' . $q . '%')
                ->where('stock','>',0)
                ->verified()
                ->orWhereHas('umkm',function(Builder $query) use ($q){
                    return $query->where('district', 'like', '%' . $q . '%');
                })
                ->where('stock','>',0)
                ->verified()
                ->orWhereHas('category', function (Builder $query) use ($q) {
                    return $query->where('name', 'like', '%' . $q . '%');
                })->verified()
                ->where('stock','>',0)
                ->get()->sortByDesc(function($products)
                {
                        return $products->orderlists()->sum('ammount');
                });

            
        } else {
            // apabila tidak memiliki keyword menampilkan semua produk yg stok lebih dari 0 dan di urutkan berdasarkan jumlah terjual
            $products = Product::verified()->where('stock','>',0)->get()->sortByDesc(function($products)
            {
                    return $products->orderlists()->sum('ammount');
            });
        }




        return view('pages.front.product.index', compact('products', 'q'));
    }


    public function show($id)
    {
        $data = Product::find($id);
        return MainService::renderToJson('pages.front.product.show', compact('data'));
    }
}

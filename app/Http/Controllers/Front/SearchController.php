<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keyword;
use App\Models\Product;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function get(Request $request)
    {
        // mengambil keyword
        $q = $request->q;

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
                ->get(['name','image','stock']);
        
        // ambil data jumlah keyword
        foreach($products as $p)
        {
            $p->frequency = Keyword::where('keyword','like','%'.$p->name.'%')->count();
        }

        // mengurutkan berdasarkan jumlah frequency 
        $collection = collect($products)->sortByDesc('frequency')->values();
        
        // return data
        return response()->json($collection, 200);
    }

    public function mostPopuler(Request $request)
    {
        // mengambil keyword dari database
        $keywords = Keyword::select('keyword')->get()->unique('keyword');
            foreach($keywords as $k){
                $k->frequency = Keyword::where('keyword',$k->keyword)->count();
            }
        
        // urutkan berdasarkan jumlah frequency
        $keywordSort = collect($keywords)->sortByDesc('frequency');
        
        // menggabungkan data produk dengan data keyword
        $objProduct = collect($keywordSort)->map(function($items){

                $objProduct['product_name']  = Product::where('name','like','%'.$items->keyword.'%')->value('name');
                $objProduct['product_image']  = Product::where('name','like','%'.$items->keyword.'%')->value('image');
                $objProduct['frequency'] = $items->frequency;
                $objProduct['keyword']      = $items->keyword;
                return $objProduct; 
        })->all();

        // mengurut kan data berdasarkan jumlah frequency
        $products = collect($objProduct)->sortByDesc('frequency')->where('product_name','!=',null)->values();

        return response()->json($products, 200, );
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keyword;
use App\Models\Product;
use Facade\FlareClient\Http\Response;

class SearchController extends Controller
{
    public function get(Request $request)
    {
        $q = $request->q;

        $products = Product::where('name', 'like', '%' . $q . '%')
                ->where('stock','>',0)
                ->verified()
                ->get(['name','image','stock']);
                
        foreach($products as $p)
        {
            $p->frequency = Keyword::where('keyword','like','%'.$p->name.'%')->count();
        }        
                
        $collection = collect($products)->sortByDesc('frequency')->values();
        return response()->json($collection, 200);
    }

    public function mostPopuler(Request $request)
    {
        $keywords = Keyword::select('keyword')->get()->unique('keyword');
            foreach($keywords as $k){
                $k->frequency = Keyword::where('keyword',$k->keyword)->count();
            }

        $keywordSort = collect($keywords)->sortByDesc('frequency');
        
        $attachmentDetails = collect($keywordSort)->map(function($items){
            $check = Product::where('name','like','%'.$items->keyword.'%')->value('name');
            

                $attachmentDetails['product_name']  = Product::where('name','like','%'.$items->keyword.'%')->value('name');
                $attachmentDetails['product_image']  = Product::where('name','like','%'.$items->keyword.'%')->value('image');
                $attachmentDetails['frequency'] = $items->frequency;
                $attachmentDetails['keyword']      = $items->keyword;
                return $attachmentDetails;
                

            

            
        })->all();
        $products = collect($attachmentDetails)->sortByDesc('frequency')->where('product_name','!=',null)->values();
        return response()->json($products, 200, );
    }
}

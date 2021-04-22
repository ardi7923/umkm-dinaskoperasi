<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keyword;
use DataTables;
use Carbon\Carbon;

class SeoController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax()){
            return $this->datatable();
        }
        return view('pages.seo.table');
    }

    public function statistik(Request $request)
    {
        $month = $request->month;
        if($request->month){
            $keywords = Keyword::whereMonth('created_at',$request->month)->get()->unique('keyword');
            foreach($keywords as $k){
                $k->frequency = Keyword::where('keyword',$k->keyword)->whereMonth('created_at',$request->month)->count();
            }
            $collection = collect($keywords)->sortByDesc('frequency')->take(10);
        }else{
            $keywords = Keyword::get()->unique('keyword');
            foreach($keywords as $k){
                $k->frequency = Keyword::where('keyword',$k->keyword)->count();
            }
            $collection = collect($keywords)->sortByDesc('frequency')->take(10);
        }

        

        return view('pages.seo.statistik',compact('collection','month'));
    }

    private function datatable()
    {
        $data = Keyword::get()->unique('keyword');
        return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('frequency', function ($data)  {
                            return Keyword::where('keyword',$data->keyword)->count();
                        })
                        ->make(true);
    }
}

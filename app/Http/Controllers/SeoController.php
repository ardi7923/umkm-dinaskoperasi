<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keyword;
use DataTables;

class SeoController extends Controller
{
    public function index(Request $request)
    {

        if($request->ajax()){
            return $this->datatable();
        }
        return view('pages.seo.table');
    }

    public function statistik()
    {
        $keywords = Keyword::limit(10)->get()->unique('keyword');
        foreach($keywords as $k){
            $k->frequency = Keyword::where('keyword',$k->keyword)->count();
        }
        return view('pages.seo.statistik',compact('keywords'));
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

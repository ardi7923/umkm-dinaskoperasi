<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DataTables;
use App\Models\Umkm;

class UmkmProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.umkm-product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        if($request->ajax()){
            return $this->datatable($id);
        }
        $umkm = Umkm::find($id);
        return view('pages.admin.umkm-product.show',compact('id','umkm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * data json for datatable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function datatable($id)
    {
        $data = Product::query()->verified()->where('umkm_id',$id)->with('umkm','category');
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('show_price',function($data){
                        	return number_format($data->price);
                        })
                        ->addColumn('show_discount',function($data){
                        	return number_format($data->discount);
                        })
                        ->addColumn('action', function ($data)  {
                            return '<button 
                                            class     = "btn btn-circle btn-sm btn-info show_from"
                                            data-size="lg"
                                            data-url  = '. url("admin/data-product/$data->id") .'
                                            data-toggle="tooltip" title="Lihat Data"
                                            > 
                                            <i class  = "fa fa-eye"> </i> 
                                       </button>
                                    
                                    <button 
                                       class     = "btn btn-circle btn-sm btn-warning show_from"
                                       data-size="lg"
                                       data-url  = '. url("admin/stock/$data->id/edit") .'
                                       data-toggle="tooltip" title="Ubah Stock"
                                       > 
                                       <i class  = "fa fa-archive"> </i> 
                                   </button>

                                   <button 
                                       class     = "btn btn-circle btn-sm btn-success show_from"
                                       data-size="lg"
                                       data-url  = '. url("admin/discount/$data->id/edit") .'
                                       data-toggle="tooltip" title="Ubah Stock"
                                       > 
                                       <i class  = "fa fa-dollar-sign"> </i> 
                                   </button>

                                       <button 
                                                type           ="button"  
                                                class          ="btn btn-circle btn-sm btn-danger btn-sm mr-1 btn_delete" 
                                                data-toggle    ="tooltip" 
                                                data-placement ="top" 
                                                data-type      = "reload"
                                                title          =  "Hapus Data"
                                                data-url       = '. url("admin/data-product/$data->id") .'
                                                data-text      = "'. self::delete($data)  .'">
                                                <i class="fa fa-trash"></i>
                                        </button>';
                            })
                        ->make(true);

    }


    private static function delete($data)
    {
        return view("pages.admin.data-product.delete",compact('data'))->render();
    }
}

<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use CrudService;
use DataTables;
use MainService;

class ProductController extends Controller
{
    private $model,
        $crud_service,
        $folder,
        $validator,
        $facade,
        $url = 'umkm/product/';

    public function __construct(Product $model,CrudService $crud_service)
    {
        $this->model        = $model;
        $this->crud_service = $crud_service;
        $this->folder       = 'pages.umkm.product.';
        // $this->validator    = $validator;
        // $this->facade       = $facade;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return $this->datatable();
        }
        return view('pages.umkm.product.index');
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
    public function show($id)
    {
        $data = $this->model->with('category','umkm')->find($id);

        return MainService::renderToJson($this->folder.'show',compact('data'));
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
    public function datatable()
    {
        $data = $this->model->query()->verified()->with('category');
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('show_image', function ($data) {
                            return '<center><img src="../'.$data->image.'" class="rounded-circle" width="120px"></center>';
                        })
                        ->addColumn('show_umkm_price',function($data){
                            return number_format($data->umkm_price);
                        })
                        ->addColumn('action', function ($data)  {
                            return '<button 
                                            class     = "btn btn-circle btn-sm btn-info show_form"
                                            data-size="lg"
                                            data-url  = '. url("umkm/product/$data->id") .'
                                            data-toggle="tooltip" title="Lihat Data"
                                            > 
                                            <i class  = "fa fa-eye"> </i> 
                                       </button>';
                            })
                        ->rawColumns(['show_image','action','show_umkm_price'])
                        ->make(true);
    }
}

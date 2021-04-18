<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CrudService;
use MainService;
use DataTables;
use File;
use ResponseService;
use App\Models\Product;

class StockController extends Controller
{
    private $model,
        $crud_service,
        $folder,
        $facade,
        $url = 'admin/data-product/';

    public function __construct(Product $model, CrudService $crud_service)
    {
        $this->model        = $model;
        $this->crud_service = $crud_service;
        $this->folder       = 'pages.admin.stock.';
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
        return view($this->folder.'index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->find($id);   
        return MainService::renderToJson('pages.admin.stock.edit',compact('data'));
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
        return $this->crud_service
                        ->setModel( $this->model )
                        ->setRequest( $request )
                        ->setParams([ 'id' => $id])
                        ->update();
    }

    public function datatable()
    {
        $data = $this->model->query()->verified()->with('umkm','category');
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('show_price',function($data){
                        	return number_format($data->price);
                        })
                        ->addColumn('action_stock', function ($data)  {
                            return '<button 
                                            class     = "btn btn-circle btn-sm btn-info show_from"
                                            data-size="lg"
                                            data-url  = '. url("admin/stock/$data->id/edit") .'
                                            data-toggle="tooltip" title="Ubah Stok"
                                            > 
                                            <i class  = "fa fa-edit"> </i> 
                                        </button>';
                            })
                            ->addColumn('show_image', function ($data) {
                                return '<center><img src="../'.$data->image.'" class="rounded-circle" width="120px"></center>';
                            })
                            ->rawColumns(['show_image','action_stock'])
                        ->make(true);

    }

}

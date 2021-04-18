<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use CrudService;
use DataTables;
use File;
use ResponseService;
use MainService;

class VerifyProductController extends Controller
{
    private $model,
            $crud_service,
            $folder,
            $facade,
            $url = 'umkm/product/';

    public function __construct(Product $model,CrudService $crud_service)
    {
        $this->model        = $model;
        $this->crud_service = $crud_service;
        $this->folder       = 'pages.admin.verify-product.';
    }

    public function index(Request $request)
    {
    	if($request->ajax()){
    		return $this->datatable();
    	}

    	return view('pages.admin.verify-product.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->with('umkm','category')->find($id);
        return MainService::renderToJson('pages.admin.verify-product.accept',compact('data'));
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
        $request->request->add([ 'verified' => 1,'published' => 1, ]);
        // dd($request->all());
        return $this->crud_service
                            ->setModel( $this->model )
                            ->setRequest( $request )
                            ->setParams([ 'id' => $id])
                            ->update();
    }

    public function destroy($id,ResponseService $response)
    {
        try {
            $data = $this->model->find($id);
            File::delete($data->image);
            $data->delete();

            return $response->setCode(200)
            ->setMsg("Data Berhasil Dihapus")
            ->success();

        } catch (Exception $e) {
            $code   = $e->getCode();
            $errors = [$e->getMessage()];
            return $response->setCode($code)
            ->setErrors($errors)
            ->error();
        }
    }
    /**
     * data json for datatable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $data = $this->model->query()->unverified()->with('umkm','category');
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
                                            class     = "btn btn-circle btn-sm btn-success show_from"
                                            data-size="lg"
                                            data-url  = '. url("admin/verify-product/$data->id/edit") .'
                                            data-toggle="tooltip" title="Verifikasi"
                                            > 
                                            <i class  = "fa fa-check"> </i> 
                                       </button>

                                       <button 
                                                type           ="button"  
                                                class          ="btn btn-circle btn-sm btn-danger btn-sm mr-1 btn_delete" 
                                                data-toggle    ="tooltip" 
                                                data-placement ="top" 
                                                data-type      = "reload"
                                                title          =  "Tolak"
                                                data-url       = '. url("admin/verify-product/$data->id") .'
                                                data-text      = "'. self::delete($data)  .'">
                                                <i class="fa fa-times"></i>
                                        </button>

                                       ';
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
                        ->rawColumns(['show_image','action','action_stock'])
                        ->make(true);
    }


    private static function delete($data)
    {
        return view("pages.admin.verify-product.reject",compact('data'))->render();
    }
}

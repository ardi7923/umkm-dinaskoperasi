<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Umkm;
use CrudService;
use MainService;
use DataTables;
use File;
use ResponseService;

class DataProductController extends Controller
{
    private $model,
            $crud_service,
            $folder,
            $facade,
            $url = 'admin/data-product/';

    public function __construct(Umkm $model,CrudService $crud_service)
    {
        $this->model        = $model;
        $this->crud_service = $crud_service;
        $this->folder       = 'pages.admin.data-product.';
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
        return MainService::renderToJson($this->folder.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->crud_service->setModel($this->model)
                            ->setRequest( $request )
                            ->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->find($id);
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
        $data = $this->model->find($id);
        return MainService::renderToJson($this->folder.'edit',compact('data'));
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
                    ->setParams([ 'id' => $id ])
                    ->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,ResponseService $response)
    {
        try {
            $data = $this->model->find($id);
            File::delete($data->logo);
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
        $data = $this->model->query()->verify();
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($data)  {
                            return '<button 
                                            class     = "btn btn-circle btn-sm btn-info show_from"
                                            data-size="lg"
                                            data-url  = '. url("admin/data-umkm/$data->id") .'
                                            data-toggle="tooltip" title="Lihat Data"
                                            > 
                                            <i class  = "fa fa-eye"> </i> 
                                       </button>

                                       <button 
                                                type           ="button"  
                                                class          ="btn btn-circle btn-sm btn-danger btn-sm mr-1 btn_delete" 
                                                data-toggle    ="tooltip" 
                                                data-placement ="top" 
                                                data-type      = "reload"
                                                title          =  "Hapus Data"
                                                data-url       = '. url("admin/data-umkm/$data->id") .'
                                                data-text      = "'. self::delete($data)  .'">
                                                <i class="fa fa-trash"></i>
                                        </button>';
                            })
                        ->make(true);

    }


    private static function delete($data)
    {
        return view("pages.admin.data-umkm.delete",compact('data'))->render();
    }
}

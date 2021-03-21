<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Umkm;
use CrudService;
use MainService;
use DataTables;

class VerifyUmkmController extends Controller
{
    private $model,
            $crud_service,
            $folder,
            $facade,
            $url = 'admin/category/';

    public function __construct(Umkm $model,CrudService $crud_service)
    {
        $this->model        = $model;
        $this->crud_service = $crud_service;
        $this->folder       = 'pages.admin.category.';
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
        return view('pages.admin.verify-umkm.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        return MainService::renderToJson('pages.admin.verify-umkm.accept',compact('data'));
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
        $request->request->add([ 'verify' => 1 ]);

        return $this->crud_service
                            ->setModel( $this->model )
                            ->setRequest( $request )
                            ->setParams([ 'id' => $id])
                            ->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->crud_service
                    ->setModel( $this->model )
                    ->setParams([ 'id' =>  $id ])
                    ->delete();
    }
    /**
     * data json for datatable.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $data = $this->model->query()->unverify();
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($data)  {
                                return '<button 
                                            class     = "btn btn-circle btn-sm btn-success show_from"
                                            data-size="lg"
                                            data-url  = '. url("admin/verify-umkm/$data->id/edit") .'
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
                                                data-url       = '. url("admin/verify-umkm/$data->id") .'
                                                data-text      = "'. self::delete($data)  .'">
                                                <i class="fa fa-times"></i>
                                        </button>

                                       ';
                            })
                        ->make(true);
    }

    private static function delete($data)
    {
        return view("pages.admin.verify-umkm.reject",compact('data'))->render();
    }

}

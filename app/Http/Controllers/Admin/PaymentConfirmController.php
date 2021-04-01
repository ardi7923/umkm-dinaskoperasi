<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use CrudService;
use DataTables;
use ResponseService;
use File;
use MainService;

class PaymentConfirmController extends Controller
{
    private $model,
            $crud_service,
            $folder,
            $facade,
            $url = 'umkm/product/';

    public function __construct(Order $model,CrudService $crud_service)
    {
        $this->model        = $model;
        $this->crud_service = $crud_service;
        $this->folder       = 'pages.admin.payment-confirm.';
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

        return view('pages.admin.payment-confirm.index');

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
        return MainService::renderToJson($this->folder.'accept',compact('data'));
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
        $request->request->add([ 'sts' => 2,'image_transaction' => null ]);

        $data = $this->model->find($id);
        File::delete($data->image_transaction);
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
    public function destroy($id, ResponseService $response)
    {
        try {
            $data = $this->model->find($id);
            File::delete($data->image_transaction);
            $data->update([
                            'sts'               => 0,
                            'image_transaction' => null
                         ]);

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
        $data = $this->model->query()->wait()->with(['bank','user']);
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('show_image', function ($data) {
                            return '<center><img src="../'.$data->image_transaction.'" class="rounded-circle" width="120px"></center>';
                        })
                        ->addColumn('show_price',function($data){
                            return rupiah_format($data->lists->sum('total_price'));
                        })
                        ->addColumn('action', function ($data)  {
                                return '<button 
                                            class     = "btn btn-circle btn-sm btn-success show_from"
                                            data-size="lg"
                                            data-url  = '. url("admin/payment-confirm/$data->id/edit") .'
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
                                                data-url       = '. url("admin/payment-confirm/$data->id") .'
                                                data-text      = "'. self::delete($data)  .'">
                                                <i class="fa fa-times"></i>
                                        </button>

                                       ';
                            })
                        ->rawColumns(['show_image','action'])
                        ->make(true);
    }

    private static function delete($data)
    {
        return view("pages.admin.payment-confirm.reject",compact('data'))->render();
    }
}

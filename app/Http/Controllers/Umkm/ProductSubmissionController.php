<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Category;
use CrudService;
use MainService;
use DataTables;
use App\Http\Requests\ProductSubmissionRequest;
use App\Services\Facades\ProductSubmissionService;

class ProductSubmissionController extends Controller
{
    private $model,
            $crud_service,
            $folder,
            $validator,
            $facade,
            $url = 'admin-umkm/product-submission/';

    public function __construct(Product $model,CrudService $crud_service,ProductSubmissionRequest $validator,ProductSubmissionService $facade)
    {
        $this->model        = $model;
        $this->crud_service = $crud_service;
        $this->folder       = 'pages.umkm.product-submission.';
        $this->validator    = $validator;
        $this->facade       = $facade;
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
        $categories = Category::all();
        return MainService::renderToJson($this->folder.'create',compact('categories'));
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
                            ->setValidator( $this->validator )
                            ->setFacade( $this->facade )
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
        $data       = $this->model->find($id);
        $categories = Category::all();
        return MainService::renderToJson($this->folder.'edit',compact('data','categories'));
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
                    ->setValidator( $this->validator )
                    ->setFacade( $this->facade )
                    ->setParams([ 'id' => $id ])
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
                    ->setParams([ 'id' => $id ])
                    ->setFacade( $this->facade )
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
        $data = $this->model->query()->unverified()->isUmkm()->with('category');
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('show_image', function ($data) {
                            return '<center><img src="../'.$data->image.'" class="rounded-circle" width="120px"></center>';
                        })
                        ->addColumn('show_umkm_price',function($data){
                            return number_format($data->umkm_price);
                        })
                        ->addColumn('action', function ($data)  {
                            return view('components.datatables.action', [
                                'data'        => $data,
                                'url_edit'    => url($this->url.$data->id.'/edit'),
                                'url_destroy' => url($this->url.$data->id),
                                'delete_text' => view($this->folder.'delete',compact('data'))->render()
                                ]);
                            })
                        ->rawColumns(['show_image','action','show_umkm_price'])
                        ->make(true);
    }
}

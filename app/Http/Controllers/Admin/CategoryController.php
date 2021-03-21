<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use CrudService;
use MainService;
use DataTables;

class CategoryController extends Controller
{
    private $model,
            $crud_service,
            $folder,
            $facade,
            $url = 'admin/category/';

    public function __construct(Category $model,CrudService $crud_service)
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
        return view('pages.admin.category.index');
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
    public function destroy($id)
    {
        return $this->crud_service
                    ->setModel( $this->model )
                    ->setParams([ 'id' => $id ])
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
        $data = $this->model->query();
        return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function ($data)  {
                            return view('components.datatables.action', [
                                'data'        => $data,
                                'url_edit'    => url($this->url.$data->id.'/edit'),
                                'url_destroy' => url($this->url.$data->id),
                                'delete_text' => view($this->folder.'delete',compact('data'))->render()
                                ]);
                            })
                        ->make(true);
    }
}

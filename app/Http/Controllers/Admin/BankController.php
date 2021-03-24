<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use CrudService;
use MainService;
use DataTables;
use App\Http\Requests\BankRequest;
use App\Services\Facades\BankService;

class BankController extends Controller
{
    private $model,
            $crud_service,
            $folder,
            $validator,
            $facade,
            $url = 'admin/bank/';

    public function __construct(Bank $model,CrudService $crud_service,BankRequest $validator,BankService $facade)
    {
        $this->model        = $model;
        $this->crud_service = $crud_service;
        $this->folder       = 'pages.admin.bank.';
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
        // dd($request->all());
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
                        ->addColumn('show_logo', function ($data) {
                            return '<center><img src="../'.$data->logo.'" class="rounded-circle" width="120px"></center>';
                        })
                         ->addColumn('show_name', function ($data) {
                            return $data->name.' ('.$data->alias.')';
                        })
                        ->addColumn('action', function ($data)  {
                            return view('components.datatables.action', [
                                'data'        => $data,
                                'url_edit'    => url($this->url.$data->id.'/edit'),
                                'url_destroy' => url($this->url.$data->id),
                                'delete_text' => view($this->folder.'delete',compact('data'))->render()
                                ]);
                            })
                        ->rawColumns(['show_logo','action'])
                        ->make(true);
    }
}

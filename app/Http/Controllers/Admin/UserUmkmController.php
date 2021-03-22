<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Umkm;
use CrudService;
use MainService;
use DataTables;
use App\Http\Requests\UserUmkmRequest;
use App\Services\Facades\UserUmkmService;

class UserUmkmController extends Controller
{
    private $model,
            $crud_service,
            $validator,
            $folder,
            $facade,
            $url = 'admin/user-umkm/';

    public function __construct(User $model,UserUmkmRequest $validator,CrudService $crud_service,UserUmkmService $facade)
    {
        $this->model        = $model;
        $this->validator    = $validator;
        $this->facade       = $facade;
        $this->crud_service = $crud_service;
        $this->folder       = 'pages.admin.user-umkm.';
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
        $umkms = Umkm::verify()->get();
        return MainService::renderToJson($this->folder.'create',compact('umkms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return $this->crud_service
                    ->setModel( $this->model )
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
        $umkms = Umkm::verify()->get();
        $data  = $this->model->find($id);
        return MainService::renderToJson($this->folder.'edit',compact('umkms','data'));
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
        $user = $this->model->find($id);

        return $this->crud_service
                    ->setModel( $this->model )
                    ->setRequest( $request )
                    ->setValidator( $this->validator )
                    ->setFacade( $this->facade )
                    ->setIdOld($user->username)
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
        $data = $this->model->query()->isUmkm()->with('umkm');
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

<?php

namespace App\Services\Facades;

use DB;
use App\Models\User;
use MainService;
use Image;
use File;
use Mail;
use Umkm;
use App\Mail\sendUsernameUmkm;

class UserUmkmService{


	public function save($request)
	{
		DB::transaction(function () use ($request)   {
			$umkm = Umkm::find($request->umkm_id);

			Mail::to($umkm->email)->send(new sendUsernameUmkm($request));
			
			User::create([
							'name'     => $request->name,
							'username' => $request->username,
							'password' => bcrypt($request->password),
							'role'     => 'UMKM',
							'umkm_id'  => $request->umkm_id

						]);


		});
	}

	public function update($request,$params)
	{

		User::where($params)->update([
							'name'     => $request->name,
							'username' => $request->username,
							'password' => bcrypt($request->password),
							'umkm_id'  => $request->umkm_id

						]);
	}


}
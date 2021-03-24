<?php

namespace App\Services\Facades;

use DB;
use App\Models\Bank;
use MainService;
use Image;
use File;

class BankService{


	public function save($request)
	{
		DB::transaction(function () use ($request)   {

			$logo      = $request->logo;
			$image     = MainService::replaceStringBase64($logo);
			$imageName = 'uploads/images/bank/'.$request->id.'-'.time().'.'.MainService::getTypeFileBase64($logo);
			Bank::create($request->except('_token','logo')+['logo' => $imageName]);
			
			(string) Image::make($image)->encode('data-url')->save($imageName);

		});
	}

	public function update($request,$params)
	{

		if($request->logo == "null" ){

            Bank::where($params)->update($request->except(['_token','_method','logo']));

        }else{

            $data = Bank::where($params)->first();

            File::delete($data->logo);

            $logo      = $request->logo;
            $image     = MainService::replaceStringBase64($logo);
            $imageName = 'uploads/images/bank/'.$request->id.'-'.time().'.'.MainService::getTypeFileBase64($logo);
            
            Bank::where($params)
            		->update($request->except('_token','_method','logo')+['logo' => $imageName]);

            (string) Image::make($image)->encode('data-url')->save($imageName);
        }
	}

	public function delete($params)
	{
		DB::transaction(function () use ($params)   {
			$data = Product::where($params)->first();
			File::delete($data->logo);
			$data->delete();
		});
	}
}
<?php

namespace App\Services\Facades;

use DB;
use App\Models\Product;
use MainService;
use Image;
use File;

class ProductSubmissionService{


	public function save($request)
	{
		DB::transaction(function () use ($request)   {

			$logo      = $request->image;
			$image     = MainService::replaceStringBase64($logo);
			$imageName = 'uploads/images/product/'.$request->id.'-'.time().'.'.MainService::getTypeFileBase64($logo);
			Product::create($request->except('_token','image')+['image' => $imageName,'price' => $request->umkm_price]);
			
			(string) Image::make($image)->encode('data-url')->save($imageName);

		});
	}

	public function update($request,$params)
	{

		if($request->image == "null" ){

            Product::where($params)->update($request->except(['_token','_method','image']));

        }else{

            $data = Product::where($params)->first();

            File::delete($data->image);

            $logo      = $request->image;
            $image     = MainService::replaceStringBase64($logo);
            $imageName = 'uploads/images/product/'.$request->id.'-'.time().'.'.MainService::getTypeFileBase64($logo);
            
            Product::where($params)
            		->update($request->except('_token','_method','image')+['image' => $imageName,'price' => $request->umkm_price]);

            (string) Image::make($image)->encode('data-url')->save($imageName);
        }
	}

	public function delete($params)
	{
		DB::transaction(function () use ($params)   {
			$data = Product::where($params)->first();
			File::delete($data->image);
			$data->delete();
		});
	}
}
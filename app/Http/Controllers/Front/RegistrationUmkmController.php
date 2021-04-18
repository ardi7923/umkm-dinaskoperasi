<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
Use App\Models\Umkm;

class RegistrationUmkmController extends Controller
{
    public function index()
    {
    	return view('pages.front.registration-umkm.index');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
			'nik'        => 'required',
            'name'       => 'required',
            'email'      => 'required',
			'birthplace' => 'required',
			'birthday'   => 'required',
			'phone'      => 'required',
			'address'    => 'required',
			'store_name' => 'required',
			'logo'       => 'required|image|max:2048'
        ]);
        

        try {
            $file     = $request->logo;
            $namaFile = 'uploads/images/umkm/'.time().'.'.$file->extension();
            Image::make($file)->resize(547,547)->encode('data-url')->save($namaFile);
            
            Umkm::create([

								'name'       => $request->name,
								'birthplace' => $request->birthplace,
								'birthday'   => $request->birthday,
								'phone'      => $request->phone,
								'address'    => $request->address,
								'store_name' => $request->store_name,
								'logo'       => $namaFile,


                            ]);

            return redirect('registration-umkm/success');
        } catch (\Exception $e) {
            dd($e);
            // return back();
        }
    	// return view('pages.front.registration-umkm.index');
    }

    public function success()
    {
    	return view('pages.front.registration-umkm.success');
    }
}

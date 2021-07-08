<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
Use App\Models\Umkm;
use App\Models\District;
use Illuminate\Support\Str;

class RegistrationUmkmController extends Controller
{
    public function index()
    {
        $districts = District::all();

    	return view('pages.front.registration-umkm.index',compact('districts'));
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
			'store_name' => 'required|unique',
			'logo'       => 'required|image|max:2048'
        ]);
        

        try {
            $file     = $request->logo;
            $namaFile = 'uploads/images/umkm/'.time().'.'.$file->extension();
            Image::make($file)->resize(547,547)->encode('data-url')->save($namaFile);
            
            Umkm::create([

								'name'       => $request->name,
                                'nik'        => $request->nik,
                                'email'      => $request->email,
								'birthplace' => $request->birthplace,
								'birthday'   => $request->birthday,
								'phone'      => $request->phone,
								'address'    => $request->address,
                                'district'   => $request->district,
								'store_name' => $request->store_name,
                                'slug'       => Str::slug($request->store_name),
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

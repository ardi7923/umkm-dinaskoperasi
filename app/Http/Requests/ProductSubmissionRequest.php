<?php

namespace App\Http\Requests;

use Validator;
use Illuminate\Validation\Rule;

class ProductSubmissionRequest
{

// Validation ========================================

    public static function validation($request,$method,$id_old = ""){

    	
        if ($method == 'store') {

           $image = ['required','base64image','base64mimes:jpeg,png,jpg','base64max:2048'];

        }elseif($method == 'update' && $request->image != "null"){

            $image = ['required','base64image','base64mimes:jpeg,png,jpg','base64max:2048'];

        }else{

            $image = '';
            
        }

        $validator = Validator::make($request->all(), [
            
            'name'        => ['required'],
            'umkm_price'  => ['required'],
            'description' => ['required'], 
            'image'       => $image


        ]);

        return $validator;

    }

//===========================================
}
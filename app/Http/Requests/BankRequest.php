<?php

namespace App\Http\Requests;

use Validator;
use Illuminate\Validation\Rule;

class BankRequest
{

// Validation ========================================

    public static function validation($request,$method,$id_old = ""){

    	
        if ($method == 'store') {

           $logo = ['required','base64image','base64mimes:jpeg,png,jpg','base64max:2048'];

        }elseif($method == 'update' && $request->logo != "null"){

            $logo = ['required','base64image','base64mimes:jpeg,png,jpg','base64max:2048'];

        }else{

            $logo = '';
            
        }

        $validator = Validator::make($request->all(), [
            
            'name'           => ['required'],
            'alias'          => ['required'],
            'account_name'   => ['required'],
            'account_number' => ['required'], 
            'logo'           => $logo


        ]);

        return $validator;

    }

//===========================================
}
<?php

namespace App\Http\Requests;

use Validator;
use Illuminate\Validation\Rule;

class UserUmkmRequest
{

// Validation ========================================

    public static function validation($request,$method,$id_old = ""){

    	if($method == "store")
    	{
            $username        = ['required','unique:users'];
            $password        = ['required','min:6'];
            $repeat_password = ['required','same:password'];
    	}else{
            $username        =  ['required', Rule::unique('users')->ignore($id_old,'username')];
            $password        = ($request->password) ? ['required','min:6'] : '';
            $repeat_password = ($request->password) ?['required','same:password'] : '';
    	}

        $validator = Validator::make($request->all(), [
            
            'username'         => $username,
            'name'             => ['required'],
            'password'         => $password, 
            'confirm_password' => $repeat_password


        ]);

        return $validator;

    }

//===========================================
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => ['required'],
            'phone'            => ['required'],
            'district_id'      => ['required'],
            'address'          => ['required'],
            'username'         => ['required','unique:users'],
            'password'         => ['required','min:6'],
            'confirm_password' => ['required','same:password']

        ];
    }
}

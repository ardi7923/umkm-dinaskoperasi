<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\sendUsernameUmkm;

class TesEmailController extends Controller
{
    public function tes()
    {
        return Mail::to('ardiirawan777@gmail.com')->send(new sendUsernameUmkm('tes'));
    }
}

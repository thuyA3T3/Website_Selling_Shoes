<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginControlller extends Controller
{
    //
    public function show()
    {
        return view('login_register');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Maincontroller extends Controller
{
    //
    public function index()
    {
        return view('admin.home', ['title' => 'Trang chủ Admin']);
    }
}

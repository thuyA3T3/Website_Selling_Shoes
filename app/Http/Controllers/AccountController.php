<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\RegisterRequest;
use App\Models\Oder;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AccountController extends Controller
{
    //
    public function show()
    {
        $orderdetals = OrderDetail::all();
        $products = Product::all();

        return view('myaccount', [

            'orderdetails' => $orderdetals,
            'products' => $products,
        ]);
    }


    public function register()
    {
        echo ('123');
        // $dataFromEmail = json_decode($request->input('data'), true);
        // dd($dataFromEmail);
        // $data = [
        //     'FirstName' => $dataFromEmail['firstName'],
        //     'LastName' => $dataFromEmail['lastName'],
        //     'Email' => $dataFromEmail['email'],
        //     'Phone' => $dataFromEmail['phone'],
        //     'password' => Hash::make($dataFromEmail['password']),
        // ];

        // // Tiếp tục xử lý với dữ liệu $data
        // Customer::create($data);
        // Session::flash('success', 'Đăng ký thành công');
    }
    public function send(RegisterRequest $request)
    {
        $data = [
            'subject' => 'Shop ban giay',
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => $request->input('password'),
            'confirmPassword' => $request->input('confirmPassword'),
        ];

        Mail::to('thuydao13042002@gmail.com')->send(new MailNotify($data));
    }
}

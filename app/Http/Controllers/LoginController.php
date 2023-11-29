<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function show()
    {
        return view('login_register');
    }
    public function register(Request $request)
    {
        dd($request);
        $data['FirstName'] = $request->firstName;
        $data['LastName'] = $request->lastName;
        $data['Email'] = $request->email;
        $data['Phone'] = $request->phone;
        $data['password'] = Hash::make($request->password);

        Customer::create($data);
        Session::flash('success', 'Đăng ký thành công');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {

            return redirect()->route('home');
        } else {

            return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
        }
    }
    public function signOut()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('home');
    }
}

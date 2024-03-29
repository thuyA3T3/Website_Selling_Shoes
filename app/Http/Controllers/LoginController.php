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
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            $user = Auth::guard('customer')->user();

            // Kiểm tra trường activation
            if ($user->activation) {
                return redirect()->route('home');
            } else {
                Auth::guard('customer')->logout();
                return back()->withErrors(['email' => 'Tài khoản chưa được kích hoạt']);
            }
        } else {
            return back()->withErrors(['email' => 'Email hoặc mật khẩu không đúng']);
        }
    }
    public function signOut()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('viewloginregister');
    }
}

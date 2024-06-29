<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function index(Request $request){
        if(Auth::check()){
            return redirect()->route('admin.dashboard.index');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if ($credentials) {
            // If user exists, attempt to authenticate
            if (Auth::attempt($credentials)) {
                return redirect()->route('admin.dashboard.index')->with('success', 'Đăng nhập thành công!');
            } else {
                return redirect()->route('auth.admin')->with('error', 'Email hoặc mật khẩu không chính xác!');
            }
        } else {
            // If user does not exist, return error
            return redirect()->route('auth.admin')->with('error', 'Email không tồn tại!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.admin');
    }
}

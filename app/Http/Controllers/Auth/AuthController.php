<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\UserModel;

class AuthController extends Controller
{
    public function index(Request $request){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $email = $request->input('email');

        $credentials = [
            'email' => $email,
            'password' => $request->input('password'),
        ];
        $user = User::where('email', $email)->first();
        if($user && $user->status == -1){
            return redirect()->route('auth.admin')->with('error', "Tài khoản $email đã bị khoá");
        }
        
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Str;
use App\Models\UserModel;

class UserController extends Controller
{
    public function create(){
        return view('admin.pages.user.create');
    }

    public function store(UserStoreRequest $request){
        $result = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position' => $request->position,
        ]);

        $message = $result ? 'Tạo tài khoản thành công' : 'Tạo tài khoản thất bại';

        return redirect()->route('admin.user.index')->with('success', $message);
    }

    public function index(Request $request){
        $datas = DB::table('users')->get();
        return view('admin.pages.user.index', ['datas' => $datas]);
    }

    public function destroy(UserModel $id)
    {
        $result = $id->delete();
        //Flash message
        $message = $result ? 'Xoá tài khoản thành công' : 'Xoá tài khoản thất bại';
        return redirect()->route('admin.user.index')->with('success', $message);
    }

    // public function restore(Request $request, int $id){
    //     $id = $request->id;
    //     //Eloquent
    //     UserModel::withTrashed()->find($id)->restore();

    //     return redirect()->route('admin.user.index')->with('success', 'Khôi phục tài khoản thành công');
    // }

    public function detail(Request $request, $id){
        return view('admin.pages.user.detail', ['data' => $id]);
    }

    public function update(UserUpdateRequest $request, $id){
        //Eloquent Update
        $id = UserModel::find($id);

        //mass assignment
        $result = $id->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'position' => $request->position
        ]);

        $message = $result ? 'Cập nhật tài khoản thành công' : 'Cập nhật tài khoản thất bại';

        return redirect()->route('admin.user.index')->with('success', $message);
    }
}

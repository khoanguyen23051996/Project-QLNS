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
        $datas = UserModel::query()->get();
        return view('admin.pages.user.index', ['datas' => $datas]);
    }

    public function destroy(UserModel $user)
    {
        $result = $user->delete();
        //Flash message
        $message = $result ? 'Xoá tài khoản thành công' : 'Xoá tài khoản thất bại';
        return redirect()->route('admin.user.index')->with('success', $message);
    }

    public function restore(Request $request, int $id){
        $id = $request->id;
        //Eloquent
        UserModel::withTrashed()->find($id)->restore();

        return redirect()->route('admin.user.index')->with('success', 'Khôi phục tài khoản thành công');
    }

    public function detail(Request $request, $id){
        $user = UserModel::find($id);
        return view('admin.pages.user.detail', ['user' => $user]);
    }

    public function update(UserUpdateRequest $request, $id){
        //Eloquent Update
        $user = UserModel::find($id);

        $userDatas = [
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position
        ];

       if ($request->password) {
        $userDatas['password'] = Hash::make($request->password);
       } 

        //mass assignment
        $result = $user->update($userDatas);

        $message = $result ? 'Cập nhật tài khoản thành công' : 'Cập nhật tài khoản thất bại';

        return redirect()->route('admin.user.index')->with('success', $message);
    }

    public function changeStatus(UserModel $user){
        if($user->status == 1){
            $result = $user->update(['status' => -1]);
        }else{
            $result = $user->update(['status' => 1]);
        }

        $message = $result ? 'Cập nhật tài khoản thành công' : 'Cập nhật tài khoản thất bại';

        return redirect()->route('admin.user.index')->with('success', $message);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\DepartmentModel;
use App\Models\PositionModel;
use App\Models\User;

class UserController extends Controller
{
    public function create(){
        $departments = DepartmentModel::get();
        $positions = PositionModel::get();
        return view('admin.pages.user.create')->with('departments',$departments)->with('positions',$positions);
    }

    public function store(UserStoreRequest $request){
        $user = new User();
        if($request->hasFile('image')) {
           
                // $folderName = date('Y/m');
                // $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // $extension = $file->getClientOriginalExtension();
                // $fileName = $originalFileName . '_' . time() . '.' . $extension;
                // $file->storeAs('public/uploads/' . $folderName, $fileName);
                // $file->move(public_path('storage/uploads/' . $folderName), $fileName);
                // $post->postImages()->create(['image' => 'uploads/' . $folderName . '/' . $fileName]);
        
            $image = $request->file('image');
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fieldNameNew = $fileName . '_' . uniqid() . '.' . $extension;
            $image->move(public_path('uploads/images'), $fieldNameNew);
        }

        $user->code = $request->code;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->dob = $request->dob;
        $user->address = $request->address;
        $user->image = $fieldNameNew;
        $user->status = $request->status;
        $user->position_id = $request->position_id;
        $user->department_id = $request->department_id;
        $user->password = Hash::make($request->password);

        if($user->save())
        {
            return redirect()->route('admin.user.index')->with('success', 'Thêm nhân viên thành công');
        }
        else{
            return back()->with('error', 'Thêm nhân viên thất bại');
        }

        // $result = $user->fill([
        //     'code' => $request->code,
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'role' => $request->role,
        //     'dob' => $request->dob,
        //     'address' => $request->address,
        //     'phone' => $request->phone,
        //     'status' => $request->status,
        //     'password' => Hash::make($request->password),
        //     'image' => $request->fieldNameNew,
        //     'position_id' => $request->position_id,
        //     'department_id' => $request->department_id,
        // ])->save();


        
    }

    public function index(Request $request){
        return view('admin.pages.user.index', User::indexSearch($request->all()));
    }

    public function destroy(User $user)
    {
        $result = $user->delete();
        //Flash message
        $message = $result ? 'Xoá tài khoản thành công' : 'Xoá tài khoản thất bại';
        return redirect()->route('admin.user.index')->with('success', $message);
    }

    public function restore(Request $request, $id){
        $id = $request->id;
        //Eloquent
        User::withTrashed()->find($id)->restore();

        return redirect()->route('admin.user.index')->with('success', 'Khôi phục tài khoản thành công');
    }

    public function detail(Request $request, $id){
        $user = User::find($id);
        return view('admin.pages.user.detail', ['user' => $user]);
    }

    public function update(UserUpdateRequest $request, $id){
        $user = User::find($id);

        $userDatas = [
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position
        ];

        if ($request->password) {
            $userDatas['password'] = Hash::make($request->password);
        } 

        $result = $user->update($userDatas);

        $message = $result ? 'Cập nhật tài khoản thành công' : 'Cập nhật tài khoản thất bại';

        return redirect()->route('admin.user.index')->with('success', $message);
    }

    public function changeStatus(User $user){
        if($user->status == 1){
            $result = $user->update(['status' => -1]);
        }else{
            $result = $user->update(['status' => 1]);
        }

        $message = $result ? 'Cập nhật trạng thái thành công' : 'Cập nhật trạng thái thất bại';

        return redirect()->route('admin.user.index', ['page' => request()->input('page', 1)])->with('success', $message);
    }

    public function search(Request $request){ 
        return view('admin.pages.user.index', User::indexSearch($request->all()));
    }
}

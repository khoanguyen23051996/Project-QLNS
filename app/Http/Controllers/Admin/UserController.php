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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
            $image = $request->file('image');
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $fieldNameNew = $fileName . '_' . uniqid() . '.' . $extension;
            $image->move(public_path('uploads/images'), $fieldNameNew);
            $user->image = $fieldNameNew;
        }

        $user->code = $request->code;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->dob = Carbon::parse($request->dob)->format('Y-m-d');
        $user->phone = $request->phone;
        $user->address = $request->address;
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
    }

    public function index(Request $request){
        $user = Auth::user();
        return view('admin.pages.user.index', User::indexSearch($request->all()),['user'=>$user]);
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

    public function edit(Request $request, $id){
        $departments = DepartmentModel::get();
        $positions = PositionModel::get();
        $user = User::find($id);
        if($user){
            return view('admin.pages.user.edit', ['user' => $user])->with('departments',$departments)->with('positions',$positions);
        }else{
            return back()->with('error', 'User không tồn tại!');
        }
    }

    public function update(UserUpdateRequest $request, $id){
        $user = User::find($id);
        if($user){
            if($request->hasFile('image')) {
                if ($user->image) {
                    $oldImagePath = public_path('uploads/images/' . $user->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $image = $request->file('image');
                $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $fieldNameNew = $fileName . '_' . uniqid() . '.' . $extension;
                $image->move(public_path('uploads/images'), $fieldNameNew);
                $user->image = $fieldNameNew;
            }
            
            $user->code = $request->code;
            $user->name = $request->name;
            $user->role = $request->role;
            $user->dob = $request->dob;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->status = $request->status;
            $user->position_id = $request->position_id;
            $user->department_id = $request->department_id;
            $user->save();
            
    
            if ($request->password) {
                $user->password = Hash::make($request->password);
            } 
    
            $result = $user->update();
    
            $message = $result ? 'Cập nhật tài khoản thành công' : 'Cập nhật tài khoản thất bại';
    
            return redirect()->route('admin.user.index')->with('success', $message);
        }else{
            return back()->with('error', 'User không tồn tại!');
        }
        
    }

    public function changeStatus(Request $request){
        if(Auth()->user()->role == 0)
        {
            $user = User::find($request->user_id);
            if($user){
                if($user->status == 1){
                    $result = $user->update(['status' => -1]);
                }else{
                    $result = $user->update(['status' => 1]);
                }
                
                $message = $result ? 'Cập nhật trạng thái thành công' : 'Cập nhật trạng thái thất bại';
        
                return redirect()->route('admin.user.index', ['page' => request()->input('page', 1)])->with('success', $message);
            }
            return back()->with('error', "User không tồn tại!");
        }
        return back()->with('error',"Bạn không có quyền sử dụng!!");    
    }

    public function search(Request $request){ 
       
        return view('admin.pages.user.index', User::indexSearch($request->all()));
    }
}

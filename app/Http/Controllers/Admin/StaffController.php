<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffStoreReqest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index(){
        $staffs = DB::table('staff')->get();
        return view('admin.pages.staff.index', ['staffs' => $staffs]);
    }

    public function create(Request $request)
    {
        return view('admin.pages.staff.create');
    }

    public function store(StaffStoreReqest $request)
    {
        $result = DB::table('staff')->insert([
            'name' => $request->name,
            'departmentid' => $request->departmentid,
        ]);

        $message = $result ? 'Thêm nhân viên thành công' : 'Thêm nhân viên thất bại';

        return redirect()->route('admin.department.index')->with('success', $message);
    }
}

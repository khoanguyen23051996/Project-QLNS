<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Http\Requests\PositionStoreRequest;
use App\Models\DepartmentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $datas = DepartmentModel::withTrashed()->get();
        return view('admin.pages.department.index', ['datas' => $datas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.pages.department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionStoreRequest $request)
    {
        $result = DB::table('department')->insert([
            'name' => $request->name,
            'departmentid' => $request->departmentid,
        ]);
        
        $message = $result ? 'Tạo phòng ban thành công' : 'Tạo phòng ban thất bại';

        return redirect()->route('admin.department.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function detail(Request $request, DepartmentModel $departmentid){
        return view('admin.pages.department.detail', ['data' => $departmentid]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentUpdateRequest $request, $departmentid)
    {
         //Eloquent Update
         $departmentid = DepartmentModel::find($departmentid);

         //mass assignment
         $result = $departmentid->update([
             'departmentid' => $request->departmentid,
             'name' => $request->name,
         ]);
 
         $message = $result ? 'Cập nhật phòng ban thành công' : 'Cập nhật phòng ban thất bại';
 
         return redirect()->route('admin.department.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, DepartmentModel $departmentid)
    {
        $result = $departmentid->delete();
        //Flash message
        $message = $result ? 'Xoá phòng ban thành công' : 'Xoá phòng ban thất bại';
        return redirect()->route('admin.department.index')->with('success', $message);
    }

    public function restore(Request $request, int $id){
        $id = $request->id;
        //Eloquent
        DepartmentModel::withTrashed()->find($id)->restore();

        return redirect()->route('admin.department.index')->with('success', 'Khôi phục phòng ban thành công');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionUpdateRequest;
use App\Models\PositionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $positions = PositionModel::withTrashed()->paginate(5);
        return view('admin.pages.position.index', ['positions' => $positions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.position.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $position = new PositionModel();
        $result = $position->fill([
            'name' => $request->name,
            'code' => $request->code
        ])->save();

        // PositionModel::create([
        //     'name' => $request->name,
        //     'code' => $request->code
        // ]);

        $message = $result ? 'Tạo chức vụ thành công' : 'Tạo chức vụ thất bại';

        return redirect()->route('admin.position.index')->with('success', $message);
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
    public function detail(Request $request, PositionModel $id)
    {
        return view('admin.pages.position.detail', ['data' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionUpdateRequest $request, $id)
    {
        //Eloquent Update
        $id = PositionModel::find($id);

        //mass assignment
        $result = $id->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        $message = $result ? 'Cập nhật chức vụ thành công' : 'Cập nhật chức vụ thất bại';

        return redirect()->route('admin.position.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, PositionModel $id)
    {
        $result = $id->delete();
        //Flash message
        $message = $result ? 'Xoá chức vụ thành công' : 'Xoá chức vụ thất bại';
        return redirect()->route('admin.position.index')->with('success', $message);
    }

    public function restore(Request $request, int $id){
        $id = $request->id;
        //Eloquent
        PositionModel::withTrashed()->find($id)->restore();

        return redirect()->route('admin.position.index')->with('success', 'Khôi phục thành công');
    }
}

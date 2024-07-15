<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportExcel;
use App\Http\Controllers\Controller;
use App\Models\DepartmentModel;
use App\Models\PositionModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index(){
        $users = Auth::user();
        $totalUser = User::count();
        $userOff = User::where('status', -1)->count();
        $totalDepartment = DepartmentModel::count();
        $totalPosition = PositionModel::count();

        $datas = [
            'totalUser' => $totalUser,
            'userOff' => $userOff,
            'totalDepartment' => $totalDepartment,
            'totalPosition' => $totalPosition,
        ];

        $resultUsers = User::getStatusCounts();
       
        $statusMapping = [
            '-1' => 'Đã nghỉ việc',
            '1' => 'Đang làm việc',
        ];

        $data = [['Status', 'Number']];
        foreach($resultUsers as $item){
            $statusString = $statusMapping[$item->status] ?? 'Unknown';
            $data[]= [$statusString, $item->total];
        }
       
        
        
        $resultDepartments = DepartmentModel::getDepartmentCounts();
        $dataDepartment = [['Name', 'Number']];
        foreach($resultDepartments as $item){
            $dataDepartment[]= [$item->name, $item->total_users];
        }

        return view('admin.pages.dashboard', ['data' => $data, 'dataDepartment' => $dataDepartment,'user'=>$users])->with('datas',$datas);
    }

    public function export(){
        $users = User::all()->makeHidden(['status', 'password']);
        return Excel::download(new ExportExcel($users), 'nhanvien.xlsx');
        
    }
}

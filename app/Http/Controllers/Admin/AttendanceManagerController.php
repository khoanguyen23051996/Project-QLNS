<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttendanceModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceManagerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $attendances = AttendanceModel::whereMonth('created_at',  Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        return view('admin.pages.attendance_manager', ['attendances' => $attendances, 'user' => $user]);
    }

    public function search(Request $request)
    {
        
        $user = Auth()->user();

        $attendances = AttendanceModel::whereHas('user', function ($query) use ($request) {
            if (!empty($request->name)) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
        })->when(!empty($request->monthYear), function ($query) use ($request) {
            $monthYear = $request->monthYear;
            $parts = explode('-', $monthYear);
            $year = $parts[0];
            $month = $parts[1];
            $query->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year);
        })->get();
        return view('admin.pages.attendance_manager', ['user' => $user, 'attendances' => $attendances]);
    }
}

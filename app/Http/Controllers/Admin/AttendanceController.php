<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttendanceModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $attendance = AttendanceModel::where('user_id', Auth::id())->whereDate('created_at', Carbon::today())->first();
        $attendances = AttendanceModel::where('user_id', Auth::id())
                                        ->whereMonth('created_at', Carbon::now()->month)
                                        ->whereYear('created_at', Carbon::now()->year)
                                        ->get();
        return view('admin.pages.attendance',['user'=>$user, 'attendance'=>$attendance,'attendances'=>$attendances]);
    }

    public function store(){
        
    }

    public function checkin(Request $request){
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('admin.attendance.index')->with('error', 'Người dùng không tồn tại.');
        }
        $attendance = AttendanceModel::where('user_id', $userId)->whereDate('created_at', Carbon::today())->first();
        if($attendance)
        {
            return redirect()->route('admin.attendance.index')->with('error', 'Hôm nay bạn đã checkin rồi!!');
        }

        $checkin = new AttendanceModel();
        $result = $checkin->fill([
            'user_id' => $userId,
            'checkin_at' => now(),
        ])->save();

        $message = $result ? 'Checkin thành công' : 'Checkin thất bại';

        return redirect()->route('admin.attendance.index')->with('success', $message);
    }

    public function checkout(Request $request, $id){
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('admin.attendance.index')->with('error', 'Người dùng không tồn tại.');
        }

        $checkout = AttendanceModel::find($id);

        if (!$checkout) {
            return redirect()->route('admin.attendance.index')->with('error', 'Không tìm thấy bản ghi Checkout.');
        }

        $checkoutDatas = [
            'checkout_at' => now(),
        ];

        $result = $checkout->update($checkoutDatas);

        $message = $result ? 'Checkout thành công' : 'Checkout thất bại';

        return redirect()->route('admin.attendance.index')->with('success', $message);
    }

    public function search(Request $request){
        $monthYear = $request->monthYear;
        $parts = explode('-', $monthYear);
        $year = $parts[0];
        $month = $parts[1];

        $user = Auth::user();
        $attendance = AttendanceModel::where('user_id', Auth::id())->whereDate('created_at', Carbon::today())->first();
        $attendances = AttendanceModel::where('user_id', Auth::id())
                                        ->whereMonth('created_at',  $month)
                                        ->whereYear('created_at', $year)
                                        ->get();
        return view('admin.pages.attendance',['user'=>$user, 'attendance'=>$attendance,'attendances'=>$attendances]);
    }
}

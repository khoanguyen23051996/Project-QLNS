<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\SalariesController;
use App\Http\Middleware\AuthenticateMiddleware;


Route::get('/', function () {
    return view('welcome');
});

//Auth
Route::get('admin', [AuthController::class, 'index'])
->name('auth.admin')->middleware('login');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
//End Auth


Route::get('admin/dashboard', [DashboardController::class, 'index'])
->name('admin.dashboard.index')->middleware('authenticate');



//User
Route::get('admin/user', [UserController::class, 'index'])
->name('admin.user.index')->middleware(['authenticate', 'checkuser']);
Route::get('admin/user/create', [UserController::class, 'create'])
->name('admin.user.create')->middleware(['authenticate', 'checkuser']);
Route::get('admin/user/detail/{id}', [UserController::class, 'detail'])->name('admin.user.detail');
Route::post('admin/user/destroy/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
Route::post('admin/user/restore/{user}', [UserController::class, 'restore'])->name('admin.user.restore');
Route::post('admin/user/store', [UserController::class, 'store'])->name('admin.user.store');
Route::post('admin/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
Route::post('admin/user/change_status/{user}', [UserController::class, 'changeStatus'])->name('admin.user.change_status');
Route::post('admin/user', [UserController::class, 'search'])->name('admin.user.search');
//End User



Route::get('admin/staff', [StaffController::class, 'index'])
->name('admin.staff.index')->middleware('authenticate');
Route::get('admin/staff/create', [StaffController::class, 'create'])
->name('admin.staff.create')->middleware(['authenticate']);
Route::get('admin/staff/store', [StaffController::class, 'store'])
->name('admin.staff.store')->middleware(['authenticate']);

//Department
Route::get('admin/department', [DepartmentController::class, 'index'])
->name('admin.department.index')->middleware('authenticate');
Route::get('admin/department/create', [DepartmentController::class, 'create'])
->name('admin.department.create')->middleware('authenticate');
Route::post('admin/department/store', [DepartmentController::class, 'store'])
->name('admin.department.store')->middleware('authenticate');
Route::post('admin/department/destroy/{departmentid}', [DepartmentController::class, 'destroy'])
->name('admin.department.destroy')->middleware('authenticate');
Route::post('admin/department/restore/{id}', [DepartmentController::class, 'restore'])
->name('admin.department.restore')->middleware('authenticate');
Route::get('admin/department/detail/{departmentid}', [DepartmentController::class, 'detail'])
->name('admin.department.detail')->middleware('authenticate');
Route::post('admin/department/update/{departmentid}', [DepartmentController::class, 'update'])
->name('admin.department.update')->middleware('authenticate');
//End Department

Route::get('admin/attendance', [AttendanceController::class, 'index'])->name('admin.attendance');


Route::get('admin/salaries', [SalariesController::class, 'index'])->name('admin.salaries');


Route::get('admin/position', [PositionController::class, 'index'])
->name('admin.position.index')->middleware('authenticate');;
Route::get('admin/position/create', [PositionController::class, 'create'])
->name('admin.position.create')->middleware('authenticate');
Route::post('admin/position/store', [PositionController::class, 'store'])
->name('admin.position.store')->middleware('authenticate');
Route::post('admin/position/destroy/{id}', [PositionController::class, 'destroy'])
->name('admin.position.destroy')->middleware('authenticate');
Route::post('admin/position/restore/{id}', [PositionController::class, 'restore'])
->name('admin.position.restore')->middleware('authenticate');
Route::get('admin/position/detail/{id}', [PositionController::class, 'detail'])
->name('admin.position.detail')->middleware('authenticate');
Route::post('admin/position/update/{id}', [PositionController::class, 'update'])
->name('admin.position.update')->middleware('authenticate');
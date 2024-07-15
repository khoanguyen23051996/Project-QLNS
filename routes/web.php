<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\AttendanceManagerController;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});


//Auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::group(['middleware' => 'role.admin'], function () {
        Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        Route::get('admin/dashboard/export', [DashboardController::class, 'export'])->name('admin.dashboard.export');
        
        Route::prefix('admin/user')
        ->name('admin.user.')
        ->controller(UserController::class)
        ->group(function(){
            Route::get('create', 'create')->name('create');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('destroy/{user}', 'destroy')->name('destroy');
            Route::post('restore/{user}', 'restore')->name('restore');
            Route::post('store', 'store')->name('store');
            Route::post('update/{id}', 'update')->name('update');
            Route::post('change_status', 'changeStatus')->name('change_status');
        });
       
    });


    Route::group(['middleware' => 'role.admin.user'], function () {
        Route::get('admin/attendance', [AttendanceController::class, 'index'])->name('admin.attendance.index');
        Route::post('admin/attendance/checkin', [AttendanceController::class, 'checkin'])->name('admin.attendance.checkin');
        Route::post('admin/attendance/checkout/{id}', [AttendanceController::class, 'checkout'])->name('admin.attendance.checkout');
        Route::post('admin/attendance/search', [AttendanceController::class, 'search'])->name('admin.attendance.search');
    });

    
    
    Route::group(['middleware' => 'role.admin.hr'], function () {

        Route::get('admin/attendance-manager', [AttendanceManagerController::class, 'index'])->name('admin.attendance_manager.index');
        Route::post('admin/attendance-manager/search', [AttendanceManagerController::class, 'search'])->name('admin.attendance_manager.search');

        Route::prefix('admin/user')
        ->name('admin.user.')
        ->controller(UserController::class)
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'search')->name('search');
        });

        
         Route::prefix('admin/department')
         ->name('admin.department.')
         ->controller(DepartmentController::class)
         ->group(function(){
             Route::get('/', 'index')->name('index');
             Route::get('create', 'create')->name('create');
             Route::post('store', 'store')->name('store');
             Route::post('destroy/{departmentid}', 'destroy')->name('destroy');
             Route::post('restore/{id}', 'restore')->name('restore');
             Route::get('edit/{departmentid}', 'edit')->name('edit');
             Route::post('update/{departmentid}', 'update')->name('update');
         });
       

         Route::prefix('admin/position')
         ->name('admin.position.')
         ->controller(PositionController::class)
         ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::post('destroy/{id}', 'destroy')->name('destroy');
            Route::post('restore/{id}', 'restore')->name('restore');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::post('update/{positionid}', 'update')->name('update');
        });
    });
});



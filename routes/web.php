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


Route::group(['middleware' => 'guest'], function () {
    Route::get('admin', [AuthController::class, 'index'])->name('auth.admin');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});


//Auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::group(['middleware' => 'role.admin'], function () {
        Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
     
        Route::prefix('admin/user')
        ->name('admin.user.')
        ->controller(UserController::class)
        ->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('detail/{id}', 'detail')->name('detail');
            Route::post('destroy/{user}', 'destroy')->name('destroy');
            Route::post('restore/{user}', 'restore')->name('restore');
            Route::post('store', 'store')->name('store');
            Route::post('update/{id}', 'update')->name('update');
            Route::post('change_status/{user}', 'changeStatus')->name('change_status');
            Route::post('/', 'search')->name('search');
        });
       
    });


    Route::group(['middleware' => 'role.admin.user'], function () {
        Route::get('admin/attendance', [AttendanceController::class, 'index'])->name('admin.attendance.index');
    });
    
    Route::group(['middleware' => 'role.admin.hr'], function () {
      
         //Department
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
         //End Department

         Route::prefix('admin/position')->name('admin.position.')->controller(PositionController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::post('destroy/{id}', 'destroy')->name('destroy');
            Route::post('restore/{id}', 'restore')->name('restore');
            Route::get('detail/{id}', 'detail')->name('detail');
            Route::post('update/{positionid}', 'update')->name('update');
        });
    });

    
    


    //User
   
    //End User



    Route::get('admin/staff', [StaffController::class, 'index'])
    ->name('admin.staff.index');
    Route::get('admin/staff/create', [StaffController::class, 'create'])
    ->name('admin.staff.create');
    Route::get('admin/staff/store', [StaffController::class, 'store'])
    ->name('admin.staff.store');


    Route::get('admin/salaries', [SalariesController::class, 'index'])->name('admin.salaries');

});
//End Auth


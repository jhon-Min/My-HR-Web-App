<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HeadOfDepController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('/employee', EmployeeController::class);
    Route::get('/employee/datatable/ssd', [EmployeeController::class, 'ssd'])->name('employee.ssd');

    Route::resource('/department', DepartmentController::class);
    Route::get('/department/datatable/ssd', [DepartmentController::class, 'ssd'])->name('department.ssd');

    Route::resource('/head-of-department', HeadOfDepController::class);
    Route::get('/head-of-department-table/ssd', [HeadOfDepController::class, 'ssd'])->name('head-dep.ssd');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update-profile');
});

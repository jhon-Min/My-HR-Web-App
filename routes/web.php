<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CheckInOutController;
use App\Http\Controllers\CompanyInfoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HeadOfDepController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyAttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalaryController;

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

Route::get('/check-in-out', [CheckInOutController::class, 'index'])->name('check.index');
Route::post('check-process', [CheckInOutController::class, 'store'])->name('check.store');

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

    Route::resource('/role', RoleController::class);
    Route::get('/role/datatable/ssd', [RoleController::class, 'ssd'])->name('role.ssd');

    Route::resource('/permission', PermissionController::class);
    Route::get('/permission/datatable/ssd', [PermissionController::class, 'ssd'])->name('permission.ssd');

    Route::resource('/salary', SalaryController::class)->except('show');
    Route::get('/salary/datatable/ssd', [SalaryController::class, 'ssd'])->name('salary.ssd');

    Route::resource('/company-info', CompanyInfoController::class)->only(['show', 'edit', 'update']);

    // Attendance and Payroll
    Route::resource('/attendance', AttendanceController::class);
    Route::get('/attendance/datatable/ssd', [AttendanceController::class, 'ssd'])->name('attendance.ssd');
    Route::get('/attendance-report', [AttendanceController::class, 'report'])->name('attendance.report');
    Route::get('/attendance-report-table', [AttendanceController::class, 'reportTable'])->name('attendance.report-table');

    // My Attendance and Payroll
    Route::get('/my-attendance/scan', [MyAttendanceController::class, 'scanQr'])->name('my-attendance.scanQr');
    Route::post('/my-attendance/store-qr', [MyAttendanceController::class, 'storeQr'])->name('my-attendance.storeQr');
    Route::get('/my-attendance/datatable/ssd', [MyAttendanceController::class, 'ssd'])->name('my-attendance.ssd');

});

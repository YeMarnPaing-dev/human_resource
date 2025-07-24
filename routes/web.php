<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CheckInOutController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CompanySettingController;
use Laragear\WebAuthn\Http\Routes as WebAuthnRoutes;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;


Route::get('/', function () {
    return view('register.login');
});

// WebAuthn Routes
WebAuthnRoutes::register()->withoutMiddleware(VerifyCsrfToken::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

WebAuthnRoutes::register(
    attest: 'auth/register',
    assert: 'auth/login'
)->withoutMiddleware(VerifyCsrfToken::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin#dashboard');
Route::get('profile',[EmployeeController::class,'profile'])->name('admin#profile');



Route::resource('employeeManangement', EmployeeController::class);
Route::resource('departmentManangement', DepartmentController::class);
Route::resource('roleManangement', RoleController::class);
Route::resource('permissionManangement', PermissionController::class);
Route::resource('companySetting', CompanySettingController::class)->only(['edit','update','show']);

Route::resource('attendance', AttendanceController::class);
Route::get('attendance-overview',[AttendanceController::class,'overview'])->name('attendance.overview');
Route::get('attendance-overview-table',[AttendanceController::class,'overviewTable'])->name('attendance.overview-table');

});

Route::get('checkin-checkout',[CheckInOutController::class,'checkInOut']);
Route::post('checkin',[CheckInOutController::class,'checkIn']);


require __DIR__.'/auth.php';



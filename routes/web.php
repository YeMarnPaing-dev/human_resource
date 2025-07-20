<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CompanySettingController;

Route::get('/', function () {
    return view('register.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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



});

require __DIR__.'/auth.php';



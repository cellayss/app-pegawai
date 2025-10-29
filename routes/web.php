<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\AttendanceController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('employees', EmployeeController::class);
Route::resource('departemens', DepartemenController::class);
Route::resource('positions', JabatanController::class);
Route::resource('salaries', SalaryController::class);
Route::resource('attendances', AttendanceController::class);
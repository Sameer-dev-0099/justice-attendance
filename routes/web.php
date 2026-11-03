<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

Route::resource('employees', EmployeeController::class);

Route::get('/attendance', [AttendanceController::class, 'index'])
    ->name('attendance.index');

Route::post('/attendance/{employee}/check-in', [AttendanceController::class, 'checkIn'])
    ->name('attendance.check-in');

Route::post('/attendance/{employee}/check-out', [AttendanceController::class, 'checkOut'])
    ->name('attendance.check-out');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveRequestController;

Route::resource('employees', EmployeeController::class);

// Attendance Routes
Route::get('/attendance', [AttendanceController::class, 'index'])
    ->name('attendance.index');

Route::post('/attendance/{employee}/check-in', [AttendanceController::class, 'checkIn'])
    ->name('attendance.check-in');

Route::post('/attendance/{employee}/check-out', [AttendanceController::class, 'checkOut'])
    ->name('attendance.check-out');

Route::get('/attendance/export', [AttendanceController::class, 'exportMonthly'])
    ->name('attendance.export');

// Leave Request Routes
Route::get('/leave-requests/create', [LeaveRequestController::class, 'create'])
    ->name('leave-requests.create');

Route::post('/leave-requests', [LeaveRequestController::class, 'store'])
    ->name('leave-requests.store');

Route::get('/leave-requests', [LeaveRequestController::class, 'index'])
    ->name('leave-requests.index');

Route::post('/leave-requests/{leaveRequest}/approve', [LeaveRequestController::class, 'approve'])
    ->name('leave-requests.approve');

Route::post('/leave-requests/{leaveRequest}/reject', [LeaveRequestController::class, 'reject'])
    ->name('leave-requests.reject');

Route::get('/employees/{employee}/leave-history', [LeaveRequestController::class, 'history'])
    ->name('leave-requests.history');

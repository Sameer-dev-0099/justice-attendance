<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $employees = Employee::with([
            'attendances' => function ($query) use ($today) {
                $query->whereDate('date', $today);
            }
        ])->get();

        return view('attendance.index', compact('employees'));
    }

    
public function checkIn(Employee $employee)
{
    $today = Carbon::today();

    $attendance = Attendance::where('employee_id', $employee->id)
        ->whereDate('date', $today)
        ->first();

    if ($attendance && $attendance->check_in_at !== null) {
        return redirect()->route('attendance.index')
            ->with('error', 'Employee has already checked in today.');
    }

    if (!$attendance) {
        Attendance::create([
            'employee_id' => $employee->id,
            'date' => $today,
            'check_in_at' => now(),
        ]);
    } else {
        $attendance->update(['check_in_at' => now()]);
    }

    return redirect()->route('attendance.index')
        ->with('success', 'Check-in recorded successfully.');
}


    public function checkOut(Employee $employee)
    {
        $today = Carbon::today();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->whereDate('date', $today)
            ->first();

        if (!$attendance || !$attendance->check_in_at) {
            return redirect()->route('attendance.index')
                ->with('error', 'Please check in before checking out.');
        }

        if ($attendance->check_out_at !== null) {
            return redirect()->route('attendance.index')
                ->with('error', 'Employee has already checked out today.');
        }

        $attendance->update(['check_out_at' => now()]);

        return redirect()->route('attendance.index')
            ->with('success', 'Check-out recorded successfully.');
    }
}

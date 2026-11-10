<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Http\Requests\StoreLeaveRequest;

class LeaveRequestController extends Controller
{
    // Employee leave request form
    public function create()
    {
        $employees = Employee::all();

        return view('leave-requests.create', compact('employees'));
    }

    // Store leave request
    public function store(StoreLeaveRequest $request)
    {
        $data = $request->validated();

        LeaveRequest::create($data);

        return redirect()->route('leave-requests.create')
            ->with('success', 'Leave request submitted successfully.');
    }

    // Admin pending requests
    public function index()
    {
        $leaveRequests = LeaveRequest::with('employee')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('leave-requests.index', compact('leaveRequests'));
    }

    // Approve request
    public function approve(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'Leave request approved.');
    }

    // Reject request
    public function reject(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Leave request rejected.');
    }

    // Employee leave history
    public function history(Employee $employee)
    {
        $leaveRequests = $employee->leaveRequests()
            ->latest()
            ->get();

        return view('leave-requests.history', compact('leaveRequests', 'employee'));
    }
}

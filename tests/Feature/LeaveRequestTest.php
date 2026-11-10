<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeaveRequestTest extends TestCase
{
    use RefreshDatabase;

    private function createEmployee(): Employee
    {
        $department = Department::create([
            'name' => 'Legal',
        ]);

        return Employee::create([
            'name' => 'Test Employee',
            'email' => 'test@example.com',
            'department_id' => $department->id,
        ]);
    }

    public function test_employee_can_submit_leave_request(): void
    {
        $employee = $this->createEmployee();

        $response = $this->post(route('leave-requests.store'), [
            'employee_id' => $employee->id,
            'start_date' => now()->addDays(2)->toDateString(),
            'end_date' => now()->addDays(4)->toDateString(),
            'reason' => 'Personal family matters.',
        ]);

        $response->assertRedirect(route('leave-requests.create'));

        $this->assertDatabaseHas('leave_requests', [
            'employee_id' => $employee->id,
            'status' => 'pending',
        ]);
    }

    public function test_invalid_leave_request_is_rejected(): void
    {
        $response = $this->post(route('leave-requests.store'), [
            'employee_id' => 9999,
            'start_date' => now()->subDays(2)->toDateString(),
            'end_date' => now()->subDays(3)->toDateString(),
            'reason' => '',
        ]);

        $response->assertSessionHasErrors([
            'employee_id',
            'start_date',
            'end_date',
            'reason',
        ]);
    }

    public function test_admin_can_approve_leave_request(): void
    {
        $employee = $this->createEmployee();

        $leave = LeaveRequest::create([
            'employee_id' => $employee->id,
            'start_date' => now()->addDays(2)->toDateString(),
            'end_date' => now()->addDays(3)->toDateString(),
            'reason' => 'Personal family matters.',
            'status' => 'pending',
        ]);

        $response = $this->post(
            route('leave-requests.approve', $leave)
        );

        $response->assertRedirect();

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leave->id,
            'status' => 'approved',
        ]);
    }

    public function test_admin_can_reject_leave_request(): void
    {
        $employee = $this->createEmployee();

        $leave = LeaveRequest::create([
            'employee_id' => $employee->id,
            'start_date' => now()->addDays(2)->toDateString(),
            'end_date' => now()->addDays(3)->toDateString(),
            'reason' => 'Personal family matters.',
            'status' => 'pending',
        ]);

        $response = $this->post(
            route('leave-requests.reject', $leave)
        );

        $response->assertRedirect();

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leave->id,
            'status' => 'rejected',
        ]);
    }

    public function test_employee_can_view_approved_leave_history(): void
    {
        $employee = $this->createEmployee();

        $leave = LeaveRequest::create([
            'employee_id' => $employee->id,
            'start_date' => now()->addDays(2)->toDateString(),
            'end_date' => now()->addDays(3)->toDateString(),
            'reason' => 'Personal family matters.',
            'status' => 'approved',
        ]);

        $response = $this->get(
            route('leave-requests.history', $employee)
        );

        $response->assertOk();
        $response->assertSee('Personal family matters.');
        $response->assertSee('Approved');
    }
}

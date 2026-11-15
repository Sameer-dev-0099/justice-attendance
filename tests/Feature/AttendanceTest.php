<?php

namespace Tests\Feature;

use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    private function createEmployee(): Employee
    {
        $department = Department::create([
            'name' => 'Legal Department',
        ]);

        return Employee::create([
            'name' => 'Test Employee',
            'email' => 'test@example.com',
            'department_id' => $department->id,
        ]);
    }

    public function test_attendance_page_loads(): void
    {
        $this->createEmployee();

        $response = $this->get(route('attendance.index'));

        $response->assertStatus(200);
        $response->assertSee('Today\'s Attendance', false);
    }

    public function test_employee_can_check_in(): void
    {
        $employee = $this->createEmployee();

        $response = $this->post(
            route('attendance.check-in', $employee)
        );

        $response->assertRedirect(route('attendance.index'));

        $this->assertDatabaseHas('attendances', [
            'employee_id' => $employee->id,
            'date' => now()->toDateString() . ' 00:00:00',
        ]);
    }

    public function test_employee_can_check_out(): void
    {
        $employee = $this->createEmployee();

        $this->post(route('attendance.check-in', $employee));

        $response = $this->post(
            route('attendance.check-out', $employee)
        );

        $response->assertRedirect(route('attendance.index'));

        $this->assertNotNull(
            Attendance::first()->check_out_at
        );
    }

    public function test_duplicate_check_in_is_prevented(): void
    {
        $employee = $this->createEmployee();

        $this->post(route('attendance.check-in', $employee));

        $this->post(route('attendance.check-in', $employee))
            ->assertSessionHas('error');

        $this->assertDatabaseCount('attendances', 1);
    }

    public function test_duplicate_check_out_is_prevented(): void
    {
        $employee = $this->createEmployee();

        $this->post(route('attendance.check-in', $employee));

        $this->post(route('attendance.check-out', $employee));

        $this->post(route('attendance.check-out', $employee))
            ->assertSessionHas('error');

        $this->assertDatabaseCount('attendances', 1);
    }

    public function test_check_out_before_check_in_is_prevented(): void
    {
        $employee = $this->createEmployee();

        $this->post(route('attendance.check-out', $employee))
            ->assertSessionHas('error');

        $this->assertDatabaseCount('attendances', 0);
    }


public function test_monthly_attendance_csv_can_be_downloaded(): void
{
    $response = $this->get(route('attendance.export', [
        'month' => '2026-11',
    ]));

    $response->assertOk();
    $response->assertDownload('attendance-2026-11.csv');
}

public function test_monthly_csv_contains_employee_attendance_data(): void
{
    $employee = $this->createEmployee();

    Attendance::create([
        'employee_id' => $employee->id,
        'date' => '2026-11-10',
        'check_in_at' => '2026-11-10 09:00:00',
        'check_out_at' => '2026-11-10 17:00:00',
    ]);

    $response = $this->get(route('attendance.export', [
        'month' => '2026-11',
    ]));

    $response->assertOk();

    $content = $response->streamedContent();

    $this->assertStringContainsString('Employee Name', $content);
    $this->assertStringContainsString('Check In', $content);
    $this->assertStringContainsString('Test Employee', $content);
    $this->assertStringContainsString('09:00:00', $content);
    $this->assertStringContainsString('17:00:00', $content);
}

public function test_monthly_csv_excludes_other_month_records(): void
{
    $employee = $this->createEmployee();

    Attendance::create([
        'employee_id' => $employee->id,
        'date' => '2026-11-10',
        'check_in_at' => '2026-11-10 09:00:00',
    ]);

    Attendance::create([
        'employee_id' => $employee->id,
        'date' => '2026-10-10',
        'check_in_at' => '2026-10-10 09:00:00',
    ]);

    $response = $this->get(route('attendance.export', [
        'month' => '2026-11',
    ]));

    $response->assertOk();

    $content = $response->streamedContent();

    $this->assertStringContainsString('2026-11-10', $content);
    $this->assertStringNotContainsString('2026-10-10', $content);
}

}

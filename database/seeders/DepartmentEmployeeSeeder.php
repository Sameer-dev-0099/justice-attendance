<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Employee;

class DepartmentEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $legal = Department::firstOrCreate(['name' => 'Legal']);
        $hr = Department::firstOrCreate(['name' => 'Human Resources']);
        $admin = Department::firstOrCreate(['name' => 'Administration']);

        Employee::firstOrCreate(
            ['email' => 'ali@justiceco.com'],
            ['name' => 'Ali Ahmed', 'department_id' => $legal->id]
        );

        Employee::firstOrCreate(
            ['email' => 'sara@justiceco.com'],
            ['name' => 'Sara Khan', 'department_id' => $hr->id]
        );

        Employee::firstOrCreate(
            ['email' => 'usman@justiceco.com'],
            ['name' => 'Usman Malik', 'department_id' => $legal->id]
        );

        Employee::firstOrCreate(
            ['email' => 'ayesha@justiceco.com'],
            ['name' => 'Ayesha Noor', 'department_id' => $admin->id]
        );

        Employee::firstOrCreate(
            ['email' => 'hamza@justiceco.com'],
            ['name' => 'Hamza Tariq', 'department_id' => $hr->id]
        );
    }
}

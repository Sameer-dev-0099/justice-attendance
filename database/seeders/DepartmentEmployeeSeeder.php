<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Employee;

class DepartmentEmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $legal = Department::create(['name' => 'Legal']);
        $hr = Department::create(['name' => 'Human Resources']);
        $admin = Department::create(['name' => 'Administration']);

        Employee::create([
            'name' => 'Ali Ahmed',
            'email' => 'ali@justiceco.com',
            'department_id' => $legal->id,
        ]);

        Employee::create([
            'name' => 'Sara Khan',
            'email' => 'sara@justiceco.com',
            'department_id' => $hr->id,
        ]);

        Employee::create([
            'name' => 'Usman Malik',
            'email' => 'usman@justiceco.com',
            'department_id' => $legal->id,
        ]);

        Employee::create([
            'name' => 'Ayesha Noor',
            'email' => 'ayesha@justiceco.com',
            'department_id' => $admin->id,
        ]);

        Employee::create([
            'name' => 'Hamza Tariq',
            'email' => 'hamza@justiceco.com',
            'department_id' => $hr->id,
        ]);
    }
}
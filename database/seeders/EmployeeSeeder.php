<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Organization;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $organizations = Organization::all();

        $data = [
            ['name' => 'John Doe', 'email' => 'john.doe@example.com', 'phone' => '123-456-7890', 'position' => 'Phlebotomist', 'status' => 'active'],
            ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com', 'phone' => '123-555-7891', 'position' => 'Nurse', 'status' => 'active'],
            ['name' => 'Robert Brown', 'email' => 'robert.brown@example.com', 'phone' => '123-555-7892', 'position' => 'Physician', 'status' => 'active'],
            ['name' => 'Emily Johnson', 'email' => 'emily.johnson@example.com', 'phone' => '123-555-7893', 'position' => 'Therapist', 'status' => 'active'],
            ['name' => 'Michael Clark', 'email' => 'michael.clark@example.com', 'phone' => '123-555-7894', 'position' => 'Respiratory Specialist', 'status' => 'inactive'],
            ['name' => 'Olivia Davis', 'email' => 'olivia.davis@example.com', 'phone' => '123-555-7895', 'position' => 'Physical Therapist', 'status' => 'active'],
            ['name' => 'Daniel Lewis', 'email' => 'daniel.lewis@example.com', 'phone' => '123-555-7896', 'position' => 'Oxygen Specialist', 'status' => 'inactive'],
            ['name' => 'Sophia Wilson', 'email' => 'sophia.wilson@example.com', 'phone' => '123-555-7897', 'position' => 'Nurse Practitioner', 'status' => 'active'],
            ['name' => 'William Moore', 'email' => 'william.moore@example.com', 'phone' => '123-555-7898', 'position' => 'Lab Technician', 'status' => 'active'],
            ['name' => 'Ava Martinez', 'email' => 'ava.martinez@example.com', 'phone' => '123-555-7899', 'position' => 'Medical Assistant', 'status' => 'inactive'],
        ];

        foreach ($data as $index => $item) {
            $organization = $organizations[$index % $organizations->count()];
            Employee::create(array_merge($item, [
                'organization_id' => $organization->id,
            ]));
        }
    }
}

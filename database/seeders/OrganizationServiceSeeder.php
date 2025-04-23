<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;
use App\Models\Service;
use App\Models\Employee;
use App\Models\OrganizationService;

class OrganizationServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::all();

        $organizations = Organization::with('employees')->get(); // Eager load employees

        foreach ($organizations as $organization) {
            $orgEmployees = $organization->employees;

            // Skip organizations without employees
            if ($orgEmployees->isEmpty()) {
                continue;
            }

            foreach ($services as $service) {
                // Random employee from this organization
                $employee = $orgEmployees->random();

                OrganizationService::create([
                    'organization_id' => $organization->id,
                    'service_id' => $service->id,
                    'employee_id' => $employee->id,
                    'price' => rand(20, 50),
                ]);
            }
        }
    }
}

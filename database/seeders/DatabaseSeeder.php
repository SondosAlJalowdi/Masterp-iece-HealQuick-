<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(ServiceSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(OrganizationServiceSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call([
            OrganizationDescriptionsSeeder::class,
        ]);
    }
}

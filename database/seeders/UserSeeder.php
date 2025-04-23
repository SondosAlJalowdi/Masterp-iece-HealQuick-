<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@healquick.com',
            'phone_number' => '0001112222',
            'address' => 'Admin HQ',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Sample Patients
        $patients = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone_number' => '1112223333',
                'address' => '123 Main St',
                'password' => Hash::make('password'),
                'role' => 'patient',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone_number' => '4445556666',
                'address' => '456 Elm St',
                'password' => Hash::make('password'),
                'role' => 'patient',
            ],
            [
                'name' => 'Ali Ahmad',
                'email' => 'ali.ahmad@example.com',
                'phone_number' => '7778889999',
                'address' => '789 Oak St',
                'password' => Hash::make('password'),
                'role' => 'patient',
            ],
        ];

        foreach ($patients as $patient) {
            User::create($patient);
        }
    }
}

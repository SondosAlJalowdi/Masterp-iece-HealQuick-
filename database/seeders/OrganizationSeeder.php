<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $organizations = [
            [
                'name' => 'Health First Clinic',
                'email' => 'contact@healthfirst.com',
                'phone' => '1234567890',
                'address' => '123 Wellness Ave',
                'logo' => 'images/logos/healthfirst.jpeg'
            ],
            [
                'name' => 'MediCare Pro',
                'email' => 'info@medicarepro.com',
                'phone' => '9876543210',
                'address' => '456 Care Street',
                'logo' => 'images/logos/medicarepro.jpg'
            ],
            [
                'name' => 'Sunshine Hospital',
                'email' => 'support@sunshinehospital.com',
                'phone' => '1122334455',
                'address' => '789 Bright St.',
                'logo' => 'images/logos/sunshinehospital.jpg'
            ],
            [
                'name' => 'Wellness Center',
                'email' => 'contact@wellnesscenter.com',
                'phone' => '2233445566',
                'address' => '101 Health Blvd',
                'logo' => 'images/logos/wellnesscenter.jpg'
            ],
            [
                'name' => 'Vitality Medical Group',
                'email' => 'info@vitalitymed.com',
                'phone' => '3344556677',
                'address' => '202 Vital St.',
                'logo' => 'images/logos/vitalitymed.jpg'
            ],
            [
                'name' => 'CarePlus Clinic',
                'email' => 'info@careplusclinic.com',
                'phone' => '5566778899',
                'address' => '303 Health Ave',
                'logo' => 'images/logos/careplusclinic.jpg'
            ],
            [
                'name' => 'Advanced Medical Solutions',
                'email' => 'contact@amsolutions.com',
                'phone' => '6677889900',
                'address' => '404 MedCare Rd.',
                'logo' => 'images/logos/amsolutions.png'
            ],
            [
                'name' => 'Prime Healthcare',
                'email' => 'support@primehealthcare.com',
                'phone' => '7788990011',
                'address' => '505 Health St.',
                'logo' => 'images/logos/primehealthcare.png'
            ],
            [
                'name' => 'Healthy Life Medical Center',
                'email' => 'contact@healthylifemc.com',
                'phone' => '8899001122',
                'address' => '606 LifeCare Ln',
                'logo' => 'images/logos/healthylifemc.png'
            ],
            [
                'name' => 'MedCare Professionals',
                'email' => 'info@medcareprofessionals.com',
                'phone' => '9900112233',
                'address' => '707 MedCare Blvd',
                'logo' => 'images/logos/medcareprofessionals.jpg'
            ],
        ];

        foreach ($organizations as $org) {
            $user = User::create([
                'name' => $org['name'],
                'email' => $org['email'],
                'phone_number' => $org['phone'],
                'address' => $org['address'],
                'password' => Hash::make('password'), // Default password
                'role' => 'organization_admin',
            ]);

            Organization::create([
                'user_id' => $user->id,
                'name' => $org['name'],
                'email' => $org['email'],
                'phone' => $org['phone'],
                'address' => $org['address'],
                'logo' => $org['logo'],
            ]);
        }
    }
}

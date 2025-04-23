<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Blood Draws',
                'description' => 'We provide professional blood draw services in the comfort of your home, with minimal discomfort.',
                'image' => 'images/s7.png',
            ],
            [
                'name' => 'Injections',
                'description' => 'Get your prescribed injections administered by our certified professionals, wherever you are.',
                'image' => 'images/s5.png',
            ],
            [
                'name' => 'Oxygen Therapy',
                'description' => 'Our oxygen implementation service ensures you get the respiratory support you need, directly at home.',
                'image' => 'images/s9.png',
            ],
            [
                'name' => 'Physical Therapy',
                'description' => 'Receive tailored physical therapy services at home, helping you recover and regain mobility efficiently.',
                'image' => 'images/s11.png',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Service;
use App\Models\Organization;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $services = Service::all();
        $organizations = Organization::all();

        // Make sure we have data to work with
        if ($users->isEmpty() || $services->isEmpty() || $organizations->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            // Each user creates 2 reviews randomly
            for ($i = 0; $i < 2; $i++) {
                $service = $services->random();
                $organization = $organizations->random();

                Review::create([
                    'user_id' => $user->id,
                    'service_id' => $service->id,
                    'organization_id' => $organization->id,
                    'rating' => rand(1, 5),
                    'comment' => Str::random(50),
                ]);
            }
        }
    }
}

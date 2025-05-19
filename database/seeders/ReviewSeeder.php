<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Service;
use App\Models\Organization;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Get only patients
        $patients = User::where('role', 'patient')->get();

        if ($patients->isEmpty()) {
            return;
        }

        // Clear existing reviews if needed
        // Review::truncate(); // Uncomment if you want to delete old reviews
        Review::truncate();

        foreach ($patients as $patient) {
            // Get services the patient has booked
            $bookings = Booking::where('user_id', $patient->id)->get();

            // Group by service_id + organization_id pair to avoid duplicate reviews
            $uniqueBookings = $bookings->unique(fn($b) => $b->service_id . '-' . $b->organization_id);

            foreach ($uniqueBookings->take(3) as $booking) { // max 3 reviews per patient
                if (!$booking->service || !$booking->organization) continue;

                Review::create([
                    'user_id' => $patient->id,
                    'service_id' => $booking->service_id,
                    'organization_id' => $booking->organization_id,
                    'rating' => rand(3, 5), // Mostly positive for realism
                    'comment' => $this->generateMeaningfulComment(),
                ]);
            }
        }
    }

    private function generateMeaningfulComment(): string
    {
        $comments = [
            "Excellent service and friendly staff!",
            "Very professional and helpful team.",
            "I'm satisfied with the care I received.",
            "Quick response and quality treatment.",
            "Great experience from start to finish.",
            "The medical team was very attentive.",
            "Highly recommend this organization.",
            "Clean facilities and timely service.",
            "Doctors were kind and explained well.",
            "Would definitely return if needed."
        ];

        return $comments[array_rand($comments)];
    }
}

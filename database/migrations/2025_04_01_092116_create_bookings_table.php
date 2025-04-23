<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('organization_id')->constrained()->onDelete('cascade'); // Link to organization
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // Link to service
            $table->foreignId('employee_id')->constrained()->onDelete('cascade'); // Link to employee performing the service
            $table->date('booking_date');
            $table->enum('status', ['booked', 'completed', 'canceled'])->default('booked');
            $table->decimal('price', 8, 2);
            $table->time('booking_time')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

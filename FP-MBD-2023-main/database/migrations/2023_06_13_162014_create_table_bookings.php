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
            $table->date('booking_date')->nullable();
            $table->boolean('booking_closed')->nullable();
            $table->integer('booking_amount')->nullable();
            $table->biginteger('client_id')->nullable();
            $table->biginteger('rental_id')->nullable();
            $table->biginteger('vehicle_id')->nullable();
            $table->biginteger('feedback_id')->nullable();
            $table->bigInteger('payment_id')->nullable();
            $table->integer('fine')->nullable();
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

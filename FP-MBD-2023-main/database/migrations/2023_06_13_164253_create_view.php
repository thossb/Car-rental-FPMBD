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
        DB::unprepared('
        DROP VIEW IF EXISTS list_bookings;
        CREATE VIEW list_bookings AS
        SELECT bookings.*,
        rental.start_time,rental.end_time,rental.delivery_add,rental.pickup_address,
        vehicle.plate_number,vehicle.name, vehicle.type, vehicle.capacities, vehicle.rent_price, vehicle.driver_price, vehicle.registration, vehicle.image 
        FROM bookings
        INNER JOIN rental ON bookings.rental_id = rental.id 
        INNER JOIN vehicle ON bookings.vehicle_id = vehicle.id
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('
        DROP VIEW IF EXISTS list_bookings;
        ');
    }
};

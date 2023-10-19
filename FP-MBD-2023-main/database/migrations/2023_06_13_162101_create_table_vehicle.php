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
        Schema::create('vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number')->nullable();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->integer('capacities')->nullable();
            $table->double('rent_price')->nullable();
            $table->double('driver_price')->nullable();
            $table->text('registration')->nullable();
            $table->text('branch_id')->nullable();
            $table->text('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle');
    }
};

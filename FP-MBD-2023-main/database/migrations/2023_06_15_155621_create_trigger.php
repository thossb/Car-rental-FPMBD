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
        DROP TRIGGER IF EXISTS update_branch;
        CREATE TRIGGER update_branch
        AFTER DELETE ON branch FOR EACH ROW
        
        UPDATE vehicle
        SET vehicle.branch_id = NULL    
        WHERE vehicle.branch_id = old.id;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('
        DROP procedure IF EXISTS get_driver;
        ');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();  // e.g., "Pending", "Confirmed", "Cancelled"
        });

        // Optional: Insert some default statuses
        DB::table('booking_statuses')->insert([
            ['name' => 'Pending'],
            ['name' => 'Confirmed'],
            ['name' => 'Cancelled'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_statuses');
    }
};

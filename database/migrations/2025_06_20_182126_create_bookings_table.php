<?php

use App\Models\BookingStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('client_id');
            $table->foreignId('service_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->foreignId('booking_status_id')
                ->constrained()
                ->on('booking_statuses')
                ->default(BookingStatus::PENDING);            $table->boolean('paid')->nullable()->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};

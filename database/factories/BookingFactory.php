<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now(),
            'status' => $this->faker->randomNumber(),
            'paid' => $this->faker->boolean(),
            'notes' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
            'client_id' => Client::factory(),
            'service_id' => Service::factory(),
        ];
    }
}

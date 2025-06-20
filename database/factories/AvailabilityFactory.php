<?php

namespace Database\Factories;

use App\Models\Availability;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AvailabilityFactory extends Factory
{
    protected $model = Availability::class;

    public function definition()
    {
        return [
            'day_of_week' => $this->faker->randomNumber(),
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now(),
            'is_active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}

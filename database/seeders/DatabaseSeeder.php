<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Availability;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create a test barber
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
        ]);

        // Create 3 services
        $services = [
            ['name' => 'Basic Cut', 'duration' => 30, 'price' => 20],
            ['name' => 'Fade + Beard', 'duration' => 45, 'price' => 35],
            ['name' => 'Deluxe Package', 'duration' => 60, 'price' => 50],
        ];

        foreach ($services as $service) {
            Service::create([
                'user_id' => $user->id,
                ...$service
            ]);
        }

        // Create availability for Mon–Sat 9am–5pm
        foreach ([1, 2, 3, 4, 5, 6] as $dayOfWeek) {
            Availability::create([
                'user_id'    => $user->id,
                'day_of_week'=> $dayOfWeek,
                'start_time' => Carbon::createFromTime(9, 0, 0),
                'end_time'   => Carbon::createFromTime(17, 0, 0),
                'is_active'  => true,
            ]);
        }

        // Create clients
        $clients = [
            ['name' => 'Alice Johnson', 'phone' => '555-1111', 'email' => 'alice@example.com'],
            ['name' => 'Bob Smith', 'phone' => '555-2222', 'email' => 'bob@example.com'],
            ['name' => 'Charlie Lee', 'phone' => '555-3333', 'email' => 'charlie@example.com'],
        ];

        foreach ($clients as $clientData) {
            Client::create([
                'user_id' => $user->id,
                ...$clientData
            ]);
        }

        // Create bookings (use created clients/services)
        $service = Service::where('name', 'Basic Cut')->first();
        $clients = Client::all();

        foreach ($clients as $index => $client) {
            $start = Carbon::today()->addDays($index)->setTime(10 + $index, 0); // e.g. 10:00, 11:00, 12:00
            Booking::create([
                'user_id'     => $user->id,
                'client_id'   => $client->id,
                'service_id'  => $service->id,
                'start_time'  => $start,
                'end_time'    => $start->copy()->addMinutes($service->duration),
                'status'      => 'booked',
                'paid'        => false,
                'notes'       => null,
            ]);
        }
    }
}

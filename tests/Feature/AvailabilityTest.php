<?php

use App\Models\User;
use App\Models\Availability;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

uses(RefreshDatabase::class);

// Helper to create and authenticate a user
function actingAsUser($test)
{
    $user = User::factory()->create();
    $test->actingAs($user);
    return $user;
}

it('shows the availability index page', function () {
    $user = actingAsUser($this);

    $response = $this->get(route('availability'));

    $response->assertInertia(fn (Assert $page) =>
    $page->component('Availability/Index')
        ->has('availability')
        ->where('title', 'Availability')
    );
});

it('stores new availability and redirects', function () {
    $user = actingAsUser($this);

    $data = [
        'day_of_week' => 1,
        'start_time' => '2025-06-20 09:00',
        'end_time' => '2025-06-20 17:00',
        'user_id' => $user->id,
        'is_active' => true,
    ];

    $response = $this->post(route('availability.store'), $data);

    $response->assertRedirect(route('availability.index'));
    $response->assertSessionHas('success', 'Availability created successfully.');

    $availability = Availability::first();
    expect($availability)->not()->toBeNull();
    expect($availability->day_of_week)->toBe(1);
    expect($availability->start_time->format('H:i:s'))->toBe('09:00:00');
    expect($availability->end_time->format('H:i:s'))->toBe('17:00:00');
    expect($availability->user_id)->toBe($user->id);
});

it('shows a single availability', function () {
    $user = actingAsUser();
    $availability = Availability::factory()->create(['user_id' => $user->id]);

    $response = $this->getJson(route('availability.show', $availability));

    $response->assertOk()
        ->assertJson([
            'data' => [
                'id' => $availability->id,
            ]
        ]);
});

it('updates availability', function () {
    $user = actingAsUser($this);
    $availability = Availability::factory()->create(['user_id' => $user->id]);

    $data = [
        'day_of_week' => 3,
        'start_time' => '2025-06-20 10:00',
        'end_time' => '2025-06-20 18:00',
    ];

    $response = $this->postJson(route('availability.update', $availability), $data);

    $response->assertRedirect(route('availability'));

    $availability->refresh();

    expect($availability->day_of_week)->toBe(3);
    expect($availability->start_time->format('H:i:s'))->toBe('10:00:00');
    expect($availability->end_time->format('H:i:s'))->toBe('18:00:00');
});

it('deletes availability', function () {
    $user = actingAsUser($this); // Assuming this helper authenticates the user
    $availability = Availability::factory()->create(['user_id' => $user->id]);

    $response = $this->delete(route('availability.destroy', $availability));

    $response->assertRedirect(route('availability.index'));
    $this->assertDatabaseMissing('availabilities', ['id' => $availability->id]);
});

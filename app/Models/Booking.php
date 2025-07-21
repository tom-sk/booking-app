<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends BaseModel
{
    use HasFactory;

    protected function casts()
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
            'paid' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function duration()
    {
        $start = $this->start_time;
        $end = $this->end_time;

        if ($start->greaterThan($end)) {
            [$start, $end] = [$end, $start]; // swap
        }

        $minutes = $start->diffInMinutes($end);

        $hours = intdiv($minutes, 60);
        $remaining = $minutes % 60;

        return trim(
            ($hours ? "{$hours} hour" . ($hours > 1 ? 's' : '') : '') . ' ' .
            ($remaining ? "{$remaining} minute" . ($remaining > 1 ? 's' : '') : '')
        );
    }

    public function status()
    {
        return $this->belongsTo(BookingStatus::class, 'booking_status_id');
    }

}

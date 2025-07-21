<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingStatus extends Model
{
    public const PENDING = 1;
    public const CONFIRMED = 2;
    public const CANCELLED = 3;

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Booking */
class BookingResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'start_time' => $this->start_time->format('Y-m-d H:i'),
            'end_time' => $this->end_time->format('Y-m-d H:i'),
            'status' => $this->status->name,
            'paid' => $this->paid,
            'notes' => $this->notes,
            'user_id' => $this->user_id,
            'client_id' => $this->client_id,
            'service_id' => $this->service_id,
            'duration' => $this->duration(),
            'client' => new ClientResource($this->whenLoaded('client')),
            'service' => new ServiceResource($this->whenLoaded('service')),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Client */
class ClientCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}

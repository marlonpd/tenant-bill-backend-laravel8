<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PowerRateResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ownerId' => $this->owner_id,
            'rate' => $this->rate,
            'createdAt' => $this->created_at,
        ];
    }
}
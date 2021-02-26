<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeterReadingResource extends JsonResource
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
            'tenantId' => $this->tenant_id,
            'fromDate' => $this->from_date,
            'presentReadingKwh' => $this->present_reading_kwh,
            'toDate' => $this->to_date,
            'previousReadingKwh' => $this->previous_reading_kwh,
            'consumedKwh' => $this->consumed_kwh,
            'rate' => $this->rate,
            'bill' => $this->bill
        ];
        //return parent::toArray($request);
    }
}
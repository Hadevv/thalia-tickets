<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepresentationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'schedule' => $this->schedule,
            'price' => $this->whenLoaded('representationReservation', function () {
            if ($this->relationLoaded('representationReservation')) {
                return $this->representationReservation->price;
            }
            return null;
        }),

        ];
    }
}

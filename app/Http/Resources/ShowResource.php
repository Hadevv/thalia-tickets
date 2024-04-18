<?php

namespace App\Http\Resources;

use App\Models\Location;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'poster_url' => $this->poster_url,
            'bookable' => $this->bookable,
            'created_in' => $this->created_in,
            'duration' => $this->duration,
            'location' => new LocationResource($this->whenLoaded('location')),
            'artists' => $this->whenLoaded('artists', function () {
                return $this->artists->map(function ($artist) {
                    return [
                        'artist_id' => $artist->id,
                        'artist_firstname' => $artist->firstname,
                        'artist_lastname' => $artist->lastname,
                        'type' => $artist->artistTypes->first()->type->type ?? null,
                    ];
                });
            }),
            'representations' => RepresentationResource::collection($this->whenLoaded('representations')),
        ];
    }
}

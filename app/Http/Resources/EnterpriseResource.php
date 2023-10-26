<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnterpriseResource extends JsonResource
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
            'name' => $this->name,
            'balance' => $this->balance,
            'activity_sector' => new ActivitySectorResource($this->whenLoaded('activitySector')),
            'owner' => $this->getRelation('owner') !== null
                ? new UserResource($this->getRelation('owner')) : null,
        ];
    }
}

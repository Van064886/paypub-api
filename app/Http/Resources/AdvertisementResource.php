<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "picture" => is_null($this->picture) ? null
                : asset('/uploads/ads') . '/' . $this->picture,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "action_content" => $this->action_content,
            "action_type" => CallToActionResource::collection($this->whenLoaded("actionType")),
            "enterprise" => EnterpriseResource::collection($this->whenLoaded("enterprise")),
        ];
    }
}

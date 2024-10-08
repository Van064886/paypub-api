<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsSubscriptionResource extends JsonResource
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
            'user' => new UserResource($this->whenLoaded('user')),
            'advertisement' => new AdvertisementResource($this->whenLoaded('advertisement')),
            'sharing_histories' => AdsSharingHistoryResource::collection(
                $this->whenLoaded('sharingHistories')
            ),
        ];
    }
}

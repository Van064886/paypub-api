<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsSharingHistoryResource extends JsonResource
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
            'token' => $this->token,
            'gained_amount' => $this->gained_amount,
            'social_media' => new SocialMediaResource($this->whenLoaded('socialMedia')),
            'ads_subscription' => new AdsSubscriptionResource($this->whenLoaded('adsSubscription')),
        ];
    }
}

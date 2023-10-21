<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "email" => $this->email,
            "tel" => $this->tel,
            "address" => $this->address,
            "is_admin" => $this->is_admin,
            "picture" => is_null($this->picture) ? null
                : asset('/uploads/users') . '/' . $this->picture
        ];
    }
}

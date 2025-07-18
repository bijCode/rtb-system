<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AwardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'ad_slot_id' => $this->ad_slot_id,
            'bid_id' => $this->bid_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'bid' => new BidResource($this->whenLoaded('bid')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
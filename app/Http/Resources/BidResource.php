<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BidResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'ad_slot_id' => $this->ad_slot_id,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
        ];
    }
}

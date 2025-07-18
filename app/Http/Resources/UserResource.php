<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
            // Only include these if they're loaded
            'bids_count' => $this->whenLoaded('bids', function() {
                return $this->bids->count();
            }),
            'awards_count' => $this->whenLoaded('awards', function() {
                return $this->awards->count();
            }),
            
            // Relationships (only include if loaded)
            'bids' => BidResource::collection($this->whenLoaded('bids')),
            'awards' => AwardResource::collection($this->whenLoaded('awards')),
        ];
    }
}
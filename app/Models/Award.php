<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;
    protected $fillable = [
        'ad_slot_id', 
        'bid_id',
        'user_id',
    ];
    public function adSlot()
    {
        return $this->belongsTo(AdSlot::class);
    }

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

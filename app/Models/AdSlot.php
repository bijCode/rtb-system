<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdSlot extends Model
{
    use HasFactory;

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    protected $fillable = [
        'name', 
        'description',
        'min_bid',
        'status',
    ];
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function award()
    {
        return $this->hasOne(Award::class);
    }

    // Scopes
    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming')
            ->where('start_time', '>', now());
    }

    public function scopeOpen($query)
    {
        return $query->where('status', 'open')
            ->where('start_time', '<=', now())
            ->where('end_time', '>', now());
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed')
            ->where('end_time', '<=', now());
    }

    public function scopeAwarded($query)
    {
        return $query->where('status', 'awarded');
    }
}

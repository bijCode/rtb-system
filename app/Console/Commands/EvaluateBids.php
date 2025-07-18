<?php

namespace App\Console\Commands;

use App\Models\AdSlot;
use App\Models\Award;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EvaluateBids extends Command
{
    protected $signature = 'bids:evaluate';

    public function handle()
    {
        AdSlot::closed()
            ->where('status', '!=', 'awarded')
            ->with(['bids' => function($query) {
                $query->orderByDesc('amount')
                    ->orderBy('created_at');
            }])
            ->each(function ($slot) {
                if ($slot->bids->isNotEmpty()) {
                    DB::transaction(function () use ($slot) {
                        $winningBid = $slot->bids->first();
                        
                        Award::create([
                            'ad_slot_id' => $slot->id,
                            'bid_id' => $winningBid->id,
                            'user_id' => $winningBid->user_id
                        ]);
                        
                        $slot->update(['status' => 'awarded']);
                    });
                }
            });
    }
}

<?php

namespace App\Jobs;

use App\Exceptions\BidException;
use App\Models\AdSlot;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessBid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public AdSlot $adSlot,
        public float $amount
    ) {}

    public function handle()
    {
        DB::transaction(function () {
            // Lock the slot for update to prevent race conditions
            $slot = AdSlot::where('id', $this->adSlot->id)
                ->open()
                ->lockForUpdate()
                ->firstOrFail();

            if ($this->amount < $slot->min_bid) {
                throw new BidException('Bid amount must be at least ' . $slot->min_bid);
            }

            Bid::create([
                'user_id' => $this->user->id,
                'ad_slot_id' => $slot->id,
                'amount' => $this->amount
            ]);
        });
    }
}

<?php

namespace App\Console\Commands;

use App\Models\AdSlot;
use Illuminate\Console\Command;

class UpdateSlotStatus extends Command
{
    protected $signature = 'slots:update-status';

    public function handle()
    {
        // Update upcoming to open
        AdSlot::upcoming()
            ->where('start_time', '<=', now())
            ->update(['status' => 'open']);

        // Update open to closed
        AdSlot::open()
            ->where('end_time', '<=', now())
            ->update(['status' => 'closed']);
    }
}

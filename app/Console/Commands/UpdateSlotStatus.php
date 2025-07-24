<?php

namespace App\Console\Commands;

use App\Models\AdSlot;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateSlotStatus extends Command
{
    protected $signature = 'slots:update-status';

    public function handle()
    {
      DB::beginTransaction();
    
        try {
            $now = now();
            
            // 1. Update upcoming to open
            $opened = AdSlot::where('status', 'upcoming')
                        ->where('start_time', '<=', $now)
                        ->update(['status' => 'open']);
            
            // 2. Update open to closed
            $closed = AdSlot::where('status', 'open')
                        ->where('end_time', '<=', $now)
                        ->update(['status' => 'closed']);
            
            DB::commit();
            
            \Log::info('Slots updated', [
                'opened' => $opened,
                'closed' => $closed,
                'time' => $now
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Slot update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}

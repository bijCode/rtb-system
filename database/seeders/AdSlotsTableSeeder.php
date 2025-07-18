<?php

namespace Database\Seeders;

use App\Models\AdSlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdSlotsTableSeeder extends Seeder
{
    public function run()
    {
        AdSlot::create([
            'name' => 'Premium Banner',
            'description' => 'Top banner on homepage',
            'min_bid' => 100.00,
            'start_time' => now()->addDay(),
            'end_time' => now()->addDays(2),
            'status' => 'upcoming'
        ]);

        AdSlot::create([
            'name' => 'Sidebar Ad',
            'description' => 'Right sidebar on all pages',
            'min_bid' => 50.00,
            'start_time' => now(),
            'end_time' => now()->addDay(),
            'status' => 'open'
        ]);

        AdSlot::create([
            'name' => 'Footer Slot',
            'description' => 'Footer section on homepage',
            'min_bid' => 30.00,
            'start_time' => now()->subDays(2),
            'end_time' => now()->subDay(),
            'status' => 'closed'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBidRequest;
use App\Http\Resources\BidResource;
use App\Jobs\ProcessBid;
use App\Models\AdSlot;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function store(StoreBidRequest $request)
    {
        $adSlot = AdSlot::findOrFail($request->ad_slot_id);
        
        ProcessBid::dispatch(
            $request->user(),
            $adSlot,
            $request->amount
        );

        return response()->json([
            'message' => 'Bid is being processed'
        ], 202);
    }

    public function userBids(Request $request)
    {
        return BidResource::collection(
            $request->user()->bids()->latest()->paginate()
        );
    }
}

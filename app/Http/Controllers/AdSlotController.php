<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdSlotResource;
use App\Http\Resources\AwardResource;
use App\Http\Resources\BidResource;
use App\Models\AdSlot;
use Illuminate\Http\Request;

class AdSlotController extends Controller
{
    public function index(Request $request)
    {
        $query = AdSlot::query();
        
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        return AdSlotResource::collection($query->paginate());
    }

    public function show( $id)
    {
         $adSlot = AdSlot::find($id);
    
        if (!$adSlot) {
            return response()->json([
                'message' => 'Ad slot not found'
            ], 404);
        }
        return new AdSlotResource($adSlot);
    }

    public function bids(AdSlot $adSlot)
    {
        return BidResource::collection($adSlot->bids()->latest()->paginate());
    }

    public function winner(AdSlot $adSlot)
    {
        if ($adSlot->status !== 'awarded') {
            abort(404, 'Slot not yet awarded');
        }
        
        return new AwardResource($adSlot->award);
    }
}

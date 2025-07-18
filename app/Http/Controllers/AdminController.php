<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdSlotRequest;
use App\Http\Resources\AdSlotResource;
use App\Models\AdSlot;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('admin');
    }

    public function store(StoreAdSlotRequest $request)
    {
        $adSlot = AdSlot::create($request->validated());
        
        return new AdSlotResource($adSlot);
    }
}

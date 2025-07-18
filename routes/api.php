<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdSlotController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BidController;
use Illuminate\Support\Facades\Route;
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // User endpoints
    Route::get('/user/bids', [BidController::class, 'userBids']);
    
    // Ad slot endpoints
    Route::get('/slots', [AdSlotController::class, 'index']);
    Route::get('/slots/{id}', [AdSlotController::class, 'show']);
    Route::get('/slots/{adSlot}/bids', [AdSlotController::class, 'bids']);
    Route::get('/slots/{adSlot}/winner', [AdSlotController::class, 'winner']);
    
    // Bid submission
    Route::post('/bids', [BidController::class, 'store']);
    
    // Admin endpoints
    Route::middleware('admin')->group(function () {
        Route::post('/admin/slots', [AdminController::class, 'store']);
    });
});
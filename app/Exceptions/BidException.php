<?php

namespace App\Exceptions;

use Exception;

class BidException extends Exception
{
    // Optional: Customize the error rendering
    public function render($request)
    {
        return response()->json([
            'error' => $this->getMessage(),
        ], 400); 
    }
}
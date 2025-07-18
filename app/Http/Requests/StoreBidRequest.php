<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBidRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ad_slot_id' => 'required|exists:ad_slots,id',
            'amount' => 'required|numeric|min:0',
        ];
    }
}
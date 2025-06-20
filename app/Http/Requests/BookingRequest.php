<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'client_id' => ['required', 'exists:clients'],
            'service_id' => ['required', 'exists:services'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'status' => ['required', 'integer'],
            'paid' => ['boolean'],
            'notes' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}

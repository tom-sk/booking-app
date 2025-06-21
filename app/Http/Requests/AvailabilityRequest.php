<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityRequest extends FormRequest
{
    public function rules()
    {
        return [
            'day_of_week' => ['required', 'integer'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'is_active' => ['boolean'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class BookingRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'client_id' => [
                'required',
                Rule::exists('clients', 'id')->where(function ($query) {
                    $query->where('user_id', Auth::id());
                }),
            ],
            'service_id' => [
                'required',
                Rule::exists('services', 'id')->where(function ($query) {
                    $query->where('user_id', Auth::id());
                }),
            ],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}

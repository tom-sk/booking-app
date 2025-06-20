<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'name' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'notes' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}

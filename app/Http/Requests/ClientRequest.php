<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'notes' => ['nullable', 'max:500'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}

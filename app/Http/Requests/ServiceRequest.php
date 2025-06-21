<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'duration' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}

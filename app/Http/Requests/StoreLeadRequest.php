<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:32'],
            'email' => ['nullable', 'email', 'max:255'],
            'service_type' => ['required', 'string', 'max:80'],
            'pickup_city' => ['required', 'string', 'max:120'],
            'destination' => ['required', 'string', 'max:160'],
            'preferred_trip_date' => ['nullable', 'date'],
            'preferred_trip_time' => ['nullable', 'string', 'max:80'],
            'passengers' => ['nullable', 'integer', 'min:1', 'max:99'],
            'details' => ['nullable', 'string', 'max:2000'],
            'consent' => ['accepted'],
            'website' => ['prohibited'],
        ];
    }
}

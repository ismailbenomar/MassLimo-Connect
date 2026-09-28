<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:32'],
            'email' => ['nullable', 'email', 'max:255'],
            'service_type' => ['required', 'string', 'max:80'],
            'pickup_address' => ['required', 'string', 'max:255'],
            'destination_address' => ['required', 'string', 'max:255', 'different:pickup_address'],
            'preferred_trip_date' => ['required', 'date', 'after_or_equal:today'],
            'preferred_trip_time' => ['required', 'date_format:H:i'],
            'passengers' => ['required', 'integer', 'min:1', 'max:99'],
            'details' => ['nullable', 'string', 'max:2000'],
            'estimate_token' => ['required', 'string', 'max:10000'],
            'consent' => ['accepted'],
            'website' => ['prohibited'],
        ];
    }
}

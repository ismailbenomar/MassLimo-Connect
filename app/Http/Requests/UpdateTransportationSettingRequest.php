<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTransportationSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'price_estimates_enabled' => ['nullable', 'boolean'],
            'base_fee' => ['required', 'numeric', 'min:0', 'max:99999'],
            'per_mile_rate' => ['required', 'numeric', 'min:0', 'max:9999'],
            'per_minute_rate' => ['required', 'numeric', 'min:0', 'max:9999'],
            'minimum_estimate' => ['required', 'numeric', 'min:0', 'max:99999'],
            'maximum_distance_miles' => ['required', 'integer', 'min:1', 'max:1000'],
            'currency' => ['required', 'string', 'size:3', 'in:USD'],
            'estimate_disclaimer' => ['required', 'string', 'max:500'],
        ];
    }
}

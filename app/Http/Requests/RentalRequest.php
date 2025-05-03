<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class RentalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'customer_id' => 'required|exists:customers,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'sometimes|in:reserved,active,completed,cancelled',
            'notes' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'car_id.required' => 'Please select a car.',
            'customer_id.required' => 'Please select a customer.',
            'start_date.required' => 'The start date is required.',
            'end_date.required' => 'The end date is required.',
            'start_date.after_or_equal' => 'The start date must be today or in the future.',
            'end_date.after' => 'The end date must be after the start date.',
        ];
    }
}
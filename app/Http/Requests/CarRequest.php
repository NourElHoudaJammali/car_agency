<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'brand_id' => 'required|exists:brands,id',
            'car_type_id' => 'required|exists:car_types,id',
            'model' => 'required|string|max:100',
            'license_plate' => 'required|string|max:20|unique:cars,license_plate',
            'daily_rate' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:50',
            'seats' => 'required|integer|min:1|max:20',
            'description' => 'nullable|string',
            'available' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules['license_plate'] .= ',' . $this->car->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'Please select a brand.',
            'car_type_id.required' => 'Please select a car type.',
            'model.required' => 'The model field is required.',
            'license_plate.required' => 'The license plate field is required.',
            'daily_rate.required' => 'The daily rate field is required.',
            'year.required' => 'The year field is required.',
            'color.required' => 'The color field is required.',
            'seats.required' => 'The seats field is required.',
        ];
    }
}
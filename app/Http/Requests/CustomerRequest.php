<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:customers,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:50',
            'zip_code' => 'required|string|max:20',
            'country' => 'string|max:50',
            'notes' => 'nullable|string',
        ];

        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules['email'] .= ',' . $this->customer->id;
        }

        return $rules;
    }
}


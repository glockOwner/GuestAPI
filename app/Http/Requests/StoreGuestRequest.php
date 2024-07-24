<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string|unique:guests,phone|regex:/^[\d]+$/',
            'email' => 'string|unique:guests,email|email',
            'country' => ''
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => ' :attribute is required',
            'lastname.required' => ' :attribute is required',
            'phone.required' => ' :attribute is required'
        ]; // <- ADDED SEMICOLON
    }
}

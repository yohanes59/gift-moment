<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address' => ['required', 'string'],
            'address_detail' => ['required', 'string'],
            'provinces_id' => ['required', 'numeric'],
            'city_id' => ['required', 'numeric'],
            'postal_code' => ['required', 'numeric'],
            'phone_number' => ['required', 'string']
        ];
    }
}

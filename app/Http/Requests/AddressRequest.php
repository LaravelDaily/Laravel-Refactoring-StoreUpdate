<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'street_name' => ['required', 'string'],
            'house_number' => ['required', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'country_id' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'is_billing' => ['boolean', 'nullable'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'street_name' => $this->street,
            'house_number' => $this->number,
            'country_id' => $this->country,
        ]);
    }
}

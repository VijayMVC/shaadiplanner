<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreListing extends Request
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
            'business_name' => 'required|max:255',
            'contact' => 'required|max:255',
            'display_contact' => 'required|numeric',
            'address_1' => 'required|max:255',
            'address_2' => 'max:255',
            'town' => 'required|max:255',
            'county' => 'required|max:255',
            'postcode' => 'required|max:255',
            'country' => 'required|max:255',
            'latitude' => 'required|max:255',
            'longitude' => 'required|max:255',
            'display_address' => 'required|numeric',
            'phone' => 'required|max:255',
            'display_phone' => 'required|numeric',
            'phone_2' => 'required|max:255',
            'display_phone_2' => 'required|numeric',
            'email' => 'required|email',
            'website' => 'required|max:255',
            'description' => 'required',
            'cat_id' => 'required|numeric'
        ];
    }
}

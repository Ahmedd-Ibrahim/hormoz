<?php

namespace App\Http\Requests\API;

use App\Models\Address;
use InfyOm\Generator\Request\APIRequest;

class UpdateAddressAPIRequest extends APIRequest
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
        $rules = Address::$rules;

        $rules['user_id'] = 'sometimes';
        $rules['first_name'] = 'sometimes';
        $rules['last_name'] = 'sometimes';
        $rules['city'] = 'sometimes';
        $rules['street'] = 'sometimes';
        $rules['building_number'] = 'sometimes';
        $rules['apartment_number'] = 'sometimes';
        $rules['phone'] = 'sometimes';
        $rules['type'] = 'sometimes';
        $rules['description'] = 'sometimes';
        return $rules;
    }
}

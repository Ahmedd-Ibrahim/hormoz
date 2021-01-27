<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInformation extends FormRequest
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
            'name' => 'sometimes|min:3',
            'phone' => 'sometimes|min:3',
            'email' => 'sometimes|min:3|unique:users,email,',
            'gender' => 'sometimes|min:3',
            'birth_day' => 'sometimes|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name' => 'sometimes'
        ];
    }
}

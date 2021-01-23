<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
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
            'owner_name' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_id' => 'required',
            'iban' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'owner_name.required' => 'this field is required',
            'bank_name.required' => 'this field is required',
            'branch_name.required' => 'this field is required',
            'account_id.required' => 'this field is required',
            'iban.required' => 'this field is required',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
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
            'first_name' => 'required',
            'last_name' => 'required',
            'street' => 'required',
            'zip_code' => 'required',
            'company_name' => 'required',
            'nip' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'first_name.required' => 'Pole jest wymagane',
            'last_name.required' => 'Pole jest wymagane',
            'street.required' => 'Pole jest wymagane',
            'zip_code.required' => 'Pole jest wymagane',
            'company_name.required' => 'Pole jest wymagane',
            'nip.required' => 'Pole jest wymagane',
            'phone_no.required' => 'Pole jest wymagane',
        ];
    }
}

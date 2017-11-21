<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_no' => 'required',
            'city' => 'required',
            'zip_code' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Pole jest wymagane',
            'first_name.string' => 'Podaj prawidłowy format',
            'last_name.required' => 'Pole jest wymagane',
            'last_name.string' => 'Podaj prawidłowy format',
            'phone_no.required' => 'Pole jest wymagane',
            'city.required' => 'Pole jest wymagane',
            'zip_code.required' => 'Pole jest wymagane',
            'email.required' => 'Pole jest wymagane',
            'email.email' => 'Podaj poprawny e-mail',
            'email.unique' => 'Taki e-mail już istnieje w bazie danych',

        ];
    }
}

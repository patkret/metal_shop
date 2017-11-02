<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroup extends FormRequest
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
    {        return [
            'name' => 'required',
            'discount' => 'required|integer|between:0,100'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Pole jest wymagane',
            'discount.required' => 'Pole jest wymagane',
            'discount.integer' => 'Podaj odpowienią wartość całkowitą',
            'discount.between' => 'Podaj wartość z zakresu 0-100'
        ];
    }
}

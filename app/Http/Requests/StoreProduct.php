<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
        'code' => 'required',
        'unit' => 'required',
        'weight' => 'required|numeric|between:0,99.99',
        'wh_price' => 'required|numeric',
        'ret_price' => 'required|numeric',
        'value_discount' => 'required|numeric|between:0,100',
        'vd_target' => 'required|numeric',
        'amount_discount' => 'required|numeric|between:0,100',
        'ad_target' => 'required|numeric',
        'ad_target_2' => 'required|numeric',
        'amount_discount_2' => 'required|numeric|between:0,100'
    ];
    }
    public function messages()
    {
        return [
            'name.required'=> 'Pole wymagane',
            'code.required' => 'Pole wymagane',
            'unit.required' => 'Pole wymagane',
            'weight.required' => 'Pole wymagane',
            'weight.numeric' => 'Podaj odpowiednią wartość',
            'weight.between' => 'Podaj wartość np. 0.15',
            'wh_price.required' => 'Pole wymagane',
            'wh_price.numeric' => 'Podaj odpowiednią wartość',
            'ret_price.required' => 'Pole wymagane',
            'ret_price.numeric' => 'Podaj odpowiednią wartość',
            'value_discount.required' => 'Pole wymagane',
            'value_discount.numeric' => 'Podaj odpowiednią wartość',
            'value_discount.between' => 'Podaj wartość z zakresu 0-100',
            'amount_discount.required' => 'Pole wymagane',
            'amount_discount.numeric' => 'Podaj odpowiednią wartość',
            'amount_discount.between' => 'Podaj wartość z zakresu 0-100',
            'amount_discount_2.required' => 'Pole wymagane',
            'amount_discount_2.numeric' => 'Podaj odpowiednią wartość',
            'amount_discount_2.between' => 'Podaj wartość z zakresu 0-100',
            'vd_target.required' => 'Pole wymagane',
            'vd_target.numeric' => 'Podaj odpowiednią wartość',
            'ad_target.required' => 'Pole wymagane',
            'ad_target.numeric' => 'Podaj odpowiednią wartość',
            'ad_target_2.required' => 'Pole wymagane',
            'ad_target_2.numeric' => 'Podaj odpowiednią wartość',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductDescription extends FormRequest
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
            'descriptions[desc_short]' => 'max:255'
        ];
    }
    public function messages()
    {
        return [
            'descriptions[desc_short].max' => 'Opis zawiera więcej niż 255 znaków. Podaj krótszy opis.',
//            'last_category.required' => 'Wybierz kategorię',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryDescription extends FormRequest
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
//            'description' => 'required',
            'last_category' => 'required'
        ];
    }
    public function messages()
    {
        return [
//            'description.required' => 'Pole jest wymagane',
            'last_category.required' => 'Wybierz kategorię',

        ];
    }
}

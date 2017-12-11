<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
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
            'name' => 'required',
            'logo_file' => 'mimes:jpeg,jpg,gif,png|max:2048',
            'photo_file' => 'mimes:jpeg,jpg,gif,png|max:2048',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole jest wymagane',
            'logo_file.max' => 'Zbyt duży rozmiar pliku.(max. rozmiar 2MB)',
            'photo_file.max' => 'Zbyt duży rozmiar pliku.(max. rozmiar 2MB)',
            'logo_file.mimes' => 'Niewłaściwy format pliku. Możliwe formaty: jpeg, jpg, gif, png.',
            'photo_file.mimes' => 'Niewłaściwy format pliku. Możliwe formaty: jpeg, jpg, gif, png.'
        ];
    }
}

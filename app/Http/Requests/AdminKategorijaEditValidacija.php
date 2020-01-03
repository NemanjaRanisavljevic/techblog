<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminKategorijaEditValidacija extends FormRequest
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
            'nazivEditKategorije' => 'required|regex:/^[A-ZČĆŽŠĐ][\s0-9A-zčćžšđ]{2,}$/',
        ];
    }
    public function messages()
    {
        return [
            'nazivEditKategorije.required' => 'Polje za naziv je obavezno.',
            'nazivEditKategorije.regex' => 'Mora da pocne velikim slovom i min da ima 2 karaktera.',
            
        ];
    }
}

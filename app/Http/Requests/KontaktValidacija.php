<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KontaktValidacija extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imeKontakt' => 'required|regex:/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}$/',
            'emailKontakt' => 'required|email:rfc',
            'porukaKontakt' =>'required',
            'naslovKontakt'=>'required|min:10',
            'telefonKontakt' => 'required|regex:/^[0-9]{2,}$/'
        ];
    }

    public function messages()
    {
        return [
            'porukaKontakt.required' => 'Polje za komentar je obavezno.',   
        ];
    }
}

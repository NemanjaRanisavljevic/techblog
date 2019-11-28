<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacijaRegistracija extends FormRequest
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
            'ime' => 'required|regex:/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}$/',
            'prezime' => 'required|regex:/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,}$/',
            'sifra' => 'required|regex:/^[A-Z][\w\d]{5,}$/',
            'email' => 'required|email:rfc,dns',
            'pol' => 'not_regex:/^[0]$/'
        ];
    }

    public function messages()
    {
        return [
            'ime.required' => 'Polje za ime je obavezno.',
            'ime.regex' => 'Ime mora da ima min 2 karaktera i max 10 i da pocne velikim slovom.',
            'prezime.required'  => 'Polje za prezime je obavezno.',
            'prezime.regex'  => 'Prezime mora da ima min 2 karaktera i da pocne velikim slovom.',
            'email.email'  => 'E-mail nije u dobrom formatu.',
            'email.required'  => 'Polje za email je obavezno.',
            'sifra.required'  => 'Polje za sifru je obavezno.',
            'sifra.regex'  => 'Sifra mora da sadrzi minimum 6 karaktera i da pocinje velikim slovom.',
            'pol.not_regex'  => 'Morate izabrati pol.',
        ];
    }
}

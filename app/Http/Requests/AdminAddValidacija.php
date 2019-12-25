<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAddValidacija extends FormRequest
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
            'imeReg' => 'required|regex:/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}$/',
            'prezimeReg' => 'required|regex:/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,}$/',
            'sifraReg' => 'required|regex:/^[A-Z][\w\d]{5,}$/',
            'emailReg' => 'required|email:rfc',
            'slikaKorisnika' => 'required|file|image|max:2000',
            'polLista' => 'not_regex:/^[0]$/'
        ];
    }

    public function messages()
    {
        return [
            'imeReg.required' => 'Polje za ime je obavezno.',
            'imeReg.regex' => 'Ime mora da ima min 2 karaktera i max 10 i da pocne velikim slovom.',
            'prezimeReg.required'  => 'Polje za prezime je obavezno.',
            'prezimeReg.regex'  => 'Prezime mora da ima min 2 karaktera i da pocne velikim slovom.',
            'emailReg.email'  => 'E-mail nije u dobrom formatu.',
            'emailReg.required'  => 'Polje za email je obavezno.',
            'sifraReg.required'  => 'Polje za sifru je obavezno.',
            'sifraReg.regex'  => 'Sifra mora da sadrzi minimum 6 karaktera i da pocinje velikim slovom.',
            'polLista.not_regex'  => 'Morate izabrati pol.',
            'slikaKorisnika.max' => 'Maksimalna velicina slike je 2 mb',

        ];
    }
}

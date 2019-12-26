<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminKorisnikEditValidacija extends FormRequest
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
            'imeEdit' => 'required|regex:/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}$/',
            'prezimeEdit' => 'required|regex:/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,}$/',
            'emailEdit' => 'required|email:rfc',
            'slikaKorisnikaAdminEdit' => 'required|file|image',
            'ddlPolEdit' => 'not_regex:/^[0]$/'
        ];
    }

    public function messages()
    {
        return [
            'imeEdit.required' => 'Polje za ime je obavezno.',
            'imeEdit.regex' => 'Ime mora da ima min 2 karaktera i max 10 i da pocne velikim slovom.',
            'prezimeEdit.required'  => 'Polje za prezime je obavezno.',
            'prezimeEdit.regex'  => 'Prezime mora da ima min 2 karaktera i da pocne velikim slovom.',
            'emailEdit.email'  => 'E-mail nije u dobrom formatu.',
            'emailEdit.required'  => 'Polje za email je obavezno.',
            'sifraEdit.required'  => 'Polje za sifru je obavezno.',
            'sifraEdit.regex'  => 'Sifra mora da sadrzi minimum 6 karaktera i da pocinje velikim slovom.',
            'ddlPolEdit.not_regex'  => 'Morate izabrati pol.',
            'slikaKorisnikaAdminEdit.max' => 'Maksimalna velicina slike je 3 mb',
            'slikaKorisnikaAdminEdit.required' => 'Slika je obavezna'

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacijaObjava extends FormRequest
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
            'ddlKategorija'=>'required',
            'naslov'=>'required|min:10',
            'slikaObjava'=>'required|file|image|max:2000',
            'opis'=>'required|min:10'
        ];
    }

    public function messages()
    {
        return [
            'ddlKategorija.required' => 'Polje za kategoriju posta je obavezno.',
            'ddlKategorija.exists' => 'Ne postoji ta kategorija koju ste izabrali.',
            'naslov.required' => 'Polje za naslov je obavezno.',
            'naslov.min' => 'Polje za naslov mora da sadrzi minimalno 10 karaktera.',
            'slikaObjava.required' => 'Polje za sliku je obavezno.',
            'slikaObjava.image' => 'Slika nije u dobrom formatu.',
            'slikaObjava.max' => 'Maksimalna velicina slike je 2 MB.',
            'opis.required' => 'Polje za opis je obavezno.',
            'opis.min' => 'Polje za opis mora da sadrzi min 10 karaktera.',
        ];
    }
}

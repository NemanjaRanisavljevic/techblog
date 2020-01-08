<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostEditAdminRequest extends FormRequest
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
            'ddlKategorijeEdit'=>'required',
            'naslovEdit'=>'required|min:10',
            'slikaObjaveAdminEdit'=>'file|image|max:2000',
            'opisEdit'=>'required|min:10'
        ];
    }

    public function messages()
    {
        return [
            'ddlKategorijeEdit.required' => 'Polje za kategoriju posta je obavezno.',
            'ddlKategorijeEdit.exists' => 'Ne postoji ta kategorija koju ste izabrali.',
            'naslovEdit.required' => 'Polje za naslov je obavezno.',
            'naslovEdit.min' => 'Polje za naslov mora da sadrzi minimalno 10 karaktera.',
            'slikaObjaveAdminEdit.image' => 'Slika nije u dobrom formatu.',
            'slikaObjaveAdminEdit.max' => 'Maksimalna velicina slike je 2 MB.',
            'opisEdit.required' => 'Polje za opis je obavezno.',
            'opisEdit.min' => 'Polje za opis mora da sadrzi min 10 karaktera.',
        ];
    }
}

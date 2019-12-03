<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogovanjeValidacija extends FormRequest
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
            'sifra' => 'required|regex:/^[A-Z][\w\d]{5,}$/',
            'email' => 'required|email:rfc',
        ];
    }

    public function messages()
    {
        return [
            'email.email'  => 'E-mail nije u dobrom formatu.',
            'email.required'  => 'Polje za email je obavezno.',
            'sifra.required'  => 'Polje za sifru je obavezno.',
            'sifra.regex'  => 'Sifra mora da sadrzi minimum 6 karaktera i da pocinje velikim slovom.'

        ];
    }

}

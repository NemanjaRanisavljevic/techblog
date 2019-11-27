<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistracijaController extends Controller
{
    public function RegistracijaPrikaz()
    {
        return view('Pages/registracija');
    }
}

<?php

namespace App\Http\Controllers;

use App\Model\PolModel;
use Illuminate\Http\Request;

class RegistracijaController extends Controller
{
    public function RegistracijaPrikaz()
    {
        // $polModel = new PolModel();
        // $polovi = $polModel->GetPol();,["polovi"=>$polovi]

        return view('Pages/registracija');
    }
}

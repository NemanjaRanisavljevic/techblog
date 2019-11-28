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

    public function PosRegistracija(Request $request)
    {
        $ime = $request->ime;
        $prezime = $request->prezime;
        $email = $request->email;
        $sifra = $request->sifra;
        $pol = $request->pol;
        $slika = $request->slika;
        $token = md5($email);

        try
        {

        }catch(QueryException $e)
        {
            \Log::info("Mail za Aktivaciju nije poslat!". $e->getMessage());
        }
    }
}

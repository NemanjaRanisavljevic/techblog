<?php

namespace App\Http\Controllers;


use App\Http\Requests\ValidacijaRegistracija;
use App\Model\KorisnikModel;
use App\Model\PolModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RegistracijaController extends Controller
{
    private $korisnikModel;

    public function __construct()
    {
        $this->korisnikModel = new KorisnikModel();
    }

    public function RegistracijaPrikaz()
    {
         $polModel = new PolModel();
         $polovi = $polModel->GetPol();

        return view('Pages/registracija',["polovi"=>$polovi]);
    }

    public function PosRegistracija(ValidacijaRegistracija $request)
    {
        $slika = $request->file('slikaKorisnika');
        $slikaIme = $slika->getClientOriginalName();
        $slikaIme = time()."_".$slikaIme;

        public_path("upload");


        try
        {
            $slika->move(public_path("upload"),$slikaIme);

            $this->korisnikModel->ime = $request->imeReg;
            $this->korisnikModel->prezime = $request->prezimeReg;
            $this->korisnikModel->email = $request->emailReg;
            $this->korisnikModel->sifra = md5($request->sifraReg);
            $this->korisnikModel->pol = $request->polList;
            $this->korisnikModel->slikaIme = $slikaIme;
            $this->korisnikModel->token = md5($request->emailReg);

            $this->korisnikModel->InsertKorisnik();

            return redirect()->back();

        }catch(QueryException $e)
        {
            \Log::info("Mail za Aktivaciju nije poslat!". $e->getMessage());
        }
    }


}

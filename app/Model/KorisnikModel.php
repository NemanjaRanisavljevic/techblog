<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KorisnikModel extends Model
{
    public $ime;
    public $prezime;
    public $email;
    public $sifra;
    public $pol;
    public $token;
    public $slikaIme;


    public function InsertKorisnik()
    {
        try
        {
            \DB::transaction(function(){
                $slikaId = \DB::table("slika")->insertGetId([
                    "putanja" => $this->slikaIme,
                    "alt"=> $this->ime
                ]);

                \DB::table("korisnik")->insert([
                    "ime" => $this->ime,
                    "prezime" => $this->prezime,
                    "email" => $this->email,
                    "sifra" => $this->sifra,
                    "token" => $this->token,
                    "polId" => $this->pol,
                    "ulogaId" => 1,
                    "slikaId" => $slikaId

                ]);
            });

        }catch (\Throwable $e)
        {
            \Log::info("Greska pri insertu posta". $e->getMessage());
        }
    }
}

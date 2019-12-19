<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

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
            \Log::info("Greska pri insertu korisnika". $e->getMessage());
        }
    }

    public function Aktivacija()
    {
        try{
            \DB::transaction(function (){
                \DB::table('korisnik')
                    ->where("token",$this->token)
                    ->first();
                    
                \DB::table('korisnik')
                    ->where("token",$this->token)
                    ->update(['aktivan'=>1]);
            });
        }catch (QueryException $e)
        {
            \Log::info("Nije uspela aktivacija kod upita. ".$e->getMessage());
        }
    }

    public function Logovanje($email,$sifra)
    {
        return \DB::table('korisnik as k')
            ->join('uloga as u','u.IdUloga','=','k.ulogaId')
            ->where([
                ['email',$email],
                ['sifra',$sifra],
                ['aktivan',1]
            ])
            ->first();
    }
}

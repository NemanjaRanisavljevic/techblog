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
    public $aktivan;
    public $ulodaId;
    public $idKorisnika;
    public $idSlika;

    public function GetAllKorisnik()
    {
        try{
            return \DB::table("korisnik as k")
            ->join("pol as p","p.idPol","=","k.polId")
            ->join("uloga as u","u.idUloga","=","k.ulogaId")
            ->join("slika as s","s.idSlika","=","k.slikaId")
            ->where("k.delete_on",null)
            ->get();
        }catch(\Throwable $e)
        {
            \Log::info("Greska pri dohvatanju korisnika". $e->getMessage());
        }
    }

    public function GetIdKorisnik($id)
    {
        try{
            return \DB::table("korisnik as k")
            ->join("pol as p","p.idPol","=","k.polId")
            ->join("uloga as u","u.idUloga","=","k.ulogaId")
            ->join("slika as s","s.idSlika","=","k.slikaId")
            ->where([
                ["k.delete_on","=",null],
                ["k.idKorisnik","=",$id]
            ])
            ->get();
        }catch(\Throwable $e)
        {
            \Log::info("Greska pri dohvatanju korisnika". $e->getMessage());
        }
    }

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

    public function BrisanjeKorisnika($id,$date)
    {
        
        try{
            \DB::table('korisnik')
            ->where('idKorisnik', $id)
            ->update(['delete_on' => $date]);
            
        }catch (QueryException $e)
        {
            \Log::info("Brisanje korisnika. ".$e->getMessage());
        }
    }

    public function InsertKorisnikAdmin()
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
                    "ulogaId" => $this->ulodaId,
                    "aktivan" => $this->aktivan,
                    "slikaId" => $slikaId

                ]);
            });

        }catch (\Throwable $e)
        {
            \Log::info("Greska pri insertu korisnika". $e->getMessage());
        }
    }

    public function ProveraPostova($id)
    {
        try
        {
            return \DB::table("post as p")       
                ->where('p.korisnikId',$id)
                ->get();

        }catch (\Throwable $e)
        {
            \Log::info("Greska pri proveri brisanja korisnika". $e->getMessage());
        }
    }

    public function EditKorisnikaBezSifre()
    {
        try
        {
            \DB::transaction(function(){
                if($this->slikaIme != NULL)
                {
                \DB::table("slika")
                ->where('idSlika',$this->idSlika)
                ->update([
                    "putanja" => $this->slikaIme
                    ]);
                }

                \DB::table('korisnik')
                ->where('idKorisnik',$this->idKorisnika)
                ->update([
                    "ime" => $this->ime,
                    "prezime" => $this->prezime,
                    "email" => $this->email,
                    "token" => $this->token,
                    "polId" => $this->pol,
                    "ulogaId" => $this->ulodaId,
                    "aktivan" => $this->aktivan,
                    "slikaId" => $this->idSlika
                    ]);
            });

        }catch (\Throwable $e)
        {
            \Log::info("Greska pri editu korisnika". $e->getMessage());
        }
    }
    public function EditKorisnikaSaSifre()
    {
        try
        {
            \DB::transaction(function(){
                
                if($this->slikaIme != NULL)
                {
                \DB::table("slika")
                ->where('idSlika',$this->idSlika)
                ->update([
                    "putanja" => $this->slikaIme
                    ]);
                }
                
                \DB::table('korisnik')
                ->where('idKorisnik',$this->idKorisnika)
                ->update([
                    "ime" => $this->ime,
                    "prezime" => $this->prezime,
                    "email" => $this->email,
                    "sifra" => $this->sifra,
                    "token" => $this->token,
                    "polId" => $this->pol,
                    "ulogaId" => $this->ulodaId,
                    "aktivan" => $this->aktivan,
                    "slikaId" => $this->idSlika
                    ]);
            });

        }catch (\Throwable $e)
        {
            \Log::info("Greska pri editu korisnika". $e->getMessage());
        }
    }
}

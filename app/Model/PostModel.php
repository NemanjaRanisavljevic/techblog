<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    public $naslov;
    public $opis;
    public $slikaIme;
    public $korisnikId;
    public $kategorijaId;

    public function InsertPosta()
    {
        try{

            \DB::transaction(function(){
                $slikaId = \DB::table("slika")->insertGetId([
                    "putanja" => $this->slikaIme,
                    "alt"=> $this->naslov
                ]);

                \DB::table("post")->insert([
                    "naslov" => $this->naslov,
                    "opis" => $this->opis,
                    "slikaId" => $slikaId,
                    "korisnikId" => $this->korisnikId,
                    "kategorijaId" => $this->kategorijaId
                ]);
            });

        }catch(\Throwable $e){
            \Log::info("Greska pri insertu posta". $e->getMessage());
        }
    }

    public function PrikazPostova()
    {
        return \DB::table("post as p")
            ->join("kategorija as ka","ka.idKategorija","=","p.kategorijaId")
            ->join("korisnik as k","k.idKorisnik","=","p.korisnikId")
            ->join("slika as s","s.idSlika","=","p.slikaId")
            ->orderBy('s.create_on','DESC')
            ->paginate(6);
    }

    public function PrikazSlajda()
    {
        return \DB::table("post as p")
        ->join("kategorija as ka","ka.idKategorija","=","p.kategorijaId")
        ->join("korisnik as k","k.idKorisnik","=","p.korisnikId")
        ->join("slika as s","s.idSlika","=","p.slikaId")
        ->orderBy('s.create_on','DESC')
        ->limit(3)
        ->get();
    }

    public function PrikazNavBara($id)
    {
        
        try 
        {
            return \DB::table("post as p")
                ->join("kategorija as ka","ka.idKategorija","=","p.kategorijaId")
                ->join("korisnik as k","k.idKorisnik","=","p.korisnikId")
                ->join("slika as s","s.idSlika","=","p.slikaId")
                ->where('p.kategorijaId',$id)
                ->limit(4)
                ->orderBy('s.create_on','DESC')
                ->get();

        }catch(\Throwable $e){
            \Log::info("Greska baze". $e->getMessage());
        }

    }

    public function GetIdPost($id)
    {
        try 
        {
            return \DB::table("post as p")
                ->join("kategorija as ka","ka.idKategorija","=","p.kategorijaId")
                ->join("korisnik as k","k.idKorisnik","=","p.korisnikId")
                ->join("slika as s","s.idSlika","=","p.slikaId")
                ->where('p.idPost',$id)
                ->get();
        } catch (\Throwable $e) 
        {
            \Log::info("Greska baze". $e->getMessage());
        }
    }

    public function GetKorisnikInfo($id)
    {
        try 
        {
            return \DB::table("post as p")
                ->join("korisnik as k","k.idKorisnik","=","p.korisnikId")
                ->join("slika as s","s.idSlika","=","k.idKorisnik")
                ->where('p.idPost',$id)
                ->select('s.putanja')
                ->get();
        } catch (\Throwable $e) 
        {
            \Log::info("Greska baze". $e->getMessage());
        }
        
    }
    
}

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
}

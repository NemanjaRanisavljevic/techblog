<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KomentarModel extends Model
{
    public $idKorisnika;
    public $idPosta;
    public $sadrzaj;
    
    
    public function InsertKomentar()
    {
       
        try
        {
                
            $idKomentara = \DB::table('komentar')
            ->insertGetId([
                'sadrzaj' => $this->sadrzaj,
                'postId' => $this->idPosta,
                'korisnikId' => $this->idKorisnika
            ]);

            return \DB::table('komentar as kom')
            ->join('korisnik as k','k.idKorisnik','=','kom.korisnikId')
            ->join('slika as s','s.idSlika','=','k.slikaId')
            ->select('k.ime','k.prezime','kom.idKomentar','kom.sadrzaj','kom.create_on','s.putanja')
            ->where('kom.idKomentar',$idKomentara)
            ->get();

        }catch (\Throwable $e)
        {
            \Log::info("Greska pri insertu komentara ". $e->getMessage());
        }
    }
}

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

    public function GetNajkomentarisanije()
    {
        try{
            return \DB::table('komentar as kom')
            ->join('post as p','p.idPost','=','kom.postId')
            ->join('slika as s','s.idSlika','=','p.slikaId')
            ->select('p.idPost','p.naslov','s.putanja','kom.postId','s.create_on')
            ->groupBy('kom.postId','p.idPost','p.naslov','s.putanja','s.create_on')
            ->orderBy(\DB::raw('count(*)'),'DESC')
            ->get();

        }catch(\Throwable $e)
        {
            \Log::info("Greska pri dohvatanju komentara ". $e->getMessage());
        }
    }

    public function DeleteKomenatar($id,$idPost)
    {
        try {
            \DB::table('komentar')
            ->where('idKomentar',$id)
            ->delete();

            return \DB::table('komentar as kom')
            ->join('korisnik as k','k.idKorisnik','=','kom.korisnikId')
            ->join('slika as s','s.idSlika','=','k.slikaId')
            ->select('k.ime','k.prezime','kom.idKomentar','kom.sadrzaj','kom.create_on','s.putanja')
            ->where('kom.postId',$idPost)
            ->get();
        } catch (\Throwable $e) {
            \Log::info("Greska pri brisanje komentara ". $e->getMessage());
        }
    }
}

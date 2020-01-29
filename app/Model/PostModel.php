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
    public $slikaId;
    public $postId;

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
            ->paginate(4);
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
            \Log::info("Greska baze ". $e->getMessage());
        }
    }
    

    public function GetKomentari($id)
    {
        try 
        {
            return \DB::table('komentar as kom')
            ->join('korisnik as k','k.idKorisnik','=','kom.korisnikId')
            ->join('slika as s','s.idSlika','=','k.slikaId')
            ->select('k.idKorisnik','k.ime','k.prezime','kom.idKomentar','kom.sadrzaj','kom.create_on','s.putanja')
            ->where('kom.postId',$id)
            ->get();

            // return \DB::table("post as p")
            // ->join("korisnik as k","k.idKorisnik","=","p.korisnikId")
            // ->join("slika as s","s.idSlika","=","k.slikaId")
            // ->join("komentar as kom","kom.postId","=","p.idPost")
            // ->select('k.idKorisnik','k.ime','k.prezime','kom.idKomentar','kom.sadrzaj','kom.create_on','s.putanja',\DB::raw('count(kom.idKomentar) as brojKomentara'))
            // ->where('p.idPost',$id)
            // ->groupBy('kom.idKomentar','k.ime','k.prezime','kom.idKomentar','kom.sadrzaj','kom.create_on','s.putanja','k.idKorisnik')
            // ->get();
            
        } catch (\Throwable $e) 
        {
            \Log::info("Greska baze". $e->getMessage());
        }
        
    }

    public function PrikazPostovaPoKategoriji($id)
    {
        return \DB::table("post as p")
            ->join("kategorija as ka","ka.idKategorija","=","p.kategorijaId")
            ->join("korisnik as k","k.idKorisnik","=","p.korisnikId")
            ->join("slika as s","s.idSlika","=","p.slikaId")
            ->where("p.kategorijaId",$id)
            ->orderBy('s.create_on','DESC')
            ->paginate(6);
    }

    public function EditPost()
    {
        try{
            \DB::transaction(function(){
                if($this->slikaIme != null)
                {
                    \DB::table("slika")
                    ->where('idSlika',$this->slikaId)
                    ->update([
                        "putanja" => $this->slikaIme,
                        "alt"=> $this->naslov
                    ]);
                }
                

                \DB::table("post")
                ->where('idPost',$this->postId)
                ->update([
                    "naslov" => $this->naslov,
                    "opis" => $this->opis,
                    "slikaId" => $this->slikaId,
                    "korisnikId" => $this->korisnikId,
                    "kategorijaId" => $this->kategorijaId
                ]);
            });

        }catch(\Throwable $e){
            \Log::info("Greska pri editu posta". $e->getMessage());
        }

    }

    public function DeletePost()
    {
        try{
            \DB::transaction(function(){
                
                \DB::table("komentar")
                ->where('postId',$this->postId)
                ->delete();

                \DB::table('slika')
                ->where('idSlika',$this->slikaId)
                ->delete();
                
                \DB::table("post")
                ->where('idPost',$this->postId)
                ->delete();
            });

        }catch(\Throwable $e){
            \Log::info("Greska pri brisanju posta". $e->getMessage());
        }
    }
    
   
    
}

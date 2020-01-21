<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UlogaModel extends Model
{
    public function GetAll()
    {
        try {
            
            return \DB::table('uloga as u')
            ->get();
            
        } catch (\Throwable $e) {
            \Log::info("Greska baze". $e->getMessage());
        }
    }

    public function GetForAdmin()
    {
        return \DB::table('uloga as u')
            ->leftJoin('korisnik as k','k.ulogaId','=','u.IdUloga')
            ->select(\DB::raw('count(k.ulogaId) as brojKorisnika'),'u.IdUloga','u.naziv')
            ->where('u.delete_on',null)
            ->groupBy("u.IdUloga","u.naziv")
            ->get();
    }
    
    public function InsertUloge($naziv)
    {
        try{
            \DB::table("uloga")->insert([
                "naziv" => $naziv
            ]);

        }catch (\Throwable $e) {
            \Log::info("Greska pri insertu uloge". $e->getMessage());
        }
    }
    public function GetUloga($id)
    {
        return \DB::table("uloga")
        ->where('IdUloga',$id)
        ->get();
    }

    public function Edit($id,$naziv)
    {
        \DB::table("uloga")
                    ->where('IdUloga',$id)
                    ->update([
                        "naziv" => $naziv
                    ]);
    }


    public function GetIdUloge($id)
    {
        return \DB::table("korisnik")
        ->where('ulogaId',$id)
        ->get();
    }

    public function DeleteU($id)
    {
        try{
            \DB::table("uloga")
                ->where('IdUloga',$id)
                ->delete();
            
        }catch (\Throwable $e) {
            \Log::info("Greska pri delete uloge". $e->getMessage());
        }

    }
}

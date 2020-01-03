<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KategorijeModel extends Model
{
    public function GetKategorije()
    {
        return \DB::table("kategorija as k")
        ->leftJoin("post as p","p.kategorijaId","=","k.idKategorija")
        ->select(\DB::raw('count(p.kategorijaId) as brojPostova'),"k.nazivKategorije","k.idKategorija")
        ->where('k.deleted_on',null)
        ->groupBy("k.idKategorija","k.nazivKategorije")
        ->get();
    }
    
    public function AddKategorije($naziv)
    {
        try
        {
            \DB::table("kategorija")->insert([
                "nazivKategorije" => $naziv
            ]);

        }catch(\Throwable $e)
        {
            \Log::info("Greska pri insertu kategorije ". $e->getMessage());
        }
    }

    public function GetIdKategorije($id)
    {
        return \DB::table("kategorija")
        ->where('idKategorija',$id)
        ->get();
    }

    public function EditKategorije($naziv,$id)
    {
        try
        {
                \DB::table('kategorija')
                ->where('idKategorija',$id)
                ->update([
                    "nazivKategorije" => $naziv
                    ]);
          
        }catch (\Throwable $e)
        {
            \Log::info("Greska pri editu kategorije ". $e->getMessage());
        }
    }

    public function DeleteKategorije($id)
    {
        try
        {
            \DB::table('kategorija')
            ->where('idKategorija',$id)
            ->delete();

        }catch(\Throwable $e)
        {
            \Log::info("Greska pri brisanju kategorije ". $e->getMessage());

        }
    }

}

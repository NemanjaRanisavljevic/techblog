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

}

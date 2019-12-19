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
        ->groupBy("k.idKategorija","k.nazivKategorije")
        ->get();
    }

}

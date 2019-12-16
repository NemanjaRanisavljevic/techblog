<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KategorijeModel extends Model
{
    public function GetKategorije()
    {
        return \DB::table('kategorija')->get();

    }
}

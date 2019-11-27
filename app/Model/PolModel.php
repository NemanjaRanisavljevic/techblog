<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PolModel extends Model
{
    public function GetPol()
    {
        return \DB::table('pol')->get();
    }
}

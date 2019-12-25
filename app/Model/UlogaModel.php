<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UlogaModel extends Model
{
    public function GetAll()
    {
        try {
            
            return \DB::table('uloga')->where('delete_on',null)->get();
            
        } catch (\Throwable $e) {
            \Log::info("Greska baze". $e->getMessage());
        }
    }
}

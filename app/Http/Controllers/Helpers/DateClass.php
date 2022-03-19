<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DateClass extends Controller
{
    public function VremePrikaz($datum)
    {
        $vreme = $datum;
        $datumNiz = explode(" ",$vreme); // 01-02-2006 15:04:06
        $datum = explode("-",$datumNiz[0]);
        $timestemp = mktime(0,0,0,$datum[1],$datum[2],$datum[0]);
        $datumPrikaz = date("j F, Y",$timestemp);
        return $datumPrikaz;
    } 
}

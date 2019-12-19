<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DateClass extends Controller
{
    public function VremePrikaz($datum)
    {
        // You can also use Illuminate\Support\Carbon
        return date('d M Y H:i:s', strtotime($datum));
    } 
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function IndexPrikaz()
    {
        return view('Pages/pocetna',['ime'=>'Nemanja']);
    }
}

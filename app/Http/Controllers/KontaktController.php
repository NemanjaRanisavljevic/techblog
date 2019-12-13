<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\KategorijeModel;

class KontaktController extends Controller
{
    private $kategorijeModel;

    public function __construct()
    {
        $this->kategorijeModel = new KategorijeModel();
    }
    public function PrikazKontakt()
    {
        $kategorijeData = $this->kategorijeModel->GetKategorije();

        return view('Pages/kontakt',['kategorije'=>$kategorijeData]);
    }
}

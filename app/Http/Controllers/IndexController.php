<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PostModel;
use App\Model\KategorijeModel;

class IndexController extends Controller
{
    
    private $postModel;
    private $kategorijeModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->kategorijeModel = new KategorijeModel();
    }

    public function IndexPrikaz()
    {
        $postovi = $this->postModel->PrikazPostova();

        $slajderPost = $this->postModel->PrikazSlajda();

        $kategorijeData = $this->kategorijeModel->GetKategorije();
        
        return view('Pages/pocetna',['postovi'=>$postovi,'slajderData'=>$slajderPost,'kategorije'=>$kategorijeData]);
    }

    public function PrikazKategorijaNav(Request $request)
    {
        try {
            $kategorijeNav = $this->postModel->PrikazNavBara($request->id);
            return $kategorijeNav;
        } catch (QueryException $e) {
            \Log::info("Greska ucitavanju nav kategorija". $e->getMessage());
        }
    }
 
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PostModel;
use App\Model\KategorijeModel;
use App\Model\KomentarModel;

class IndexController extends Controller
{
    
    private $postModel;
    private $kategorijeModel;
    private $komentarModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->kategorijeModel = new KategorijeModel();
        $this->komentarModel = new KomentarModel();
    }

    public function IndexPrikaz()
    {
        $postovi = $this->postModel->PrikazPostova();

        $slajderPost = $this->postModel->PrikazSlajda();

        $kategorijeData = $this->kategorijeModel->GetKategorije();

        $najKomentari = $this->komentarModel->GetNajkomentarisanije();
        
        return view('Pages/pocetna',['postovi'=>$postovi,'slajderData'=>$slajderPost,'kategorije'=>$kategorijeData,'najkomentarisanije'=>$najKomentari]);
    }

    public function GetSvihPostovaZaKategoriju(Request $request)
    {
        
        $postovi = $this->postModel->PrikazPostovaPoKategoriji($request->id);

        $slajderPost = $this->postModel->PrikazSlajda();

        $kategorijeData = $this->kategorijeModel->GetKategorije();

        $najKomentari = $this->komentarModel->GetNajkomentarisanije();

        return view('Pages/stranaOdredjeneKategorije',['postovi'=>$postovi,'slajderData'=>$slajderPost,'kategorije'=>$kategorijeData,'najkomentarisanije'=>$najKomentari]);
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

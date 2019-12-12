<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidacijaObjava;
use App\Model\PostModel;
use App\Model\KategorijeModel;

use Illuminate\Http\Request;

class PostController extends Controller
{

    private $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function PostPrikaz()
    {
        $kategorijaModel = new KategorijeModel();
        $kategorije = $kategorijaModel->GetKategorije();

        return view('Pages/post',["kategorije"=>$kategorije]);
    }

    public function InsertPosta(ValidacijaObjava $request)
    {
        $slika = $request->file('slikaObjava');
        $slikaIme = $slika->getClientOriginalName();
        $slikaIme = time()."_".$slikaIme;

        public_path("upload");

        try
        {
            $this->postModel->naslov = $request->naslov;
            $this->postModel->opis = $request->opis;
            $this->postModel->slikaIme = $slikaIme;
            $this->postModel->korisnikId = session('korisnik')->idKorisnik;
            $this->postModel->kategorijaId = $request->ddlKategorija;

            $this->postModel->InsertPosta();
            
            $slika->move(public_path("upload"),$slikaIme);

            return redirect()->back()->with("uspesno","Uspesno ste postavili objavu.");
        }catch(QueryException $e)
        {
            \Log::info("Greska pri insertu posta". $e->getMessage());
        }

        
    }
}

<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidacijaObjava;
use App\Http\Requests\PostEditAdminRequest;
use App\Model\PostModel;
use App\Model\KategorijeModel;

use Illuminate\Http\Request;

class PostController extends Controller
{

    private $postModel;
    private $kategorijaModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->kategorijaModel = new KategorijeModel();
    }

    public function PostPrikaz()
    {
        
        $kategorije = $this->kategorijaModel->GetKategorije();

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

    public function GetAllAdmin()
    {
        $objave = $this->postModel->PrikazPostova();
        $kategorije = $this->kategorijaModel->GetKategorije();
        return view('Pages/admin/postAdmin',['objave'=>$objave,'kategorije'=>$kategorije]);
    }

    public function GetIdPost(Request $request)
    {
        return $this->postModel->GetIdPost($request->id);
    }

    public function EditPost(PostEditAdminRequest $request)
    {
        if($request->slikaObjaveAdminEdit != null)
        {
            $slika = $request->file('slikaObjaveAdminEdit');
            $slikaIme = $slika->getClientOriginalName();
            $slikaIme = time()."_".$slikaIme;

            public_path("upload");
            $slika->move(public_path("upload"),$slikaIme);
            $this->postModel->slikaIme = $slikaIme;
        }
        

        try
        {
            $this->postModel->naslov = $request->naslovEdit;
            $this->postModel->opis = $request->opisEdit;
            $this->postModel->korisnikId = $request->korisnikIdEdit;
            $this->postModel->kategorijaId = $request->ddlKategorijeEdit;
            $this->postModel->slikaId = $request->slikaIdEditObj;
            $this->postModel->postId = $request->objaveIdEdit;

            $this->postModel->EditPost();

            
            
            return redirect()->back()->with("uspesno","Uspesno ste izmenili objavu.");
        }catch(QueryException $e)
        {
            \Log::info("Greska pri editu posta". $e->getMessage());
        }

    }
    public function DeletePost(Request $request)
    {
        $img = $request->putanjaEditObj;
        
        $this->postModel->postId = $request->id;
        $this->postModel->slikaId = $request->slikaIdEditObj;
        $query = $this->postModel->DeletePost();

        abort(204);
    }
}

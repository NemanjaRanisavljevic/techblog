<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PostModel;
use App\Model\KategorijeModel;

class SinglePostController extends Controller
{
    private $postModel;
    private $kategorijeModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->kategorijeModel = new KategorijeModel();
    }

    public function GetIdSingle(Request $request)
    {
       try {
        $kategorijeData = $this->kategorijeModel->GetKategorije();
        
        $postData = $this->postModel->GetIdPost($request->id);

        if(empty($postData))
        {      
            return redirect()->back()->with("NotFoundPost","Ne postoji objava koju trazite.");
            
        }else
        {
            $komentari = $this->postModel->GetKomentari($request->id);
            
            return view('Pages/singlePost',['kategorije'=>$kategorijeData,'infoPost'=>$postData,'komentari'=>$komentari]);
        }
       
       } catch (QueryException $e) {
        \Log::info("Greska pri ucitavanju id stranice". $e->getMessage());
       }
    }

    public function InsertKomentara(Request $request)
    {
        return dd("radi");
    }
}

<?php

namespace App\Http\Controllers;
use App\Http\Requests\AdminKategorijaValidacija;
use App\Http\Requests\AdminKategorijaEditValidacija;

use Illuminate\Http\Request;
use App\Model\KategorijeModel;
use App\Model\PostModel;

class AdminController extends Controller
{
    private $kategorijeModel;
    private $postModel;

    public function __construct()
    {
        $this->kategorijeModel = new KategorijeModel();
        $this->postModel = new PostModel();

    }

    public function AdminPrikazKategorija()
    {
        $kategorije = $this->kategorijeModel->GetKategorije();
    
        return view('Pages/admin/kategorijeAdmin',['kategorije'=>$kategorije]);
    }

    public function AdminAddKategorije(AdminKategorijaValidacija $request)
    {
        try
        {
            $this->kategorijeModel->AddKategorije($request->nazivKatAdd);
            return redirect()->back()->with('uspesno','Uspesno dodali novu kategoriju.');

        }catch(QueryException $e)
        {
            \Log::info("Greska u kontroleru dodavanja kategorija". $e->getMessage());
        }
    }

    public function AdminGetKategorijeId(Request $request)
    {
        $data =$this->kategorijeModel->GetIdKategorije($request->id);
        if($data == null)
        {
            abort(404);
        }
        return $data;
    }

    public function AdminEditKategorije(AdminKategorijaEditValidacija $request)
    {
        if($request->nazivEditKategorije == null || $request->kategorijaEditId == null)
        {
            abort(422);
        }

        $this->kategorijeModel->EditKategorije($request->nazivEditKategorije,$request->kategorijaEditId);
        return redirect()->back()->with('uspesno','Uspesno ste izmenili kategoriju.');
    }

    public function AdminBrisanjeKategorije(Request $request)
    {
        $postData = $this->postModel->PrikazPostovaPoKategoriji($request->id);
        if($postData->total() == 0)
        {
            $this->kategorijeModel->DeleteKategorije($request->id);
            abort(204);
        }
        abort(422);
        
    }

}

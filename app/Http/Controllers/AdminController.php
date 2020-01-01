<?php

namespace App\Http\Controllers;
use App\Http\Requests\AdminKategorijaValidacija;

use Illuminate\Http\Request;
use App\Model\KategorijeModel;

class AdminController extends Controller
{
    private $kategorijeModel;

    public function __construct()
    {
        $this->kategorijeModel = new KategorijeModel();

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

}

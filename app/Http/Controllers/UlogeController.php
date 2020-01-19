<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\UlogaModel;

class UlogeController extends Controller
{
    private $ulogaModel;

    public function __construct()
    {
        $this->ulogaModel = new UlogaModel();
    }

    public function GetAllUloge()
    {
        $uloge = $this->ulogaModel->GetForAdmin();
        
        return view('Pages/admin/ulogeAdmin',['uloge'=>$uloge]);
    }

    public function InsertUloge(Request $request)
    {
        $this->ulogaModel->InsertUloge($request->nazivUlogeAdd);
        return redirect()->back()->with('uspesno','Uspesno ste dodali ulogu.');
    }

    public function DeleteUloge(Request $request)
    {
        try{
            
        }catch(QueryException $e)
        {
            \Log::info("Greska pri brisanju uloge ". $e->getMessage());
        }
    }
}

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

    public function GetSingle(Request $request)
    {
        $uloga = $this->ulogaModel->GetUloga($request->id);

        if(count($uloga) == 0)
        {
            abort(404);
        } 

        return $uloga;

    }

    public function InsertUloge(Request $request)
    {
        $this->ulogaModel->InsertUloge($request->nazivUlogeAdd);
        return redirect()->back()->with('uspesno','Uspesno ste dodali ulogu.');
    }

    public function EditUloge(Request $request)
    {
        try {
            $this->ulogaModel->Edit($request->ulogeEditId,$request->nazivEditUloge);
            return redirect()->back()->with('uspesno','Uspesno ste izmenili ulogu.');
        }catch(QueryException $e)
        {
            \Log::info("Greska pri editovanju uloge ". $e->getMessage());
        }
    }

    public function DeleteUloge(Request $request)
    {
        try{
           $data = $this->ulogaModel->GetIdUloge($request->id);
           
           if(count($data) == 0 )
           {
                $this->ulogaModel->DeleteU($request->id);
                abort(204);
           }else
           {
               abort(422);
           }
        }catch(QueryException $e)
        {
            \Log::info("Greska pri brisanju uloge ". $e->getMessage());
        }
    }
}

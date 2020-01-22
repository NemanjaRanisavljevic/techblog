<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PostModel;
use App\Model\KategorijeModel;
use App\Model\KomentarModel;
use App\Http\Requests\KomentariValidacija;

class SinglePostController extends Controller
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

    public function GetIdSingle(Request $request)
    {
       try {
        $kategorijeData = $this->kategorijeModel->GetKategorije();
        
        $postData = $this->postModel->GetIdPost($request->id);

        //dd($postData);

        if(empty($postData))
        {      
            return redirect()->back()->with("NotFoundPost","Ne postoji objava koju trazite.");
            
        }else
        {
            $komentari = $this->postModel->GetKomentari($request->id);
            // dd($komentari);
            
            $najKomentari = $this->komentarModel->GetNajkomentarisanije();
            
            return view('Pages/singlePost',['kategorije'=>$kategorijeData,'infoPost'=>$postData,'komentari'=>$komentari,'najkomentarisanije'=>$najKomentari]);
        }
       
       } catch (QueryException $e) {
        \Log::info("Greska pri ucitavanju id stranice". $e->getMessage());
       }
    }

    public function InsertKomentara(KomentariValidacija $request)
    {
        try
        {
            $this->komentarModel->idKorisnika = $request->idKorisnika;
            $this->komentarModel->idPosta = $request->id;
            $this->komentarModel->sadrzaj = $request->sadrzaj;
            
            $unetiKomentar = $this->komentarModel->InsertKomentar();

           
            $vreme = $unetiKomentar[0]->create_on;
            $datumNiz = explode(" ",$vreme);
            $datum = explode("-",$datumNiz[0]);
            $timestemp = mktime(0,0,0,$datum[1],$datum[2],$datum[0]);
            $datumPrikaz = date("j F, Y",$timestemp);

            $date = array(
                'ime' => $unetiKomentar[0]->ime,
                'prezime' => $unetiKomentar[0]->prezime,
                'putanja' => $unetiKomentar[0]->putanja,
                'sadrzaj' => $unetiKomentar[0]->sadrzaj,
                'datumPrikaz' => $datumPrikaz,
                'idKomentar' => $unetiKomentar[0]->idKomentar,
                'brojKomentara' => $request->brojKomentara + 1
            );

            return $date;

        }catch(QueryException $e)
        {
            \Log::info("Greska pri dohvatanju insertovanog komentara". $e->getMessage());
        }
    }

    public function DeleteKomentara(Request $request)
    {
        $obrisanKomentar = $this->komentarModel->DeleteKomenatar($request->id,$request->idPost);
        
        $data = array();
        foreach($obrisanKomentar as $x)
        {
            $vreme =$x->create_on;
            $datumNiz = explode(" ",$vreme);
            $datum = explode("-",$datumNiz[0]);
            $timestemp = mktime(0,0,0,$datum[1],$datum[2],$datum[0]);
            $datumPrikaz = date("j F, Y",$timestemp);

            $dataArrays = array(
                'idKorisnik' => $x->idKorisnik,
                'ime' => $x->ime,
                'prezime' => $x->prezime,
                'putanja' => $x->putanja,
                'sadrzaj' => $x->sadrzaj,
                'datumPrikaz' => $datumPrikaz,
                'idKomentar' => $x->idKomentar,
                'brojKomentara' => $request->brojKomentara - 1
            );
            array_push($data,$dataArrays);
        }
        
            return $data;
        
    }
}

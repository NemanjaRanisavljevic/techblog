<?php

namespace App\Http\Controllers;


use App\Http\Requests\LogovanjeValidacija;
use App\Http\Requests\ValidacijaRegistracija;
use App\Http\Requests\AdminAddValidacija;
use App\Http\Requests\AdminKorisnikEditValidacija;
use App\Model\KorisnikModel;
use App\Model\KategorijeModel;
use App\Model\PolModel;
use App\Model\UlogaModel;
use Facade\FlareClient\Http\Exceptions\NotFound;
use http\Client\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
Use \Carbon\Carbon;


class RegistracijaController extends Controller
{
    private $korisnikModel;
    private $polModel;
    private $ulogaModel;

    public function __construct()
    {
        $this->korisnikModel = new KorisnikModel();
        $this->polModel = new PolModel();
        $this->ulogaModel = new UlogaModel();
    }

    public function AdminPrikazKorisnika()
    {
        $korisnici = $this->korisnikModel->GetAllKorisnik();
        $polovi = $this->polModel->GetPol();
        $uloge =  $this->ulogaModel->GetAll();
        
        return view('Pages/admin/pocetna',['korisnici'=>$korisnici,'polovi'=>$polovi,'uloge'=>$uloge]);
    }

    public function GetKorisnikId(Request $request)
    {
        $korisnik = $this->korisnikModel->GetIdKorisnik($request->id);
        return $korisnik;
    }
    
    public function AdminAddKorisnika(Request $request)
    {
        
        $slika = $request->file("slikaKorisnikaAdminAdd");
        $slikaIme = $slika->getClientOriginalName();
        $slikaIme = time()."_".$slikaIme;

        public_path("upload");

        //dd($request);
        try
        {
            $slika->move(public_path("upload"),$slikaIme);

            $this->korisnikModel->ime = $request->imeAdd;
            $this->korisnikModel->prezime = $request->prezimeAdd;
            $this->korisnikModel->email = $request->emailAdd;
            $this->korisnikModel->sifra = md5($request->sifraAdd);
            $this->korisnikModel->pol = $request->ddlPolAdd;
            $this->korisnikModel->slikaIme = $slikaIme;
            $token =  md5($request->emailAdd);
            $this->korisnikModel->token =  $token;
            $this->korisnikModel->aktivan = $request->ddlAktivanAdd;
            $this->korisnikModel->ulodaId = $request->ddlUlogaAdd;

            $this->korisnikModel->InsertKorisnikAdmin();

           $mail = new PHPMailer(true);
            try
            {
                 $mail->SMTPDebug = 0;
                 $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
                 $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false,'allow_self_signed' => true));
                 $mail->isSMTP();
                 $mail->Host = 'smtp.gmail.com';  // backup
                 $mail->SMTPAuth = true;
                 $mail->Username = 'nemanjaranisavljevicsajt@gmail.com';
                 $mail->Password = 'nemanja@123456';
                 $mail->SMTPSecure = 'tls'; // tls enkripcija (moze i ssl)
                 $mail->Port = 587;
                 $mail->setFrom('nemanjaranisavljevicsajt@gmail.com', 'Tech-Blog registracija.');
                 $mail->addAddress($request->emailAdd);
                 // content
                 $mail->isHTML(true);
                 $mail->Subject = 'Kreiranje nalog!';
                 $mail->Body = 'Vasa sifra je '.$request->sifraAdd;
                 //PROMENJENO NA SERVERU POTANJA
                 $mail->send();

            }catch(QueryException $e)
            {
                \Log::info("Mail za Aktivaciju nije poslat!". $e->getMessage());
            }

            return redirect()->back();

        }catch(QueryException $e)
        {
            \Log::info("Mail za Aktivaciju nije poslat!". $e->getMessage());
        }
    }

    public function AdminEditKorinik(AdminKorisnikEditValidacija $request)
    {
        

        if($request->slikaKorisnikaAdminEdit != null)
        {
            $slika = $request->file("slikaKorisnikaAdminEdit");
            $slikaIme = $slika->getClientOriginalName();
            $slikaIme = time()."_".$slikaIme;

            public_path("upload");

            $slika->move(public_path("upload"),$slikaIme);
            $this->korisnikModel->slikaIme = $slikaIme;

        }
        
        
        try
        {
            if($request->sifraEdit == null)
            {
                $this->korisnikModel->ime = $request->imeEdit;
                $this->korisnikModel->prezime = $request->prezimeEdit;
                $this->korisnikModel->email = $request->emailEdit;
                $this->korisnikModel->pol = $request->ddlPolEdit;
                
                $this->korisnikModel->aktivan = $request->ddlAktivanEdit;
                $this->korisnikModel->ulodaId = $request->ddlUlogaEdit;
                $this->korisnikModel->idKorisnika = $request->korisnikIdEdit;
                $this->korisnikModel->idSlika = $request->slikaIdEdit;

                $this->korisnikModel->EditKorisnikaBezSifre();
                return redirect()->back()->with('uspesno','Uspesno ste izmenili korisnika.');
                
            }else
            {
                
                $request->validate([
                    'sifraEdit' => 'required|regex:/^[A-Z][\w\d]{5,}$/'
                ]);
                $this->korisnikModel->ime = $request->imeEdit;
                $this->korisnikModel->prezime = $request->prezimeEdit;
                $this->korisnikModel->email = $request->emailEdit;
                $this->korisnikModel->pol = $request->ddlPolEdit;
                
                $this->korisnikModel->sifra = md5($request->sifraEdit);
                $this->korisnikModel->aktivan = $request->ddlAktivanEdit;
                $this->korisnikModel->ulodaId = $request->ddlUlogaEdit;
                $this->korisnikModel->idKorisnika = $request->korisnikIdEdit;
                $this->korisnikModel->idSlika = $request->slikaIdEdit;

                $this->korisnikModel->EditKorisnikaSaSifre();
                return redirect()->back()->with('uspesno','Uspesno ste izmenili korisnika.');

            }


        }catch(QueryException $e){

            \Log::info("Edit korisnika!". $e->getMessage());
        }
    }

    public function RegistracijaPrikaz()
    {  
        $polovi = $this->polModel->GetPol();

        $kategorijaModel = new KategorijeModel();
        $kategorijeData = $kategorijaModel->GetKategorije();

        return view('Pages/registracija',["polovi"=>$polovi,'kategorije'=>$kategorijeData]);
    }

    public function PosRegistracija(ValidacijaRegistracija $request)
    {
        $slika = $request->file('slikaKorisnika');
        $slikaIme = $slika->getClientOriginalName();
        $slikaIme = time()."_".$slikaIme;

        public_path("upload");


        try
        {
            $slika->move(public_path("upload"),$slikaIme);

            $this->korisnikModel->ime = $request->imeReg;
            $this->korisnikModel->prezime = $request->prezimeReg;
            $this->korisnikModel->email = $request->emailReg;
            $this->korisnikModel->sifra = md5($request->sifraReg);
            $this->korisnikModel->pol = $request->polList;
            $this->korisnikModel->slikaIme = $slikaIme;
            $token =  md5($request->emailReg);
            $this->korisnikModel->token =  $token;

            $this->korisnikModel->InsertKorisnik();

            $mail = new PHPMailer(true);
            try
            {
                $mail->SMTPDebug = 0;
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  
                $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false,'allow_self_signed' => true));
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';  // backup
                $mail->SMTPAuth = true;
                $mail->Username = 'nemanjaranisavljevicsajt@gmail.com';
                $mail->Password = 'nemanja@123456';
                $mail->SMTPSecure = 'tls'; // tls enkripcija (moze i ssl)
                $mail->Port = 587;
                $mail->setFrom('nemanjaranisavljevicsajt@gmail.com', 'Tech-Blog registracija.');
                $mail->addAddress($request->emailReg);
                // content
                $mail->isHTML(true);
                $mail->Subject = 'Aktivirajte Vas nalog!';
                $mail->Body = 'Za aktivaciju vaseg naloga, kliknite na sledeci link: ' . "http://localhost/techblog/public/aktivacija/" . $token;
                //PROMENJENO NA SERVERU POTANJA
                $mail->send();

            }catch(QueryException $e)
            {
                \Log::info("Mail za Aktivaciju nije poslat!". $e->getMessage());
            }

            return redirect()->back();

        }catch(QueryException $e)
        {
            \Log::info("Mail za Aktivaciju nije poslat!". $e->getMessage());
        }
    }

    public function AktivacijaNaloga($token)
    {
        $this->korisnikModel->token = $token;
        $this->korisnikModel->Aktivacija();
        return redirect()->route('registracija')->with('uspesno','Uspesno ste aktivirali vas nalog. Hvala Vam!');
    }

    public function Logovanje(LogovanjeValidacija $request)
    {

        $email = $request->email;
        $sifra = $request->sifra;

        $sifra = md5($sifra);
        try
        {
            $korisnik = $this->korisnikModel->Logovanje($email,$sifra);

            if(empty($korisnik))
            {
                \Log::critical("Korisnik je pokusao da se uloguje, a ne postoji u bazi sa ip adresom -> " . $request->ip());
                abort(500);

            }else
            {
                $request ->session()->put('korisnik',$korisnik);
                var_dump(session()->has('korisnik'));
                
            }

        }catch (QueryException $e)
        {
            \Log::info("Greska pri logovanju.". $e->getMessage());
        }

    }

    public function Logout(Request $request)
    {
        $request->session()->forget('korisnik');   
        return redirect()->route('index');
    }

    public function BrisanjeKorisnika(Request $request)
    {
        try{
            $date = Carbon::now();

            $data = $this->korisnikModel->ProveraPostova($request->id);

            if(count($data) == 0 )
           {
                $this->korisnikModel->BrisanjeKorisnika($request->id,$date);
                abort(204);
           }else
           {
               abort(422);
           }

        }catch (QueryException $e)
        {
            \Log::info("Greska pri brisanju korisnika.". $e->getMessage());
        }
        
    }

}

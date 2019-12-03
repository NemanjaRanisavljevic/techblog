<?php

namespace App\Http\Controllers;


use App\Http\Requests\ValidacijaRegistracija;
use App\Model\KorisnikModel;
use App\Model\PolModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class RegistracijaController extends Controller
{
    private $korisnikModel;

    public function __construct()
    {
        $this->korisnikModel = new KorisnikModel();
    }

    public function RegistracijaPrikaz()
    {
         $polModel = new PolModel();
         $polovi = $polModel->GetPol();

        return view('Pages/registracija',["polovi"=>$polovi]);
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
                $mail->Password = 'beka123456';
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

    public function Logovanje(Request $request)
    {

        $email = $request->email;
        $sifra = $request->sifra;
        

        return var_dump($email);
    }


}
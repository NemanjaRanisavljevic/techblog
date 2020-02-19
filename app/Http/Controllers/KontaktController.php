<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\KategorijeModel;
use App\Model\KomentarModel;
use App\Http\Requests\KontaktValidacija;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class KontaktController extends Controller
{
    private $kategorijeModel;
    private $komentarModel;

    public function __construct()
    {
        $this->kategorijeModel = new KategorijeModel();
        $this->komentarModel = new KomentarModel();
    }
    public function PrikazKontakt()
    {
        $kategorijeData = $this->kategorijeModel->GetKategorije();

        $najKomentari = $this->komentarModel->GetNajkomentarisanije();

        return view('Pages/kontakt',['kategorije'=>$kategorijeData,'najkomentarisanije'=>$najKomentari]);
    }

    public function SlanjeEmaila(Request $request)
    {
        
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
        $mail->setFrom('nemanjaranisavljevicsajt@gmail.com', 'Tech-Blog kontakt.');
        $mail->addAddress('nemanjaranisavljevicsajt@gmail.com');
        // content
        $mail->isHTML(true);
        $mail->Subject = $request->naslovKontakt;
        $mail->Body = 'Korisnik ' . $request->imeKontakt . ' Email: ' . $request->emailKontakt . ' i broj telefona: ' . $request->telefonKontakt . ' sa porukom ' . $request->porukaKontakt;
        //PROMENJENO NA SERVERU POTANJA
        $mail->send();

        return redirect()->back()->with('kontakt','Usposno ste poslali poruku. Odgovaramo vam ubrzo.');

       }catch(QueryException $e)
       {
        \Log::info("Greska pri kontaktu". $e->getMessage());
       }
    }
}

$(document).ready(function(){
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    

});


$("#btnLog").click(function(e){
    e.preventDefault();
    var sifra = $("#sifraLog").val();
    var email = $("#emailLog").val();
    
    var regSifra =/^[A-Z][\w\d]{5,}$/;
    var greske = Array();
        

    if(email == "")
    {
        $("#emailLog").css({"border-color":"red"});
        $("#emailLog").focus(function(){
            $("#emailLog").css({"border-color":"#dadada"})
        });
        $.notify("Polje za Email je obavezno!","error");
    }

    if(!regSifra.test(sifra))
    {
        $("#sifraLog").css({"border-color":"red"});
        $("#sifraLog").focus(function(){
            $("#sifraLog").css({"border-color":"#dadada"})
        });
        $.notify("Niste dobro uneli Sifru!","error");
        greske.push("Greska sifra");
    }
    
    if(greske.length == 0)
    {
        $.ajax({
            url:'logovanje',
            type:'POST',
            data:{
                email:email,
                sifra:sifra
            },
            success:function (data) {
                $.notify("Uspesno ste se ulogovali","success");
                console.log(data);
            },
            error(xhr)
            {
                var status=xhr.status;
                switch(status)
                {
                    case 500:
                        alert("Greska na serveru.");
                        break;
                    case 404:
                        alert("Nije pronadjena stranica");
                        break;
                }
    
            }
        });
    
    }
    
    
});

function proveraRegistracije(){

    var ime = $("#imeReg").val();
    var prezime = $("#prezimeReg").val();
    var sifra = $("#sifraReg").val();
    var email = $("#emailReg").val();
    var pol = $("#polList").val();
    var slika = $("#slikaKorisnika").val();

    var regIme =/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}$/;
    var regPrezime =/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15}$/;
    var regSifra =/^[A-Z][\w\d]{5,}$/;

    var greske = Array();
    if(!regIme.test(ime))
    {
        $("#imeReg").css({"border-color":"red"});
        $("#imeReg").focus(function(){
            $("#imeReg").css({"border-color":"#dadada"})
        });
        $.notify("Niste dobro uneli Ime!","error");
        greske.push("Greska ime");
    }

    if(!regPrezime.test(prezime))
    {
        $("#prezimeReg").css({"border-color":"red"});
        $("#prezimeReg").focus(function(){
            $("#prezimeReg").css({"border-color":"#dadada"})
        });
        $.notify("Niste dobro uneli Prezime!","error");
        greske.push("Greska Prezime");
    }

    if(!regSifra.test(sifra))
    {
        $("#sifraReg").css({"border-color":"red"});
        $("#sifraReg").focus(function(){
            $("#sifraReg").css({"border-color":"#dadada"})
        });
        $.notify("Niste dobro uneli Sifru!","error");
        greske.push("Greska sifra");
    }

    if(email == "")
    {
        $("#emailReg").css({"border-color":"red"});
        $("#emailReg").focus(function(){
            $("#emailReg").css({"border-color":"#dadada"})
        });
        $.notify("Polje za Email je obavezno!","error");
    }

    if(pol==0)
    {
        $("#polList").css({"border-color":"red"});
        $("#polList").focus(function(){
            $("#polList").css({"border-color":"#dadada"})
        });
        $.notify("Morate izabrati Pol!","error");
        greske.push("Greska pol");
    }

    if(slika == "")
    {
        $.notify("Morate izabrati vasu sliku!","error");
        greske.push("Greska pol");
    }

    if(greske.length == 0)
    {
        $.notify("Uspesno ste se registrovali. Posetite vas email radi aktivacije naloga.","success");
        return true;
    }else
    {
        return false;
    }

};



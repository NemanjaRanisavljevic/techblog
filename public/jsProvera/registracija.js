$(document).ready(function(){
    
    $("#btnReg").click(function(){
        
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


    });

});
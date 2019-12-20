function ProveraKontakta()
{
    var ime = $("#imeKontakt").val();
    var email = $('#emailKontakt').val();
    var telefon = $('#telefonKontakt').val();
    var naslov = $('#naslovKontakt').val();
    var poruka = $('#porukaKontakt').val();

    var greske = Array();

    var regNaslov =/^[A-ZČĆŽŠĐ][\s0-9A-zčćžšđ]{5,}$/;
    var regIme =/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}$/;
    var regBroj =/^[0-9]{2,}$/;

    if(!regNaslov.test(naslov))
    {
        $("#naslovKontakt").css({"border-color":"red"});
        $("#naslovKontakt").focus(function(){
            $("#naslovKontakt").css({"border-color":"#dadada"})
        });
        $.notify("Polje za Naslov je obavezno i minimum mora da ima 5 karaktera i pocne velikim slovom!","error");
        greske.push("Greska naslov");
    }

    if(!regIme.test(ime))
    {
        $("#imeKontakt").css({"border-color":"red"});
        $("#imeKontakt").focus(function(){
            $("#imeKontakt").css({"border-color":"#dadada"})
        });
        $.notify("Niste dobro uneli Ime!","error");
        greske.push("Greska ime");
    }

    if(email == "")
    {
        $("#emailKontakt").css({"border-color":"red"});
        $("#emailKontakt").focus(function(){
            $("#emailKontakt").css({"border-color":"#dadada"})
        });
        $.notify("Polje za Email je obavezno!","error");
        greske.push("Greska email");
    }

    if(!regBroj.test(telefon))
    {
        $("#telefonKontakt").css({"border-color":"red"});
        $("#telefonKontakt").focus(function(){
            $("#telefonKontakt").css({"border-color":"#dadada"})
        });
        $.notify("Polje za telefon je obavezno!","error");
        greske.push("Greska naslov");
    }

    if(poruka == "")
    {
        $("#porukaKontakt").css({"border-color":"red"});
        $("#porukaKontakt").focus(function(){
            $("#porukaKontakt").css({"border-color":"#dadada"})
        });
        $.notify("Polje za Poruku je obavezno!","error");
        greske.push("Greska email");
    }

    if(greske.length == 0)
    {
        return true;
    }else
    {
        return false;
    }

}
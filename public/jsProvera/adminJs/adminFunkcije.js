function DodavanjeKategorije()
{
    var naziv = $('#nazivKatAdd').val();
    
    var regNaziv =/^[A-ZČĆŽŠĐ][\s0-9A-zčćžšđ]{2,}$/;
    var greske = Array();

    if(!regNaziv.test(naziv))
    {
        $("#nazivKatAdd").css({"border-color":"red"});
        $("#nazivKatAdd").focus(function(){
            $("#nazivKatAdd").css({"border-color":"#dadada"})
        });
        $.notify("Polje za Naziv je obavezno i minimum mora da ima 2 karaktera i pocne velikim slovom!","error");
        greske.push("Greska naslov");
    }

    if(greske.length !=0)
    {
        return false;
    }
    else
    {
        
        return true;      
    }
    
}
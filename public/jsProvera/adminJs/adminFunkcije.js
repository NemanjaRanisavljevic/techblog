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

function EditovanjeKategorije()
{
    var naziv = $('#nazivEditKategorije').val();
    
    var regNaziv =/^[A-ZČĆŽŠĐ][\s0-9A-zčćžšđ]{2,}$/;
    var greske = Array();

    if(!regNaziv.test(naziv))
    {
        $("#nazivEditKategorije").css({"border-color":"red"});
        $("#nazivEditKategorije").focus(function(){
            $("#nazivEditKategorije").css({"border-color":"#dadada"})
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
function DodavanjeUloge()
{
    var naziv = $('#nazivUlogeAdd').val();
    
    var regNaziv =/^[A-ZČĆŽŠĐ][\s0-9A-zčćžšđ]{2,}$/;
    var greske = Array();

    if(!regNaziv.test(naziv))
    {
        $("#nazivUlogeAdd").css({"border-color":"red"});
        $("#nazivUlogeAdd").focus(function(){
            $("#nazivUlogeAdd").css({"border-color":"#dadada"})
        });
        $.notify("Polje za naziv je obavezno, mora da pocne velikim slovom!","error");
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
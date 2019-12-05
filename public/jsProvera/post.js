function CreatePost() 
{
    var kategorije = $("#ddlKategorija").val();
    var naslov = $("#naslov").val();
    var slika = $("#slikaObjava").val();
    var opis = $("#opis").val();

    var greske = Array();

    var regNaslov =/^[A-ZČĆŽŠĐ][\s0-9A-zčćžšđ]{10,}$/;

    if(!regNaslov.test(naslov))
    {
        $("#naslov").css({"border-color":"red"});
        $("#naslov").focus(function(){
            $("#naslov").css({"border-color":"#dadada"})
        });
        $.notify("Polje za Naslov je obavezno i minimum mora da ima 10 karaktera i pocne velikim slovom!","error");
        greske.push("Greska naslov");
    }

    if(opis=="")
    {
        $("#opis").css({"border-color":"red"});
        $("#opis").focus(function(){
            $("#opis").css({"border-color":"#dadada"})
        });
        $.notify("Polje za Opis je obavezno","error");
        greske.push("Greska opis");

    }
    if(kategorije =="0")
    {
        $("#ddlKategorija").css({"border-color":"red"});
        $("#ddlKategorija").focus(function(){
            $("#ddlKategorija").css({"border-color":"#dadada"})
        });
        $.notify("Morate izabrati kategoriju!","error");
        greske.push("Greska kategorija");

    }

    if(slika == "")
    {
        $.notify("Morate izabrati sliku!","error");
        greske.push("Greska slika");
    }


    if(greske.length !=0)
    {
        return false;
    }
    else
    {
        $.notify("Uspesno ste postavili objavu.","success");
        return true;      
    }


    
}
$(document).ready(function(){
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


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

        if(greske == 0)
        {
            $.ajax({
                url:'registracija',
                type:'POST',
                data:{
                    ime:ime,
                    prezime:prezime,
                    sifra:sifra,
                    email:email,
                    pol:pol,
                    slika:slika
                },
                success:function(data){

                    // $("#ime").val("");
                    // $("#prezime").val("");
                    // $("#sifra").val("");
                    // $("#email").val("");
                    // $("#ddlPol").val("0");
                    
                    $.notify("Uspesno ste se registrovali. Posetite vas email radi aktivacije naloga.","success");

                },
                error:function(xhr,statusTxt,errors)
                {
                    var status=xhr.status;
                    var greske = xhr.responseJSON.errors;

                    var ispis="<ul>";
                    $.each(greske,function (greska, value) {
                        ispis +="<li>"+ value +"</li>";

                    });
                    ispis +="</ul>";
                    $('.ispisGresaka').html(ispis);

                    switch(status)
                    {
                        case 500:
                            alert("Greska na serveru.Trenutno niste u mogucnosti da se registrujete");
                            break;
                        case 404:
                            alert("Pogresili ste unos nekog elementa forme");

                            break;
                    }
                }
            });
        }


    });

});
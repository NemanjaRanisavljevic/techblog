$(document).ready(function(){
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    

});

$(".btnBrisanjeKorisnika").click(function () {
    var idKorisnika = $(this).attr('data-id');
    console.log(idKorisnika);
    $.ajax({
        url: baseUrl + '/admin/id',
        type:'PUT',
        data:{
            id:idKorisnika
        },
        success:function (data) {
            location.reload(true); 
            
        },
        error(xhr)
        {
            
            var status=xhr.status;
            switch(status)
            {
                case 500:
                    console.log("Greska na serveru.");
                    break;
                case 404:
                    console.log("Nije pronadjena stranica");
                    break;
            }

        }
    });

});

$(".btnBrisanjeObjave").click(function () {
    var idObjave = $(this).attr('data-id');
    console.log(idObjave);
    $.ajax({
        url: baseUrl + '/admin-post',
        type:'POST',
        data:{
            id:idObjave
        },
        success:function (data) {
            location.reload(true); 
        },
        error(xhr)
        {
            
            var status=xhr.status;
            switch(status)
            {
                case 500:
                    console.log("Greska na serveru.");
                    break;
                case 404:
                    console.log("Nije pronadjena stranica");
                    break;
            }

        }
    });

});

$(".btnBrisanjeKategorija").click(function () {
    var idKategorije = $(this).attr('data-id');
    
    $.ajax({
        url: baseUrl + '/admin-kategorije/id',
        type:'POST',
        data:{
            id:idKategorije
        },
        success:function (data) {
            
            location.reload(true); 
        },
        error(xhr)
        {
            var status=xhr.status;
            switch(status)
            {
                case 500:
                    console.log("Greska na serveru.");
                    break;
                case 404:
                    console.log("Nije pronadjena stranica");
                    break;
                case 422:
                    $.notify("Nije moguce obrisati kategoriju postoje objave!","error");
                    break;
            }

        }
    });

});

$(".btnEditKorisnika").click(function () {
    var idKorisnika = $(this).attr('data-id');
    
    $.ajax({
        url: baseUrl + '/admin/id',
        type:'GET',
        data:{
            id:idKorisnika
        },
        success:function (data) {
            $("#korisnikIdEdit").val(idKorisnika);
            $("#imeEdit").val(data[0].ime);
            $("#imeEdit").val(data[0].ime);
            $("#prezimeEdit").val(data[0].prezime);
            $("#emailEdit").val(data[0].email);
            $("#ddlPolEdit").val(data[0].idPol);
            $("#slikaPostaEdit").val(data[0].putanja);
            $("#slikaIdEdit").val(data[0].idSlika);
            $('#ddlUlogaEdit').val(data[0].IdUloga);
            $('#ddlAktivanEdit').val(data[0].aktivan);
            
        },
        error(xhr)
        {
            
            var status=xhr.status;
            switch(status)
            {
                case 500:
                    console.log("Greska na serveru.");
                    break;
                case 404:
                    console.log("Nije pronadjena stranica");
                    break;
            }

        }
    });

});

$(".btnEditKategorije").click(function () {
    var idKategorije = $(this).attr('data-id');
    
    $.ajax({
        url: baseUrl + '/admin-kategorije/id',
        type:'GET',
        data:{
            id:idKategorije
        },
        success:function (data) {          
            $("#kategorijaEditId").val(idKategorije);
            $("#nazivEditKategorije").val(data[0].nazivKategorije);
        },
        error(xhr)
        {
            
            var status=xhr.status;
            switch(status)
            {
                case 500:
                    console.log("Greska na serveru.");
                    break;
                case 404:
                    console.log("Nije pronadjena stranica");
                    break;
            }

        }
    });

});

$(".btnEditObjave").click(function () {
    var idObjave = $(this).attr('data-id');
    
    $.ajax({
        url: baseUrl + '/admin-post/id',
        type:'GET',
        data:{
            id:idObjave
        },
        success:function (data) {          
            $("#objaveIdEdit").val(idObjave);
            $("#naslovEdit").val(data[0].naslov);
            $("#opisEdit").val(data[0].opis);
            $("#korisnikIdEdit").val(data[0].idKorisnik);
            $("#slikaIdEditObj").val(data[0].slikaId);
            $("#putanjaEditObj").val(data[0].putanja);
        },
        error(xhr)
        {
            
            var status=xhr.status;
            switch(status)
            {
                case 500:
                    console.log("Greska na serveru.");
                    break;
                case 404:
                    console.log("Nije pronadjena stranica");
                    break;
            }

        }
    });

});

$(".btnBrisanjeUloge").click(function () {
    var idUloge = $(this).attr('data-id');
    
    $.ajax({
        url: baseUrl + '/admin-uloge/id',
        type:'POST',
        data:{
            id:idUloge
        },
        success:function (data) {
             location.reload(true); 
        },
        error(xhr)
        {
            var status=xhr.status;
            switch(status)
            {
                case 500:
                    console.log("Greska na serveru.");
                    break;
                case 404:
                    console.log("Nije pronadjena stranica");
                    break;
                case 422:
                    $.notify("Nije moguce obrisati ulogu postoje korisnici sa tom uloge!","error");
                    break;
            }

        }
    });

});

$(".btnEditUloge").click(function () {
    var idUloge = $(this).attr('data-id');
    
    $.ajax({
        url: baseUrl + '/admin-uloge/id',
        type:'GET',
        data:{
            id:idUloge
        },
        success:function (data) {   
                   
            $("#ulogeEditId").val(idUloge);
            $("#nazivEditUloge").val(data[0].naziv);
            
        },
        error(xhr)
        {
            
            var status=xhr.status;
            switch(status)
            {
                case 500:
                    console.log("Greska na serveru.");
                    break;
                case 404:
                    console.log("Nije pronadjena uloga");
                    break;
            }

        }
    });

});
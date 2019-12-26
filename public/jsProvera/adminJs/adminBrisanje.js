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
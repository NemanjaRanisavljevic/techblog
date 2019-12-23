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
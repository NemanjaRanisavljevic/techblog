$(document).ready(function() {
    


    $.ajax({
        url: baseUrl +'/kat-nav/id',
        type:'GET',
        data:{
            id:1
        },
        success:function (data) {
            var ispis='';
            $.each(data,function(index,value) {

            ispis += `<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="blog-box"> 
                            <div class="post-media">
                                <a href="${baseUrl}/single-post/${value.idPost}" title="">
                                    <img src="${baseUrl}/upload/${value.putanja}" alt="${value.nazivKategorije}" class="img-fluid">
                                        <div class="hovereffect"></div>
                                        <span class="menucat"> ${value.nazivKategorije} <span>
                                </a>
                            </div>
                            <div class="blog-meta">
                                <h4><a href="${baseUrl}/single-post/${value.idPost}" title=""> ${value.naslov} </a></h4>
                            </div>
                        </div>
                    </div>`;
            });

            var wrapper = document.getElementById("ispisNavKat");
            wrapper.innerHTML = ispis;
            
      
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


$(".linkSlajder").click(function () {
    var idKategorije = $(this).attr('data-id');
   
    $.ajax({
        url: baseUrl + '/kat-nav/id',
        type:'GET',
        data:{
            id:idKategorije
        },
        success:function (data) {
            var ispis='';
            $.each(data,function(index,value) {

            ispis += `<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                        <div class="blog-box"> 
                            <div class="post-media">
                                <a href="${baseUrl}/single-post/${value.idPost}" title="">
                                    <img src="${baseUrl}/upload/${value.putanja}" alt="${value.nazivKategorije}" class="img-fluid">
                                        <div class="hovereffect"></div>
                                        <span class="menucat"> ${value.nazivKategorije} <span>
                                </a>
                            </div>
                            <div class="blog-meta">
                                <h4><a href="${baseUrl}/single-post/${value.idPost}" title=""> ${value.naslov} </a></h4>
                            </div>
                        </div>
                    </div>`;
            });

            var wrapper = document.getElementById("ispisNavKat");
            wrapper.innerHTML = ispis;
            
      
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


$('#btnKomentar').click(function(){
    
    var idPost = $('#skriveniIdPosta').val();
    var komentar = $('#txtKomentar').val();
    var idKorisnika = $('#skriveniIdKorisnika').val();
    var brojKomentara = $('#skriveniBrKomentara').val();

    var greske = Array();

    if(komentar=="" || komentar==" ")
    {
        $("#txtKomentar").css({"border-color":"red"});
        $("#txtKomentar").focus(function(){
            $("#txtKomentar").css({"border-color":"#dadada"})
        });
        $.notify("Niste dobro uneli Komentar!","error");
        greske.push("Greska Komentar");
    }

    if(greske.length == 0)
    {
        $.ajax({
            url: baseUrl + '/komentar',
            type:'POST',
            data:{
                id:idPost,
                sadrzaj:komentar,
                idKorisnika:idKorisnika,
                brojKomentara:brojKomentara
            },
            success:function (data) {
                
                $('#txtKomentar').val("");
                var ispis='';
                
                ispis += ` <h4 class="small-title">${data.brojKomentara} Komentara</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="comments-list">
                            <div class="media">
                                <a class="media-left" href="#">
                                    <img src="${baseUrl}/upload/${data.putanja}" alt="" class="rounded-circle">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading user_name">${data.ime} ${data.prezime}<small>${data.datumPrikaz}</small></h4>
                                    <p>${data.sadrzaj}</p>
                                    <!-- <a href="#" class="btn btn-primary btn-sm">Reply</a> -->
                                </div>
                            </div>
                           
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->`;
                
    
                var wrapper = document.getElementById("ispisKomentara");
                wrapper.innerHTML += ispis;
               
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
                        $.notify("Polje za komentar je obavezno.","error");
                        break;
                }
    
            }
        });

    }

});
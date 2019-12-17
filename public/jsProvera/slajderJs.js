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
                komentar:komentar
            },
            success:function (data) {
                var ispis='';
                // $.each(data,function(index,value) {
    
                // ispis += `<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                //             <div class="blog-box"> 
                //                 <div class="post-media">
                //                     <a href="${baseUrl}/single-post/${value.idPost}" title="">
                //                         <img src="${baseUrl}/upload/${value.putanja}" alt="${value.nazivKategorije}" class="img-fluid">
                //                             <div class="hovereffect"></div>
                //                             <span class="menucat"> ${value.nazivKategorije} <span>
                //                     </a>
                //                 </div>
                //                 <div class="blog-meta">
                //                     <h4><a href="${baseUrl}/single-post/${value.idPost}" title=""> ${value.naslov} </a></h4>
                //                 </div>
                //             </div>
                //         </div>`;
                // });
    
                // var wrapper = document.getElementById("ispisNavKat");
                // wrapper.innerHTML = ispis;
                
          
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

    }

});
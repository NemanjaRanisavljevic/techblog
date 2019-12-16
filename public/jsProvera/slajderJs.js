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
                                <a href="tech-single.html" title="">
                                    <img src="${baseUrl}/upload/${value.putanja}" alt="${value.nazivKategorije}" class="img-fluid">
                                        <div class="hovereffect"></div>
                                        <span class="menucat"> ${value.nazivKategorije} <span>
                                </a>
                            </div>
                            <div class="blog-meta">
                                <h4><a href="tech-single.html" title=""> ${value.naslov} </a></h4>
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
                    alert("Greska na serveru.");
                    break;
                case 404:
                    alert("Nije pronadjena stranica");
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
                                <a href="tech-single.html" title="">
                                    <img src="${baseUrl}/upload/${value.putanja}" alt="${value.nazivKategorije}" class="img-fluid">
                                        <div class="hovereffect"></div>
                                        <span class="menucat"> ${value.nazivKategorije} <span>
                                </a>
                            </div>
                            <div class="blog-meta">
                                <h4><a href="tech-single.html" title=""> ${value.naslov} </a></h4>
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
                    alert("Greska na serveru.");
                    break;
                case 404:
                    alert("Nije pronadjena stranica");
                    break;
            }

        }
    });

});
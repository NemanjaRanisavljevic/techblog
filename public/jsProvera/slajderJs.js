$(".linkSlajder").click(function () {
    var idKategorije = $(this).attr('data-id');
    
    $.ajax({
        url:'kat-nav/id',
        type:'GET',
        data:{
            id:idKategorije
        },
        dataType: "json",
        success:function (data) {
            console.log(data)
            
                var ispis='';
                $.each(data,function(index,value) {
            //     ispis += '<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">'+
            //     '<div class="blog-box">'+
            //         '<div class="post-media">'+
            //             '<a href="tech-single.html" title="">'+
            //                 '<img src="upload/tech_menu_09.jpg" alt="" class="img-fluid">'+
            //                 '<div class="hovereffect">'+
            //                 '</div>'+
            //                 '<span class="menucat">'+value.nazivKategorije+'</span>'+
            //             '</a>'+
            //         '</div>'+
            //         '<div class="blog-meta">'+
            //             '<h4><a href="tech-single.html" title="">'+value.naslov+'</a></h4>'+
            //         '</div>'+
            //     '</div>'+
            // '</div>'
            
            ispis += ` <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12" style="background: pink; height: 200px; width: auto;">
                            <div class="blog-box"> 
                                <div class="post-media">
                                    <a href="tech-single.html" title="">
                                        <img src="upload/tech_menu_09.jpg" alt="" class="img-fluid">
                                            <div class="hovereffect"></div>
                                            <span class="menucat"> ${value.nazivKategorije} <span>
                                    </a>
                                </div>
                                <div class="blog-meta">
                                    <h4><a href="tech-single.html" title=""> ${value.naslov} </a></h4>
                                </div>
                            </div>
                        </div> `
                });

                console.log(ispis);

        
            
            // var wrapper = document.getElementById("ispisNavKat");
            //     wrapper.innerHTML = ispis;
            //     console.log(wrapper)
      
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
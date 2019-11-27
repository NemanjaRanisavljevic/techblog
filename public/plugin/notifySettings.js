$(document).ready(function ()
{

    $.notify.defaults({ position: "bottom right" });

    $("#dugme").click(function () {
        $.notify("Niste dobro uneli ime!","error");
    });


});

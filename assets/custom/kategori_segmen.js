$(document).ready(function() {
    // $(this).attr("id").inputmask('Rp 999.999.999', { numericInput: true });
    var message_status = $("#status");
    var base_url = window.location.origin+"/ba-promina";
    $("td[contenteditable=true]").inputmask('Rp 999.999.999', { numericInput: true });
    $("td[contenteditable=true]").blur(function(){
        var id_kat = $(this).attr("id");
        var value = $(this).text();

        $.post(base_url+'/kategori_segmen.jsp' , id_kat + "=" + value, function(data){
            if(data != '')
            {
                message_status.show();
                message_status.text(data);
                setTimeout(function(){message_status.hide()},3000);
            }
        });
    });    
});
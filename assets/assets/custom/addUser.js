  $(function() {
    $('#row_status').hide(); 
    $('#row_toko').hide(); 
    $('#row_cabang').hide(); 
    $('#row_kota').hide(); 
    $('#akses').change(function(){
        if($('#akses').val() == '1') {
            $('#row_status').show();
            $('#row_cabang').hide(); 
            $("#row_kota").hide();
            // $('#status').change(function(){
            //     if($('#status').val() != "") {
                    $('#row_toko').show(); 
            //     } else {
            //         $('#row_toko').hide(); 
            //     }
            // });
        }
        else if ($('#akses').val() == '0') {
            $('#row_status').hide();  
            $('#row_toko').hide();
                        $("#row_kota").show();
            $('#row_cabang').show();
            if ($("#akses").val() == "") {
                $('#row_cabang').hide(); 
            }
            else{
                $("#cabang").change(function() {
                    if ($(this).val() == "") {
                        $("#row_kota").show();
                    }
                    else{
                        var base_url = window.location.origin;
                        $("#row_kota").show();
                        $.ajax({
                           type: "POST",
                           url: base_url+"/api/filterkota?key=ganteng",
                           data: {id_cabang:$(this).val()},
                           dataType: 'json',
                           success:function(datas) {
                            console.log(datas);
                            var data = "";
                            data += "<option value='pilih'>-Pilih Kota-</option>";
                            for (var i = datas.length - 1; i >= 0; i--) {
                                data += "<option value='"+datas[i]['id_kota']+"''>"+datas[i]['nama_kota']+"</option>";
                            }
                            $("#kota").html(data);
                        }
                    })
                    }
                })
            }
        } 
        else {
            $('#row_status').hide();  
            $('#row_cabang').hide();
            $('#row_toko').hide();
            $("#row_kota").hide();
        } 
    });

    $('#toko').select2({

    });
});
$("#a").validate({
    rules: {
        startDate: "required",
        endDate: "required",
    },
    messages: {
        startDate: "Please enter your startDate",
        endDate: "Please enter your endDate",
        
    },
    submitHandler: function(form) {
    var base_url = window.location.origin;
    var fields = $(":input").serializeArray();
    
    var url = base_url+"/api/dContactExcel/?key=ganteng&ba="+ fields[1].value+"&toko="+ fields[2].value+"&cabang="+fields[3].value+"&kota="+ fields[4].value+"&startDate="+ fields[5].value+"&endDate="+ fields[6].value;
    $.ajax({
        type: "POST",
        url: base_url+"/api/CountTotalContact?key=ganteng",
        data: { "ba" : fields[1].value, "toko" : fields[2].value, "cabang" : fields[3].value, "kota" : fields[4].value, "startDate" : fields[5].value, "endDate" : fields[6].value},
        dataType: 'json',
        success : function(data) {
            var datas = "";
            var aaa = "";
                datas += "";
                for (var i = data.length - 1; i >= 0; i--) {
                    // datas += "<tr><td>No</td>";
                    datas += "<tr>";
                    datas += "<td>"+data[i]['nama_cabang']+"</td>";
                    datas += "<td>"+data[i]['nama_user']+"</td>";
                    if (data[i]['stay_user'] == "Y") {
                        datas += "<td>Stay</td>";
                    }
                    if (data[i]['stay_user'] == "N") {
                        datas += "<td>Mobile</td>";
                    };
                    datas += "<td>"+data[i]['stay_user']+"</td>";
                    datas += "<td>"+data[i]['nama_toko']+"</td>";

                    datas += "<td>"+data[i]['contact_count']+"</td>";
                    datas += "<td>"+data[i]['count_switching']+"</td>";
                    datas += "<td>"+data[i]['count_recruit']+"</td>";
                    
				    // datas += "<td>"+data[i]['count_sampling']+"</td>";
                    
                    datas += "<td> "+data[i]['BC']+"</td>";
                    // datas += "<td>"+data[i]['tipe']+"</td>";
                    datas += "<td>"+data[i]['BTI']+"</td>";
                    datas += "<td>"+data[i]['Rusk']+"</td>";
                    // datas += "<td>"+data[i]['tipe']+"</td>";
                    datas += "<td>"+data[i]['Pudding']+"</td>";
                    datas += "<td>"+data[i]['Others']+"</td>";
                    
                    datas += "<td>"+data[i]['strike_sampling']+"</td>";
                    // datas += "<td>"+data[i]['sampling']+"</td>";
                    // datas += "<td>"+data[i]['segmen']+"</td>";
                    // datas += "<td>"+data[i]['sada_kategori_label']+"</td></tr>";
                    aaa += "<td>"+data[i]['sada_kategori_label']+"</td>";
                }
                $("#excelCDetail").attr('href',url);
                $("#dataContactTotal").html(datas);    
                // $("#sampling").append(aaa);    
           }
        })
    }
});
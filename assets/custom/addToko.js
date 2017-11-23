$("#addToko").validate({
    // var base_url = window.location.origin+"/ba-promina";
    rules: {
        store_id: "required",
        kota: "required",
        nama: "required",
    },
    messages: {
        store_id: "Please enter your storeId",
        kota: "Please enter your kota",
        nama: "Please enter your name",
        
    },
    submitHandler: function(form) {
        // console.log("yes");

        var base_url = window.location.origin+"/ba-promina";
        var fields = $(":input").serializeArray();
        var arr = {"store_id" : fields[1].value, "kota" : fields[2].value, "toko" : fields[3].value};
        $.ajax({
            "url": base_url+"/toko/add.jsp",
            "type": "POST",
            "data" : arr,
            success : function(data) {
                window.location.href = window.location.origin+"/ba-promina"+'/toko.jsp';
            }
        });
    }
});
$("#addTargetToko").validate({
    // var base_url = window.location.origin+"/ba-promina";
    rules: {
        id_toko: "required",
        kategori_target: "required",
        target: "required",
    },
    messages: {
        id_toko: "Please enter your storeId",
        kategori_target: "Please enter target type",
        target: "Please enter your target",
        
    },
    submitHandler: function(form) {
        // console.log("yes");

        var base_url = window.location.origin+"/ba-promina";
        var fields = $(":input").serializeArray();
        var arr = {"id_toko" : fields[1].value, "kategori_target" : fields[2].value, "target" : fields[3].value};
        $.ajax({
            "url": base_url+"/tokoAddTarget/add.jsp",
            "type": "POST",
            "data" : arr,
            success : function(data) {
                window.location.href = window.location.origin+"/ba-promina"+'/toko/target/'+arr.id_toko+".jsp";
            }
        });
    }
});

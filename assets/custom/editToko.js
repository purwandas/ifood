$("#editToko").validate({
    // var base_url = window.location.origin+"/ba-promina";
    rules: {
        store_id: "required",
        kota: "required",
        nama: "required",
        id_toko: "required",
    },
    messages: {
        id_toko: "Please enter your id_toko",
        store_id: "Please enter your storeId",
        kota: "Please enter your kota",
        nama: "Please enter your name toko",
    },
    submitHandler: function(form) {
        console.log("yes");
        var fields = $(":input").serializeArray();

        var base_url = window.location.origin+"/ba-promina";
        var arr = {"id_toko" : fields[1].value, "store_id" : fields[2].value, "toko" : fields[3].value, "kota" : fields[4].value};
        // console.log(arr);
        $.ajax({
            "url": base_url+"/toko/edit/"+arr.id_toko+".jsp",
            "type": "POST",
            "data" : arr,
            success : function(data) {
                window.location.href = window.location.origin+"/ba-promina"+'/toko.jsp';
            }
        });
    }
});
$("#editTarget").validate({
    rules: {
        nama: "required",
        kategori_target: "required",
        target: "required",
    },
    messages: {
        nama: "Please enter your id_toko",
        kategori_target: "Please enter your storeId",
        target: "Please enter target",
    },
    submitHandler: function(form) {
        console.log("yes");
        // var fields = $(":input").serializeArray();

        // var base_url = window.location.origin+"/ba-promina";
        // var arr = {"id_toko" : fields[1].value, "store_id" : fields[2].value, "toko" : fields[3].value, "kota" : fields[4].value};
        // // console.log(arr);
        // $.ajax({
        //     "url": base_url+"/toko/edit/"+arr.id_toko+".jsp",
        //     "type": "POST",
        //     "data" : arr,
        //     success : function(data) {
        //         window.location.href = window.location.origin+"/ba-promina"+'/toko.jsp';
        //     }
        // });
    }
});
});
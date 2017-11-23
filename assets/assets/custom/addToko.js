$("#addToko").validate({
    // var base_url = window.location.origin;
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
        var fields = $(":input").serializeArray();
        var arr = {"store_id" : fields[1].value, "kota" : fields[2].value, "toko" : fields[3].value};
        $.ajax({
            "url": "http://ba.promina.co.id/toko/add.jsp",
            "type": "POST",
            "data" : arr,
            success : function(data) {
                window.location.href = window.location.origin+'/toko.jsp';
            }
        });
    }
});
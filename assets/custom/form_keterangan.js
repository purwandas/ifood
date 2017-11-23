$("#form_keterangan").validate({
    // var base_url = window.location.origin+"/ba-promina";
    rules: {
        keterangan: "required",
    },
    messages: {
        keterangan: "Please enter your description",
        
    },
    submitHandler: function(form) {
        console.log("yes");

        var base_url = window.location.origin+"/ba-promina";
        var fields = $(":input").serializeArray();
        var arr = {"store_id" : fields[1].value, "kota" : fields[2].value, "toko" : fields[3].value};
        $.ajax({
            "url": base_url+"/keterangan/form_keterangan.jsp",
            "type": "POST",
            "data" : arr,
            "dataType" : 'json',
            success : function(data) {
                window.location.href = window.location.origin+"/ba-promina"+'/keterangan_oos.jsp';
            }
        });
    }
});
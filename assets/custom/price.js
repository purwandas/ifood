$(document).ready(function(){
	$("#price").inputmask('Rp 999.999.999', { numericInput: true });
	$("#priceInput").validate({
	rules: {
        price: "required",
    },
    messages: {
        price: "Please enter your price",
        
    },
    submitHandler: function(form) {
        console.log("yes");

        // var base_url = window.location.origin;
        // var fields = $(":input").serializeArray();
        // var arr = {"store_id" : fields[1].value, "kota" : fields[2].value, "toko" : fields[3].value};
        // $.ajax({
        //     "url": base_url+"/indofod/toko/add.jsp",
        //     "type": "POST",
        //     "data" : arr,
        //     success : function(data) {
        //         window.location.href = window.location.origin+'/indofod/toko.jsp';
        //     }
        // });
    }
	});    //123456  =>  € ___.__1.234,56
});
	$(function(){

    $('#errorcabang').hide();

    $('#errorkota').hide();



    $('#submitGo').on('click',function(e){

        e.preventDefault();

        var nama_kota = $('#inputKota').val();

        var nama_cabang = $('#inputCabang').val();

        console.log(nama_cabang);

        console.log(nama_kota);



        if(nama_kota == '' && nama_cabang == '0'){

          $('#errorcabang').show();

          $('#errorkota').show();

          return;

        }



        if(nama_kota == ''){

          $('#errorkota').show();

          $('#errorcabang').hide();

          return;

        }

        if(nama_cabang == '0'){

          $('#errorkota').hide();

          $('#errorcabang').show();

          return;

        }

        var base_url = window.location.origin+"/ba-promina";

        var arr = {"nama_cabang" : nama_cabang, "nama_kota" : nama_kota};



        $.post( base_url+"/kota/add.jsp" , arr, function() {

          console.log('post');

        }).done(function(){

          window.location.href = window.location.origin+"/ba-promina"+'/kota.jsp';

        });

    });





    // $('#addKota').validate({

		// 		rules:{

		// 			nama_kota : 'required',

		// 			nama_cabang :'required'

		// 		},

		// 		messages:{

		// 			nama_kota : 'Please Input the city name',

		// 			nama_cabang: 'Please Choose one of the area'

		// 		},

		// 		submitHandler: function(form) {

    //

		//         var base_url = window.location.origin+"/ba-promina";

		//         var fields = $(":input").serializeArray();

		//         var arr = {"nama_cabang" : fields[1].value, "nama_kota" : fields[2].value};

		//         $.ajax({

		//             "url": base_url+"/kota/add.jsp",

		//             "type": "POST",

		//             "data" : arr,

		//             success : function(data) {

		//                 window.location.href = window.location.origin+"/ba-promina"+'/dataKota.jsp';

		//             }

		//         });

		//     }

		// });

	});


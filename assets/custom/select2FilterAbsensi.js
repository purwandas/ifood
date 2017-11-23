$( document ).ready(function() {
  fetchBa();
  fetchToko();
  fetchTl();
  fetchCabang();
  $('#headerAbsensi').hide();
  var a = [];
  $('#tl').on('change',function(){
    var id_tl = this.value;
    $("#ba option[value]").remove();
    $("#toko option[value]").remove();
    $("#cabang option[value]").remove();
    $("#kota option[value]").remove();
    if(id_tl == '0'){
      fetchBa();
      fetchToko();
      fetchCabang();
      $('#kota').select2({
        data : [{id: 0, text : 'Kota'}],
      });
      return;
    }
    $('#ba').select2({
      data : [{id:0,text : 'BA'}],
    });

    $('#toko').select2({
      data : [{id:0,text : 'Toko'}],
    });
    var base_url = window.location.origin+"/ba-promina";
    var base_url_semmi = window.location.origin+"/ba-promina"+'';
    $.getJSON(base_url_semmi+'/api/getTlCabangAndkota?key=ganteng&id_tl='+id_tl,function(data){
      var arrCabang = [{id:0, text : 'Cabang'}];
      var arrKota = [{id:0, text : 'Kota'}];
      $.each(data,function(key,value){
          arrCabang.push({id : value.id_cabang, text : value.nama});
          arrKota.push({id : value.id_kota, text : value.nama_kota});
      });
      $('#cabang').select2({
        data : arrCabang,
      });
      $('#kota').select2({
        data : arrKota,
      });
    })
  });

  $('#ba').on('change',function(){
    var id_user = this.value;
    $("#toko option[value]").remove();
    if(id_user == '0'){
      fetchToko();
      return;
    }

    var base_url = window.location.origin+"/ba-promina";
    var base_url_semmi = window.location.origin+"/ba-promina"+'';
    $.getJSON(base_url_semmi+'/api/getAssignedStore?key=ganteng&id_user='+id_user,function(data){
      var arr = [{id:0, text : 'Toko'}];
      $.each(data,function(key,value){
          arr.push({id : value.id, text : value.nama});
          console.log(value);
      });
      $('#toko').select2({
        data : arr,
      });
    })
  });



  $('#toko').on('change',function(){
    var id_toko = this.value;
    $("#cabang option[value]").remove();
    if(id_toko == '0'){
      fetchCabang();
      return;
    }
    var base_url = window.location.origin+"/ba-promina";
    var base_url_semmi = window.location.origin+"/ba-promina"+'';
    $.getJSON(base_url_semmi+'/api/getCabangInKota?key=ganteng&id_toko='+id_toko,function(data){
      var arr = [{id : 0, text : 'Cabang'}];
      arr.push({id : data.id, text : data.nama});
      $('#cabang').select2({
        data : arr,
        placeholder: 'Nama Cabang'
      });
    })
  });



  $('#kota').select2({
    data : [{id:0, text :'Kota'}]
  });

    $('#cabang').on('change',function(){
      var id_cabang = this.value;
      $("#kota option[value]").remove();

      if(id_cabang == '0'){
        $('#kota').select2({
          data : [{id:0, text :'Kota'}]
        });
        console.log('Masuk Sini');
        return;
      }

      var base_url = window.location.origin+"/ba-promina";
      var base_url_semmi = window.location.origin+"/ba-promina"+'';
      $.getJSON(base_url_semmi+'/api/getKotaInCabang?key=ganteng&id_cabang='+id_cabang,function(data){
        var arr = [{id:0, text : 'Kota'}];
        $.each(data,function(key,value){
          console.log(value.id_kota);
            arr.push({id : value.id_kota, text : value.nama_kota});
        });
        $('#kota').select2({
          data : arr,
        });
      })
    });




    $('#filter').click(function(e){
        e.preventDefault();

        var baFilter = $('#ba').val();
        var tlFilter = $('#tl').val();
        var tokoFilter = $('#toko').val();
        var cabangFilter = $('#cabang').val();
        var kotaFilter = $('#kota').val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        var base_url = window.location.origin+"/ba-promina";
        var base_url_semmi = window.location.origin+"/ba-promina"+'';
        var filter={
          'ba' : baFilter,
          'tl' : tlFilter,
          'toko' : tokoFilter,
          'cabang' : cabangFilter,
          'kota' : kotaFilter,
          'startDate' : startDate,
          'endDate' : endDate
        };
        var data = '';
        $('#headerAbsensi').show();
        $.getJSON(base_url_semmi+'/api/getAbsensiHeader?key=ganteng&startDate='+startDate+'&endDate='+endDate,function(data){
          console.log(data);
          $.each(data,function(key,value){
            data += '<th>'+ value +'</th>';
          });
          $('#headerAbsensi').html(data);
        });
        // if($.fn.dataTable.isDataTable('#absensiDataTable')){
        //   $('#absensiDataTable').DataTable().clear();
        //   $('#absensiDataTable').DataTable().destroy();
        // }

        // $('#absensiDataTable').DataTable({
        //   processing : true,
        //   searching : false,
        //   scrollX : true,
        //   dom: 'Bfrtip',
        //   buttons : [
        //     {
        //       extend: 'excel',
        //       text: 'Download Excel',
        //       className :'btn green-soft'
        //     },
        //     {
        //       extend: 'pdf',
        //       text: 'Download Pdf',
        //       className :'btn red-sunglo'
        //     },
        //     {
        //       extend: 'print',
        //       text: 'Print',       
        //       className :'btn purple-plum'
        //     }
        //   ],
        //   ajax : {
        //     'url' : 'api/absensiReport?key=ganteng',
        //     'type' : 'POST',
        //     'data' : filter
        //   }
        // });

        $.post( "api/absensiReportRzl?key=ganteng", filter)
          .done(function( data ) {
            // console.log( "Data Loaded: " + data);
            var response = jQuery.parseJSON(data);
            // console.log(response);
            var data = '';
            var no = 0;
            console.log(response.data[0]);
            for(var i in response.data){
                data += '<tr>';
              for(var j in response.data[i]){
                data += ' <td>'+ response.data[i][j]+'</td>';
              }
              data += '</tr>';
            }
            $('#hasilFilter').html(data);
          })
          .error(function(data){
            alert('Error');
          });
    });
});

function fetchBa() {

  var base_url = window.location.origin+"/ba-promina";
  var base_url_semmi = window.location.origin+"/ba-promina"+'';
  $.getJSON(base_url_semmi+'/api/getBaName?key=ganteng',function(data){
    // console.log(JSON.stringify(data));
    var arr = [{id : 0, text : 'BA'}];
    $.each(data ,function(key,value){
      arr.push({id : key, text : value});
      console.log('hi');
    });
    $('#ba').select2({
      data : arr,
      placeholder: 'Nama ba'
    });
  });
}

function fetchToko() {
  var base_url = window.location.origin+"/ba-promina";
  var base_url_semmi = window.location.origin+"/ba-promina"+'';
  $.getJSON(base_url_semmi+'/api/getToko?key=ganteng',function(data){
    // console.log(JSON.stringify(data));
    var arr = [{id : 0, text : 'Toko'}];
    $.each(data ,function(key,value){
      arr.push({id : key, text : value});
      console.log('hi Start Toko');
    });
    $('#toko').select2({
      data : arr,
      placeholder: 'Nama toko'
    });
  });
}

function fetchCabang() {

  var base_url = window.location.origin+"/ba-promina";
  var base_url_semmi = window.location.origin+"/ba-promina"+'';
  $.getJSON(base_url_semmi+'/api/getAllCabang?key=ganteng',function(data){
    var arr = [{id : 0, text : 'Cabang'}];
    $.each(data ,function(key,value){
      arr.push({id : value.id_cabang, text : value.nama});
    });
    $('#cabang').select2({
      data : arr,
      placeholder: 'Nama toko'
    });
  });
}

function fetchTl() {
  var base_url = window.location.origin+"/ba-promina";
  var base_url_semmi = window.location.origin+"/ba-promina"+'';
  $.getJSON(base_url_semmi+'/api/getTl?key=ganteng',function(data){
    // console.log(JSON.stringify(data));
    var arr = [{id : 0, text : 'Tl'}];
    $.each(data ,function(key,value){
      arr.push({id : value.id_user, text : value.nama});
    });
    $('#tl').select2({
      data : arr,
      placeholder: 'Nama Tl'
    });
  });
}

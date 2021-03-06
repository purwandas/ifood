$( document ).ready(function() {
  fetchBa();
  fetchToko();
  fetchTl();
  fetchCabang();
  $('#sku_kat').select2({
      data : [{id:0,text : 'Tamplikan Semua'},
              {id:1,text : 'Akumulasi Box'},
              {id:2,text : 'Akumulasi Sachet'},
              {id:3,text : 'Detail Barang'}
            ]
    });
  $('#sku_kat').on('change',function(){
    $('#headerSku').hide();
    if($.fn.dataTable.isDataTable('#skuDataTable')){
      $('#skuDataTable').DataTable().clear();
      $('#skuDataTable').DataTable().destroy();
    }
    var filterKategori = $('#sku_kat').val();
    $.getJSON(base_url_semmi+'/api/getSkuHeader?key=ganteng&filter='+filterKategori,function(data){
      $.each(data,function(key,value){
        data += '<th>'+ value +'</th>';
        $('#headerSku').html(data);
      });
    })
  });
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
    $("#cabang option[value]").remove();
    if(id_user == '0'){
      fetchToko();
      fetchCabang();
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
    $.getJSON(base_url_semmi+'/api/getBranchFromName?key=ganteng&id_user='+id_user,function(data){
      var arr = [{id:0, text : 'Cabang'}];
      $.each(data,function(key,value){
          arr.push({id : value.id, text : value.nama});
      });
      $('#cabang').select2({
        data : arr,
      });
    })

  });



  $('#toko').on('change',function(){
    var id_toko = this.value;
    $("#cabang option[value]").remove();
    $("#kota option[value]").remove();
    $('#kota').select2({
      data : [{id:0, text :'Kota'}]
    });
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


  $('#target').keypress(function(e) {
    var data = $(this).val();
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errmsg").html("Hanya Angka").show().fadeOut("slow");
      return false;
    }
  });
  $('#kota').select2({
    data : [{id:0, text :'Kota'}]
  });
  $('#kota_toko').select2({
    data : [{id:0, text :'Kota'}]
  });
  $('#kategori_target').select2({
  });
  $("#nama-cabang").select2({
    data : [{id:0, text :'Cabang'}]
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

    $("#form_sku").validate({
    rules: {
        startDate: "required",
        endDate: "required",
    },
    messages: {
        startDate: "Please enter your startDate",
        endDate: "Please enter your endDate",

    },
    submitHandler: function(form) {
        // e.preventDefault();
        if($.fn.dataTable.isDataTable('#skuDataTable')){
          $('#skuDataTable').DataTable().clear();
          $('#skuDataTable').DataTable().destroy();
        }
        var baFilter = $('#ba').val();
        var tlFilter = $('#tl').val();
        var tokoFilter = $('#toko').val();
        var cabangFilter = $('#cabang').val();
        var kotaFilter = $('#kota').val();
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();
        var filterKategori = $('#sku_kat').val();
        var base_url = window.location.origin+"/ba-promina";
        var base_url_semmi = window.location.origin+"/ba-promina"+'';
        var href = base_url_semmi+'/api/excelReport?key=ganteng&ba='+baFilter+'&tl='+tlFilter+'&cabang='+cabangFilter+'&kota='+kotaFilter+'&startDate='+startDate+'&endDate='+endDate+'&toko='+tokoFilter;
        $('#excelDownload').attr('href',href);
        var filter={
          'ba' : baFilter,
          'tl' : tlFilter,
          'toko' : tokoFilter,
          'cabang' : cabangFilter,
          'kota' : kotaFilter,
          'startDate' : startDate,
          'endDate' : endDate,
          'filterKategori' : filterKategori
        };
        $('#headerSku').show();
        $('#skuDataTable').DataTable({
          processing : true,
          searching : false,
          scrollX : true,
          dom: 'Bfrtip',
          buttons : [
            {
              extend: 'excel',
              text: 'Download Excel',
              className :'btn green-soft'
            }
          ],
          ajax : {
            'url' : '/ba-promina/api/newFilterReportOptimization?key=ganteng',
            'type' : 'POST',
            'data' : filter
          }
        });
    }
  });
    var base_url_semmi = window.location.origin+"/ba-promina"+'';
    var data = '';
    var filterKategori = $('#sku_kat').val();
    $.getJSON(base_url_semmi+'/api/newGetSkuHeader?key=ganteng&filter='+filterKategori,function(data){
      $.each(data,function(key,value){
        data += '<th>'+ value +'</th>';
        $('#headerSku').html(data);
      });
    })
    $('#headerSku').hide();
});

function fetchBa() {

  var base_url = window.location.origin+"/ba-promina";
  var base_url_semmi = window.location.origin+"/ba-promina"+'';
  $.getJSON(base_url_semmi+'/api/getBaName?key=ganteng',function(data){
    // console.log(JSON.stringify(data));
    var arr = [{id : 0, text : 'BA'}];
    $.each(data ,function(key,value){
      arr.push({id : value.id, text : value.nama});
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

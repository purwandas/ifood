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
    var base_url = window.location.origin+"/ba-promina";
    var fields = $(":input").serializeArray();
    if($.fn.dataTable.isDataTable('#dataContactTotal')){
         $('#dataContactTotal').DataTable().clear();
         $('#dataContactTotal').DataTable().destroy();
    }
    var url = base_url+"/api/dContactTotal/?key=ganteng&ba="+ fields[1].value+"&toko="+ fields[2].value+"&cabang="+fields[3].value+"&kota="+ fields[4].value+"&startDate="+ fields[5].value+"&endDate="+ fields[6].value;
    var arr = {"ba" : fields[1].value, "toko" : fields[2].value, "cabang" : fields[3].value, "kota" : fields[4].value, "startDate" : fields[5].value, "endDate" : fields[6].value};

    var oTable = $('#dataContactTotal').DataTable({
    dom: 'Bfrtip',
    "oLanguage": {
        "sProcessing": "<img width='30' style='margin: 0 auto;display:block;' src='"+base_url+"/assets/upload/loadings.gif' alt='Wait..' />"
    },
    "processing": true,
    scrollX : true,
    searching : false,
    buttons : [
           // {
           //   extend: 'excel',
           //   text: 'Download Excel',
           //   className :'btn green-soft'
           // }
         ],
    "serverSide": false,
    "ajax": {
        "url": base_url+"/CountTotalContact.jsp",
        "type": "POST",
        "data" : arr
    },
        "initComplete": function() {
            var $searchInput = $('div.dataTables_filter input');

            $searchInput.unbind();

            $searchInput.bind('keyup', function(e) {
                if(e.keyCode == 13) {
                    oTable.search( this.value ).draw();
                }
            });
        }
    });
        $("#exceltotalcontact").attr('href',url);
    }
});
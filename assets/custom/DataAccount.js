$(document).ready(function() {
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

$('#toko').select2({

});
    var base_url = window.location.origin+"/ba-promina";
    var oTable = $('#dataAccount').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            // "url": "http://localhost.co.id/kota.jsp",
            "url": base_url+"/account.jsp",
            "type": "POST"
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



    checkURL(); //check if the URL has a reference to a page and load it

    $('#showTokoAccount').click(function (e){    //traverse through all our navigation links..

            checkURL(this.hash);    //.. and assign them a new onclick event, using their own hash as a parameter (#page1 for example)

    });

    setInterval("checkURL()",250);  //check for a change in the URL every 250 ms to detect if the history buttons have been used

});


var lasturl=""; //here we store the current URL hash

function checkURL(hash)
{
    if(!hash) hash=window.location.hash;    //if no parameter is provided, use the hash value from the current address

    if(hash != lasturl) // if the hash value has changed
    {
        lasturl=hash;   //update the current hash
        loadPage(hash); // and load the new page
    }
}

function loadPage(url)  //the function that loads pages via AJAX
{
    var base_url = window.location.origin+"/ba-promina";
    url=url.replace('#page','');    //strip the #page part of the hash and leave only the page number

    $('#loading').css('visibility','visible');  //show the rotating gif animation

    $.ajax({    //create an ajax request to load_page.php
        type: "POST",
        // url: "http://localhost.co.id/getKota",
        url: base_url+"/getAccountToko.jsp",
        data: 'id='+url,  //with the page number as a parameter
        dataType: "json",   //expect html to be returned
        success: function(msg){
            if(parseInt(msg)!=0)    //if no errors
            {
                var data = "";
                data += "";
                for (var i = msg.length - 1; i >= 0; i--) {
                    data += "<tr><td>No</td>";
                    data += "<td>"+msg[i]['store_id']+"</td>";
                    data += "<td>"+msg[i]['nama']+"</td>";
                    // data += "<td>"+msg[i]['target']+"</td><td><a class='btn btn-xs blue' href='"+base_url+"/toko/editTarget/"+msg[i]['id_target']+"'>Update Target</a></td></tr>";
                }
                $("#dataShowAccount").html(data);
            }
        }
    });

}
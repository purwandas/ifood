// $(document).ready(function() {
    

//     $('#dataUsers').DataTable( {
//         "processing": true,
//         "serverSide": true,
//         "ajax":
//             {
//                 "url": "http://ba.promina.co.id/users.jsp",
//                 "type": "POST"
//             },
//         "columnDefs": [
//         { 
//             "targets": [ -1 ], //last column
//             "orderable": false, //set not orderable
//         },
//         ],"initComplete": function() {
//             var $searchInput = $('div.dataTables_filter input');
 
//             $searchInput.unbind();
 
//             $searchInput.bind('keyup', function(e) {
//                 if(e.keyCode == 13) {
//                     oTable.search(this.value).draw();
//                 }
//             });
//         }

//     }

//      );
// } );


$(document).ready(function() {
    var oTable = $('#dataUsers').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "http://ba.promina.co.id/users.jsp",
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

    $('#showToko').click(function (e){    //traverse through all our navigation links..
        $('#pageContent').css({"display":"visible"});
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
    url=url.replace('#page','');    //strip the #page part of the hash and leave only the page number

    $('#loading').css('visibility','visible');  //show the rotating gif animation

    $.ajax({    //create an ajax request to load_page.php
        type: "POST",
        url: "http://ba.promina.co.id/getToko",
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
                    data += "<td>"+msg[i]['nama']+"</td></tr>";
                }
                $("#dataShowToko").html(data);
            }
        }

    });

}
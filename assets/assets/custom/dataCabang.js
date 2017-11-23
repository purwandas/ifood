$(document).ready(function() {
    var oTable = $('#dataCabang').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            //"url": "http://localhost/indofod.co.id/cabang.jsp",
            "url": "http://ba.promina.co.id/cabang.jsp",
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
        // url: "http://localhost/indofod.co.id/getCabang",
        url: "http://ba.promina.co.id/getCabang",
        data: 'id='+url,  //with the page number as a parameter
        dataType: "html",   //expect html to be returned
        success: function(msg){

            if(parseInt(msg)!=0)    //if no errors
            {
                $('#pageContent').html(msg);    //load the returned html into pageContet
                $('#loading').css('visibility','hidden');   //and hide the rotating gif
            }
        }

    });

}
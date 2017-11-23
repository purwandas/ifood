$('#topSku').on('click', function (e) {
    e.preventDefault();
    fetchTopSkuData();
});

function fetchTopSkuData() {
    var base_url_semmi = window.location.origin+"/ba-promina" + '/';
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();
    var status = $('#status').val();
    if (startDate != '' && endDate != '' && status != null) 
    {
      var topSkuArray = [];
      $('#userResult').children().remove();
      $('#judul').children().remove();
      $('#judul').html("<div class='col-md-6'>Status: <h4>"+status+"</h4></div><div class='col-md-6 '>Duration: <h4>"+startDate+"~"+endDate+"</h4></div><div id='totalData' class='col-md-12 text-center'></div>");

      
      // alert("holla");
        // startLoad();
      $('#userResult').html('<td colspan=4 align=center> Data Loading . . .<img id="imgLoading" src="assets/assets/apps/img/loading.gif" width=100px/> Please Wait . . .<td>');

      $.getJSON(base_url_semmi + 'api/getUserActivity?key=ganteng&startDate=' + startDate + '&endDate=' + endDate+ '&status=' + status, function (data) {

          $.each(data, function (key, value) {
             topSkuArray.push({
                idUser : value.idUser,
                namaUser : value.namaUser,
                nik : value.nik,
                toko : value.toko
            });
             console.log(value.namaUser);
         });
          var data ='';
          var no = 1;
          for( var i = 0 ; i < topSkuArray.length ; i++){
              data += '<tr class="odd gradeX">';
              data += '<td>' + no +'</td>';
              data += '<td>'+ topSkuArray[i].namaUser+'</td>';
              data += '<td>'+ topSkuArray[i].nik+'</td>';
              data += '<td>'+ topSkuArray[i].toko +'</td>';
              data += '</tr>';
              no++;
          }
          // alert(data);
          $('#userResult').children().remove();
          $('#totalData').html((no-1)+' data ditemukan');
          $('#userResult').html(data);
      });
    }else{
      alert('Please Fiil Out All Fields');
    }
}

  // function startLoad() {
  //   /*This is the loading gif, It will popup as soon as startLoad is called*/
  //   $('#userResult').html('<td colspan=4 align=center>Loading Data <img id="imgLoading" src="assets/assets/apps/img/loading.gif"/> Please Wait . . .<td>');
  //   $('#imgLoading').width(50);
    
  //   This is an example of the ajax get method, 
  //   You would retrieve the html then use the results
  //   to populate the container.
    
  //   $.get('example.php', function (results) {
  //       $('#loading').html(results);
  //   });
    
  //   /*This is an example and can be disregarded
  //   The clearTimeout makes sure you don't overload the timeout variable
  //   with multiple timout sessions.*/
  //   // clearTimeout(timeout);
  //   /*Set timeout delays a given function for given milliseconds*/
  //   // timeout = setTimeout(loaded, 1500);
  // }
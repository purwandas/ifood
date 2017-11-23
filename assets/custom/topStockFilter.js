$('#topSku').on('click', function (e) {
    e.preventDefault();
    fetchTopSkuData();
});

function fetchTopSkuData() {
    var base_url_semmi = window.location.origin+"/ba-promina" + '/';
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();
    var topSkuArray = [];
    $.getJSON(base_url_semmi + 'api/getTopSku?key=ganteng&startDate=' + startDate + '&endDate=' + endDate, function (data) {
        var growth;
        $.each(data, function (key, value) {
           topSkuArray.push({
              idProduk : value.idProduk,
              namaProduk : value.namaProduk,
              segmen : value.segmen,
              price : value.price,
              monthVolume : value.monthVolume,
              monthAgoVolume : value.monthAgoVolume
          });
           console.log(value.price);
       });
        topSkuArray.sort(function(a,b){
            var keyA = parseInt(a.monthVolume),
            keyB = parseInt(b.monthVolume);
            if(keyA < keyB ) return 1;
            if(keyA > keyB ) return -1;
            return 0;
        });
        var data ='';
        var no = 1;
        for( var i = 0 ; i < topSkuArray.length ; i++){
            data += '<tr class="odd gradeX">';
            data += '<td>' + no +'</td>';
            data += '<td>'+ topSkuArray[i].segmen+'</td>';
            data += '<td>'+ topSkuArray[i].namaProduk+'</td>';
            data += '<td>'+ topSkuArray[i].price+'</td>';
            data += '<td>'+ topSkuArray[i].monthVolume+'</td>';
            if(parseInt(topSkuArray[i].monthAgoVolume) === 0){
                growth = ' Trend belum bisa dihitung';
                data += '<td>'+ growth +'</td>';
            }else {
                growth = (parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].monthAgoVolume) - 1) * 100;
                data += '<td>'+ growth.toFixed(2) +'% </td>';
            }
            data += '</tr>';
            no++;
        }
        $('#topSkuResult').html(data);
    });

}

$(document).ready(function() {
    $('#ascdesc').on('switchChange.bootstrapSwitch', function(event, state) {
        if(state == false) {
            var base_url_semmi = window.location.origin+"/ba-promina" + '/';
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var topSkuArray = [];
            $.getJSON(base_url_semmi + 'api/getTopSku?key=ganteng&startDate=' + startDate + '&endDate=' + endDate, function (data) {
                var growth;
                $.each(data, function (key, value) {
                   topSkuArray.push({
                      idProduk : value.idProduk,
                      namaProduk : value.namaProduk,
                      segmen : value.segmen,
                      price : value.price,
                      prices : value.prices,
                      monthVolume : value.monthVolume,
                      monthAgoVolume : value.monthAgoVolume
                  });
               });
                topSkuArray.sort(function(a,b){
                    var keyA = parseInt(a.monthVolume),
                    keyB = parseInt(b.monthVolume);
                    if(keyA < keyB ) return 1;
                    if(keyA > keyB ) return -1;
                    return 0;
                });
                var data ='';
                var no = 1;
                for( var i = 0 ; i < topSkuArray.length ; i++){
                    data += '<tr class="odd gradeX">';
                    data += '<td>' + no +'</td>';
                    data += '<td>'+ topSkuArray[i].segmen+'</td>';
                    data += '<td>'+ topSkuArray[i].namaProduk+'</td>';
                    data += '<td>'+ topSkuArray[i].price+'</td>';
                    data += '<td>'+ topSkuArray[i].monthVolume+'</td>';
                    if(parseInt(topSkuArray[i].monthAgoVolume) === 0){
                        growth = ' Trend belum bisa dihitung';
                        data += '<td>'+ growth +'</td>';
                    }else {
                        growth = (parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].monthAgoVolume) - 1) * 100;
                        data += '<td>'+ growth.toFixed(2) +'% </td>';
                    }
                    data += '</tr>';
                    no++;
                }
                $('#topSkuResult').html(data);
            });
        }
        else{
            var base_url_semmi = window.location.origin+"/ba-promina" + '/';
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var topSkuArray = [];
            $.getJSON(base_url_semmi + 'api/getTopSku?key=ganteng&startDate=' + startDate + '&endDate=' + endDate, function (data) {
                var growth;
                $.each(data, function (key, value) {
                 topSkuArray.push({
                      idProduk : value.idProduk,
                      namaProduk : value.namaProduk,
                      segmen : value.segmen,
                      price : value.price,
                      prices : value.prices,
                      monthVolume : value.monthVolume,
                      monthAgoVolume : value.monthAgoVolume
              });
             });
                topSkuArray.sort(function(a,b){
                    var keyA = parseInt(a.monthVolume),
                    keyB = parseInt(b.monthVolume);
                    if(keyA < keyB ) return -1;
                    if(keyA > keyB ) return 1;
                    return 0;
                });
                var data ='';
                var no = 1;
                for( var i = 0 ; i < topSkuArray.length ; i++){
                    data += '<tr class="odd gradeX">';
                    data += '<td>' + no +'</td>';
                    data += '<td>'+ topSkuArray[i].segmen+'</td>';
                    data += '<td>'+ topSkuArray[i].namaProduk+'</td>';
                    data += '<td>'+ topSkuArray[i].price+'</td>';
                    data += '<td>'+ topSkuArray[i].monthVolume+'</td>';
                    if(parseInt(topSkuArray[i].monthAgoVolume) === 0){
                        growth = ' Trend belum bisa dihitung';
                        data += '<td>'+ growth +'</td>';
                    }else {
                        growth = (parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].monthAgoVolume) - 1) * 100;
                        data += '<td>'+ growth.toFixed(2) +'% </td>';
                    }
                    data += '</tr>';
                    no++;
                }
                $('#topSkuResult').html(data);
            });
        }
    });
});
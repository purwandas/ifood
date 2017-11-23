$("#top_ba").validate({
	rules: {
		startDate: "required",
		endDate: "required",
	},
	messages: {
		startDate: "Please enter your startDate",
		endDate: "Please enter your endDate",

	},
	submitHandler: function(form) {
		var fields = $(":input").serializeArray();
		var base_url = window.location.origin+"/ba-promina";
		var arr = {"startDate" : fields[1].value, "endDate" : fields[2].value};

		var topSkuArray = [];
		$.ajax({
			url: base_url+'/topAccount.jsp',
			type: 'POST',
			dataType: 'json',
			data: arr,
			beforeSend : function() {
	            $("#loading").html("<img width='30' style='margin: 0 auto;display:block;' src='"+base_url+"/assets/upload/loadings.gif' alt='Wait..' />");
	        },
		})
		.done(function(data) {
			var growth;
			$.each(data, function (key, value) {
				var data_bc = value.qty_bc_prtj * value.harga_bc;
				var data_bti = value.qty_bti_prtj * value.harga_bti;
				var data_rusk = value.qty_rusk_prtj * value.harga_rusk;
				var data_pudding = value.qty_pudding_prtj * value.harga_pudding;
				var data_others = value.qty_others_prtj * value.harga_others;

				topSkuArray.push({
					nama_account_temp : value.nama_account_temp,
					jml_store_account : value.jml_store_account,
					target : value.target,
					price : value.price,
					data_bc : data_bc,
					data_bti : data_bti,
					data_rusk : data_rusk,
					data_pudding : data_pudding,
					data_others : data_others,
					monthVolume : (value.monthVolume == null) ? '0' : value.monthVolume,
					monthAgoVolume :(value.monthAgoVolume == null) ? '0' : value.monthAgoVolume
				});
			});
			topSkuArray.sort(function(a,b){
				var keyA = parseInt(a.monthVolume) / parseInt(a.target) * 100,
				keyB = parseInt(b.monthVolume) / parseInt(b.target) * 100;
				if(keyA < keyB ) return 1;
				if(keyA > keyB ) return -1;
				return 0;
			});
			var data ='';
			var no = 1;
			var ach;

			for( var i = 0 ; i < topSkuArray.length ; i++){
				var sum = topSkuArray[i].data_bc + topSkuArray[i].data_bti + topSkuArray[i].data_rusk + topSkuArray[i].data_pudding + topSkuArray[i].data_others;
				data += '<tr class="odd gradeX">';
				data += '<td>' + no +'</td>';
				data += '<td>'+ topSkuArray[i].nama_account_temp+'</td>';
				data += '<td>'+ topSkuArray[i].jml_store_account+'</td>';
				data += '<td>'+ topSkuArray[i].target+'</td>';
				data += '<td>Rp '+ Number(sum.toFixed(1)).toLocaleString() +'</td>';
				data += '<td>'+ topSkuArray[i].monthVolume+'</td>';
				if (parseInt(topSkuArray[i].target) === 0) {
					data += '<td>Target belum ditentukan</td>';
				}
				else{
					data += '<td>'+ (parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].target) * 100).toFixed(2)+'%</td>';
				}


				ach = parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].target) * 100;

				if(parseInt(topSkuArray[i].monthAgoVolume) === 0){
					growth = ' Growth Belum bisa dihitung';
					data += '<td>'+ growth +'</td>';
				}else {
					growth = (parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].monthAgoVolume) - 1) * 100;
					data += '<td>'+ growth.toFixed(2) +'% </td>';
				}
				data += '</tr>';
				no++;
			}
			$("#resultAccount").html(data);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});

	}
});

$(document).ready(function() {
	$('#ascdesc').on('switchChange.bootstrapSwitch', function(event, state) {
		if (state == false) {
			var fields = $(":input").serializeArray();
			var base_url = window.location.origin+"/ba-promina";
			var arr = {"startDate" : fields[1].value, "endDate" : fields[2].value};

			var topSkuArray = [];
			$.ajax({
				url: base_url+'/topAccount.jsp',
				type: 'POST',
				dataType: 'json',
				data: arr,
				beforeSend : function() {
		            $("#loading").html("<img width='30' style='margin: 0 auto;display:block;' src='"+base_url+"/assets/upload/loadings.gif' alt='Wait..' />");
		        },
			})
			.done(function(data) {
				var growth;
				$.each(data, function (key, value) {
					var data_bc = value.qty_bc_prtj * value.harga_bc;
					var data_bti = value.qty_bti_prtj * value.harga_bti;
					var data_rusk = value.qty_rusk_prtj * value.harga_rusk;
					var data_pudding = value.qty_pudding_prtj * value.harga_pudding;
					var data_others = value.qty_others_prtj * value.harga_others;

					topSkuArray.push({
						nama_account_temp : value.nama_account_temp,
						jml_store_account : value.jml_store_account,
						target : value.target,
						price : value.price,
						data_bc : data_bc,
						data_bti : data_bti,
						data_rusk : data_rusk,
						data_pudding : data_pudding,
						data_others : data_others,
						monthVolume : (value.monthVolume == null) ? '0' : value.monthVolume,
						monthAgoVolume :(value.monthAgoVolume == null) ? '0' : value.monthAgoVolume
					});
				});
				topSkuArray.sort(function(a,b){
					var keyA = parseInt(a.monthVolume) / parseInt(a.target) * 100,
					keyB = parseInt(b.monthVolume) / parseInt(b.target) * 100;
					if(keyA < keyB ) return 1;
					if(keyA > keyB ) return -1;
					return 0;
				});
				var data ='';
				var no = 1;
				var ach;

				for( var i = 0 ; i < topSkuArray.length ; i++){
					var sum = topSkuArray[i].data_bc + topSkuArray[i].data_bti + topSkuArray[i].data_rusk + topSkuArray[i].data_pudding + topSkuArray[i].data_others;
					data += '<tr class="odd gradeX">';
					data += '<td>' + no +'</td>';
					data += '<td>'+ topSkuArray[i].nama_account_temp+'</td>';
					data += '<td>'+ topSkuArray[i].jml_store_account+'</td>';
					data += '<td>'+ topSkuArray[i].target+'</td>';
					data += '<td>Rp '+ Number(sum.toFixed(1)).toLocaleString() +'</td>';
					data += '<td>'+ topSkuArray[i].monthVolume+'</td>';
					if (parseInt(topSkuArray[i].target) === 0) {
						data += '<td>Target belum ditentukan</td>';
					}
					else{
						data += '<td>'+ (parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].target) * 100).toFixed(2)+'%</td>';
					}


					ach = parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].target) * 100;

					if(parseInt(topSkuArray[i].monthAgoVolume) === 0){
						growth = ' Growth Belum bisa dihitung';
						data += '<td>'+ growth +'</td>';
					}else {
						growth = (parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].monthAgoVolume) - 1) * 100;
						data += '<td>'+ growth.toFixed(2) +'% </td>';
					}
					data += '</tr>';
					no++;
				}
				$("#resultAccount").html(data);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}
		else{
			var fields = $(":input").serializeArray();
			var base_url = window.location.origin+"/ba-promina";
			var arr = {"startDate" : fields[1].value, "endDate" : fields[2].value};

			var topSkuArray = [];
			$.ajax({
				url: base_url+'/topAccount.jsp',
				type: 'POST',
				dataType: 'json',
				data: arr,
				beforeSend : function() {
		            $("#loading").html("<img width='30' style='margin: 0 auto;display:block;' src='"+base_url+"/assets/upload/loadings.gif' alt='Wait..' />");
		        },
			})
			.done(function(data) {
				var growth;
				$.each(data, function (key, value) {
					var data_bc = value.qty_bc_prtj * value.harga_bc;
					var data_bti = value.qty_bti_prtj * value.harga_bti;
					var data_rusk = value.qty_rusk_prtj * value.harga_rusk;
					var data_pudding = value.qty_pudding_prtj * value.harga_pudding;
					var data_others = value.qty_others_prtj * value.harga_others;

					topSkuArray.push({
						nama_account_temp : value.nama_account_temp,
						jml_store_account : value.jml_store_account,
						target : value.target,
						price : value.price,
						data_bc : data_bc,
						data_bti : data_bti,
						data_rusk : data_rusk,
						data_pudding : data_pudding,
						data_others : data_others,
						monthVolume : (value.monthVolume == null) ? '0' : value.monthVolume,
						monthAgoVolume :(value.monthAgoVolume == null) ? '0' : value.monthAgoVolume
					});
				});
				topSkuArray.sort(function(a,b){
					var keyA = parseInt(a.monthVolume) / parseInt(a.target) * 100,
					keyB = parseInt(b.monthVolume) / parseInt(b.target) * 100;
					if(keyA < keyB ) return -1;
					if(keyA > keyB ) return 1;
					return 0;
				});
				var data ='';
				var no = 1;
				var ach;

				for( var i = 0 ; i < topSkuArray.length ; i++){
					var sum = topSkuArray[i].data_bc + topSkuArray[i].data_bti + topSkuArray[i].data_rusk + topSkuArray[i].data_pudding + topSkuArray[i].data_others;
					data += '<tr class="odd gradeX">';
					data += '<td>' + no +'</td>';
					data += '<td>'+ topSkuArray[i].nama_account_temp+'</td>';
					data += '<td>'+ topSkuArray[i].jml_store_account+'</td>';
					data += '<td>'+ topSkuArray[i].target+'</td>';
					data += '<td>Rp '+ Number(sum.toFixed(1)).toLocaleString() +'</td>';
					data += '<td>'+ topSkuArray[i].monthVolume+'</td>';
					if (parseInt(topSkuArray[i].target) === 0) {
						data += '<td>Target belum ditentukan</td>';
					}
					else{
						data += '<td>'+ (parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].target) * 100).toFixed(2)+'%</td>';
					}


					ach = parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].target) * 100;

					if(parseInt(topSkuArray[i].monthAgoVolume) === 0){
						growth = ' Growth Belum bisa dihitung';
						data += '<td>'+ growth +'</td>';
					}else {
						growth = (parseInt(topSkuArray[i].monthVolume) / parseInt(topSkuArray[i].monthAgoVolume) - 1) * 100;
						data += '<td>'+ growth.toFixed(2) +'% </td>';
					}
					data += '</tr>';
					no++;
				}
				$("#resultAccount").html(data);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}
	});
});
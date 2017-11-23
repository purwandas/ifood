$(document).ready(function() {
	$("select[name=tagIn]").change(function(){
		$('#tagOut').val($("select[name='tagIn']")
              .map(function(){return $(this).val();}).get());
	});
});
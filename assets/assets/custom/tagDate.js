$(document).ready(function() {
	$("input[name=startDate]").datepicker({ 
	    onSelect: function(dateText, inst) {
			$("input[id=tagOut").val(dateText);
	    }
	});
});
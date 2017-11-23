$(document).ready(function() {
	$('#target').keypress(function(e) {
    var data = $(this).val();
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      $("#errmsg").html("Hanya Angka").show().fadeOut("slow");
      return false;
    }
  });
});
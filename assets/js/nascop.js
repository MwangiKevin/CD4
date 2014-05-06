 $().ready(function() {
	
  	$("#customize").hide();

  	$('#filterfromdate').datepicker({
    	yearRange : "-120:+0",
		maxDate : "0D",
		dateFormat : $.datepicker.ATOM,
		changeMonth : true,
		changeYear : true

    });
    $('#filtertodate').datepicker({
    	yearRange : "-120:+0",
		maxDate : "0D",
		dateFormat : $.datepicker.ATOM,
		changeMonth : true,
		changeYear : true
    });
	
});

function toggleHideCustomize(){
  $("#customize").toggle();
}

function test(){
	alert("Hello");
}
function submit_password(){
	$("#password_user").submit();
}
function submit_password_header(){
	$("#password_header").submit();
}


$(window).scroll(function() {
    var top_val = $(window).scrollTop();
    if(top_val > 10) {
        //$("#site-title").height((160-top_val));
        //$("#header").css("position:absolute;");
    }
});
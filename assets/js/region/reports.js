$().ready(function() {
    $('#to').datepicker({
    	yearRange : "-120:+0",
		maxDate : "0D",
		dateFormat : $.datepicker.ATOM,
		changeMonth : true,
		changeYear : true

    });
    $('#from').datepicker({
    	yearRange : "-120:+0",
		maxDate : "0D",
		dateFormat : $.datepicker.ATOM,
		changeMonth : true,
		changeYear : true

    });
});
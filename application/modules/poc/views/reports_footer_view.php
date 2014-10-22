<script language="javascript">
$(function() {
	/**
	*
	*/
	$('#datepickerFrom').datepicker({dateFormat: 'yy-mm-dd', minDate : new Date(<?php echo $starting_year;?>,0,1), maxDate: new Date(),changeMonth: true,changeYear: true});
	$('#datepickerTo').datepicker({dateFormat: 'yy-mm-dd',minDate : new Date(<?php echo $starting_year;?>,0,1),maxDate: new Date(),changeMonth: true,changeYear: true});
    //devices
    $('#datepickerFromd').datepicker({dateFormat: 'yy-mm-dd', minDate : new Date(<?php echo $starting_year;?>,0,1), maxDate: new Date(),changeMonth: true,changeYear: true});
    $('#datepickerTod').datepicker({dateFormat: 'yy-mm-dd',minDate : new Date(<?php echo $starting_year;?>,0,1),maxDate: new Date(),changeMonth: true,changeYear: true});
    //facilities
    $('#datepickerFromf').datepicker({dateFormat: 'yy-mm-dd', minDate : new Date(<?php echo $starting_year;?>,0,1), maxDate: new Date(),changeMonth: true,changeYear: true});
    $('#datepickerTof').datepicker({dateFormat: 'yy-mm-dd',minDate : new Date(<?php echo $starting_year;?>,0,1),maxDate: new Date(),changeMonth: true,changeYear: true});
    //regions
     $('#datepickerFromr').datepicker({dateFormat: 'yy-mm-dd', minDate : new Date(<?php echo $starting_year;?>,0,1), maxDate: new Date(),changeMonth: true,changeYear: true});
    $('#datepickerTor').datepicker({dateFormat: 'yy-mm-dd',minDate : new Date(<?php echo $starting_year;?>,0,1),maxDate: new Date(),changeMonth: true,changeYear: true});
    //districts
    $('#datepickerFromdis').datepicker({dateFormat: 'yy-mm-dd', minDate : new Date(<?php echo $starting_year;?>,0,1), maxDate: new Date(),changeMonth: true,changeYear: true});
    $('#datepickerTodis').datepicker({dateFormat: 'yy-mm-dd',minDate : new Date(<?php echo $starting_year;?>,0,1),maxDate: new Date(),changeMonth: true,changeYear: true});
    //partner
    $('#datepickerFromp').datepicker({dateFormat: 'yy-mm-dd', minDate : new Date(<?php echo $starting_year;?>,0,1), maxDate: new Date(),changeMonth: true,changeYear: true});
    $('#datepickerTop').datepicker({dateFormat: 'yy-mm-dd',minDate : new Date(<?php echo $starting_year;?>,0,1),maxDate: new Date(),changeMonth: true,changeYear: true});
    

});

   /**
    *  On the 'On change' event listener, 
    *  dynamically re-create the 'end' date based
    *  on the Start date.
    **/
    $('#datepickerFrom').on("change", function() {
       //Begin the re-creation
       $('#datepickerTo').datepicker( "destroy" );
       $('#datepickerTo').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : $('#datepickerFrom').datepicker( "getDate" ),
                 dateFormat: 'yy-mm-dd',
                 maxDate: new Date(),
                 changeMonth: true,
                 changeYear: true              
                //Optional: setDate: The same as minDate.
            });
   	});
   	
   	$('#datepickerFromd').on("change", function() {
       //Begin the re-creation
       $('#datepickerTod').datepicker( "destroy" );
       $('#datepickerTod').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : $('#datepickerFromd').datepicker( "getDate" ),
                 dateFormat: 'yy-mm-dd',
                 maxDate: new Date(),
                 changeMonth: true,
                 changeYear: true              
                //Optional: setDate: The same as minDate.
            });
   	});

	$('#datepickerFromf').on("change", function() {
       //Begin the re-creation
       $('#datepickerTof').datepicker( "destroy" );
       $('#datepickerTof').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : $('#datepickerFromf').datepicker( "getDate" ),
                 dateFormat: 'yy-mm-dd',
                 maxDate: new Date(),
                 changeMonth: true,
                 changeYear: true              
                //Optional: setDate: The same as minDate.
            });
   	});
   	
   	$('#datepickerFromr').on("change", function() {
       //Begin the re-creation
       $('#datepickerTor').datepicker( "destroy" );
       $('#datepickerTor').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : $('#datepickerFromr').datepicker( "getDate" ),
                 dateFormat: 'yy-mm-dd',
                 maxDate: new Date(),
                 changeMonth: true,
                 changeYear: true              
                //Optional: setDate: The same as minDate.
            });
   	});
   	
   	$('#datepickerFromdis').on("change", function() {
       //Begin the re-creation
       $('#datepickerTodis').datepicker( "destroy" );
       $('#datepickerTodis').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : $('#datepickerFromdis').datepicker( "getDate" ),
                 dateFormat: 'yy-mm-dd',
                 maxDate: new Date(),
                 changeMonth: true,
                 changeYear: true              
                //Optional: setDate: The same as minDate.
            });
   	});
   	
   	$('#datepickerFromp').on("change", function() {
       //Begin the re-creation
       $('#datepickerTop').datepicker( "destroy" );
       $('#datepickerTop').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : $('#datepickerFromp').datepicker( "getDate" ),
                 dateFormat: 'yy-mm-dd',
                 maxDate: new Date(),
                 changeMonth: true,
                 changeYear: true              
                //Optional: setDate: The same as minDate.
            });
   	});

    /**
        *  On the 'On change' event listener, 
        *  dynamically re-create the 'end' date based
        *  on the Start date.
        **/

        $('#datepickerTo').on("change", function() {
       //Begin the re-creation
       $('#datepickerFrom').datepicker( "destroy" );
       $('#datepickerFrom').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : new Date(<?php echo $starting_year;?>,0,1),
                 dateFormat: 'yy-mm-dd',
                 maxDate: $('#datepickerTo').datepicker( "getDate" ),
                 changeMonth: true,
                 changeYear: true             
                //Optional: setDate: The same as minDate.
            });
   		});


		$('#datepickerTod').on("change", function() {
       //Begin the re-creation
       $('#datepickerFromd').datepicker( "destroy" );
       $('#datepickerFromd').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : new Date(<?php echo $starting_year;?>,0,1),
                 dateFormat: 'yy-mm-dd',
                 maxDate: $('#datepickerTod').datepicker( "getDate" ),
                 changeMonth: true,
                 changeYear: true             
                //Optional: setDate: The same as minDate.
            });
   		});
   		
		$('#datepickerTof').on("change", function() {
       //Begin the re-creation
       $('#datepickerFromf').datepicker( "destroy" );
       $('#datepickerFromf').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : new Date(<?php echo $starting_year;?>,0,1),
                 dateFormat: 'yy-mm-dd',
                 maxDate: $('#datepickerTof').datepicker( "getDate" ),
                 changeMonth: true,
                 changeYear: true             

                //Optional: setDate: The same as minDate.
            });
   		});
   		
   	   $('#datepickerTodis').on("change", function() {
       //Begin the re-creation
       $('#datepickerFromdis').datepicker( "destroy" );
       $('#datepickerFromdis').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : new Date(<?php echo $starting_year;?>,0,1),
                 dateFormat: 'yy-mm-dd',
                 maxDate: $('#datepickerTodis').datepicker( "getDate" ),
                 changeMonth: true,
                 changeYear: true             

                //Optional: setDate: The same as minDate.
            });
   		});
   		
   	   $('#datepickerTor').on("change", function() {
       //Begin the re-creation
       $('#datepickerFromr').datepicker( "destroy" );
       $('#datepickerFromr').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : new Date(<?php echo $starting_year;?>,0,1),
                 dateFormat: 'yy-mm-dd',
                 maxDate: $('#datepickerTor').datepicker( "getDate" ),
                 changeMonth: true,
                 changeYear: true             

                //Optional: setDate: The same as minDate.
            });
   		});
   		
   		$('#datepickerTop').on("change", function() {
       //Begin the re-creation
       $('#datepickerFromp').datepicker( "destroy" );
       $('#datepickerFromp').datepicker({
                /**
                 * Set the date to be the same as the first
                 **/
                 minDate : new Date(<?php echo $starting_year;?>,0,1),
                 dateFormat: 'yy-mm-dd',
                 maxDate: $('#datepickerTop').datepicker( "getDate" ),
                 changeMonth: true,
                 changeYear: true             

                //Optional: setDate: The same as minDate.
            });
   		});
   		
   	//national disable report_type
	$('#report_title_national').on('change', function(){
		var report_type = $('#report_title_national  option:selected').val();
		if(report_type == 3){
			$('#report_type_national').prop('disabled', true);	
		}else{
			$('#report_type_national').prop('disabled', false);
		}		
	});
	//partner disable report_type
	$('#report_title_partner').on('change', function(){
		var report_type = $('#report_title_partner  option:selected').val();
		if(report_type == 3){
			$('#report_type_partner').prop('disabled', true);	
		}else{
			$('#report_type_partner').prop('disabled', false);
		}		
	});
	//region disable report_type
	$('#report_title_region').on('change', function(){
		var report_type = $('#report_title_region  option:selected').val();
		if(report_type == 3){
			$('#report_type_region').prop('disabled', true);	
		}else{
			$('#report_type_region').prop('disabled', false);
		}		
	});
	//district disable report_type
	$('#report_title_district').on('change', function(){
		var report_type = $('#report_title_district  option:selected').val();
		if(report_type == 3){
			$('#report_type_district').prop('disabled', true);	
		}else{
			$('#report_type_district').prop('disabled', false);
		}		
	});
	//device disable report_type
	$('#report_title_device').on('change', function(){
		var report_type = $('#report_title_device  option:selected').val();
		if(report_type == 3){
			$('#report_type_device').prop('disabled', true);	
		}else{
			$('#report_type_device').prop('disabled', false);
		}		
	});
	//disable facility report_type
	$('#report_title_facility').on('change', function(){
		var report_type = $('#report_title_facility  option:selected').val();
		if(report_type == 3){
			$('#report_type_facility').prop('disabled', true);	
		}else{
			$('#report_type_facility').prop('disabled', false);
		}		
	}); 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
</script>
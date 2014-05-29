<script language="javascript">
$(function() {
	/**
	*
	*/
	$('#datepickerFrom').datepicker({dateFormat: 'yy-mm-dd', minDate : new Date(<?php echo $starting_year;?>,0,1), maxDate: new Date(),changeMonth: true,changeYear: true});
	$('#datepickerTo').datepicker({dateFormat: 'yy-mm-dd',minDate : new Date(<?php echo $starting_year;?>,0,1),maxDate: new Date(),changeMonth: true,changeYear: true});

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

        $().ready(function() {

           $("#devicesdiv").hide();
           $("#facilitydiv").hide();
           $("#districtsdiv").hide();
           $("#regionsdiv").hide();
           $("#monthlydiv").hide();
           $("#quarterlydiv").hide();
           $("#biannualdiv").hide();
           $("#yearlydiv").hide();
           $("#CustDatesdiv").hide();

       });

        $('#criteria').change(function(){

          var criteria	 = $('#criteria').val();

          if (criteria==1){//devices
            $("#devicesdiv").show();			
            $("#device").prop('required',true);

            $("#facility").removeAttr('required');
            $("#facilitydiv").hide();
            
            $("#districts").removeAttr('required');
            $("#districtsdiv").hide();
            
            $("#regions").removeAttr('required');
            $("#regionsdiv").hide();

        }else if(criteria==2){//facilities	
            $("#facilitydiv").show();				
            $("#facility").prop('required',true);

            $("#device").removeAttr('required');
            $("#devicesdiv").hide();
            
            $("#districts").removeAttr('required');
            $("#districtsdiv").hide();
            
            $("#regions").removeAttr('required');
            $("#regionsdiv").hide();
        }else if(criteria==4){//districts
        	$("#districtsdiv").show();
        	$("districts").prop('required',true);
        	
        	$("#device").removeAttr('required');
            $("#devicesdiv").hide();
            
            $("#facility").removeAttr('required');
            $("#facilitydiv").hide();
            
            $("#regions").removeAttr('required');
            $("#regionsdiv").hide();
        }else if(criteria==5){//regions
        	$("#regionsdiv").show();
        	$("#regions").prop('required',true);
        	
            $("#device").removeAttr('required');
            $("#devicesdiv").hide();
            
            $("#districts").removeAttr('required');
            $("#districtsdiv").hide();
            
            $("#facility").removeAttr('required');
            $("#facilitydiv").hide();        	
        	
        }else{			
          $("#devicesdiv").hide();
          $("#device").removeAttr('required');

          $("#facility").removeAttr('required');
          $("#facilitydiv").hide();

      }

  });
        $('#duration').change(function(){

            var duration	 = $('#duration').val();

            if(duration==1){

                $("#monthlydiv").show();
                $("#monthly_year").prop('required',true);            
                $("#monthly_month").prop('required',true);

                $("#quarterly_quarter").removeAttr('required');
                $("#quarterly_year").removeAttr('required');
                $("#quarterlydiv").hide();

                $("#biannual_bian").removeAttr('required');
                $("#biannual_year").removeAttr('required');
                $("#biannualdiv").hide();

                $("#yearly").removeAttr('required');
                $("#yearlydiv").hide();

                $("#datepickerFrom").removeAttr('required');
                $("#datepickerTo").removeAttr('required');
                $("#CustDatesdiv").hide();

            }else if(duration==2){

                $("#quarterlydiv").show();
                $("#quarterly_quarter").prop('required',true);
                $("#quarterly_year").prop('required',true);

                $("#monthly_year").removeAttr('required');            
                $("#monthly_month").removeAttr('required');
                $("#monthlydiv").hide();

                $("#biannual_bian").removeAttr('required');
                $("#biannual_year").removeAttr('required');
                $("#biannualdiv").hide();

                $("#yearly").removeAttr('required');
                $("#yearlydiv").hide();

                $("#datepickerFrom").removeAttr('required');
                $("#datepickerTo").removeAttr('required');
                $("#CustDatesdiv").hide();

            }else if(duration==3){

                $("#biannualdiv").show();
                $("#biannually_bian").prop('required',true); 
                $("#biannually_year").prop('required',true);

                $("#monthly_year").removeAttr('required');           
                $("#monthly_month").removeAttr('required');
                $("#monthlydiv").hide();

                $("#quarterly_quarter").removeAttr('required');
                $("#quarterly_year").removeAttr('required');
                $("#quarterlydiv").hide();

                $("#yearly").removeAttr('required');
                $("#yearlydiv").hide();

                $("#datepickerFrom").removeAttr('required');
                $("#datepickerTo").removeAttr('required');
                $("#CustDatesdiv").hide();

            }else if(duration==4){

                $("#yearlydiv").show();
                $("#yearly").prop('required',true);

                $("#monthly_year").removeAttr('required');            
                $("#monthly_month").removeAttr('required');
                $("#monthlydiv").hide();

                $("#quarterly_quarter").removeAttr('required');
                $("#quarterly_year").removeAttr('required');
                $("#quarterlydiv").hide();

                $("#biannual_bian").removeAttr('required');
                $("#biannual_year").removeAttr('required');
                $("#biannualdiv").hide();

                $("#datepickerFrom").removeAttr('required');
                $("#datepickerTo").removeAttr('required');
                $("#CustDatesdiv").hide();

            }else if(duration==5){

                $("#CustDatesdiv").show();
                $("#datepickerFrom").prop('required',true);
                $("#datepickerTo").prop('required',true);

                $("#monthly_year").removeAttr('required');            
                $("#monthly_month").removeAttr('required');
                $("#monthlydiv").hide();

                $("#quarterly_quarter").removeAttr('required');
                $("#quarterly_year").removeAttr('required');
                $("#quarterlydiv").hide();

                $("#biannual_bian").removeAttr('required');
                $("#biannual_year").removeAttr('required');
                $("#biannualdiv").hide();

                $("#yearly").removeAttr('required');
                $("#yearlydiv").hide();

            }else{

                $("#monthly_year").removeAttr('required');            
                $("#monthly_month").removeAttr('required');
                $("#monthlydiv").hide();

                $("#quarterly_quarter").removeAttr('required');
                $("#quarterly_year").removeAttr('required');
                $("#quarterlydiv").hide();

                $("#biannual_bian").removeAttr('required');
                $("#biannual_year").removeAttr('required');
                $("#biannualdiv").hide();

                $("#yearly").removeAttr('required');
                $("#yearlydiv").hide();

                $("#datepickerFrom").removeAttr('required');
                $("#datepickerTo").removeAttr('required');
                $("#CustDatesdiv").hide();
            }
        });
        
        /**
        *  Depending on duration selected
        *  change the value of date_from & date_to
        *  
        **/
        function consolidate_dates(){
            var duration     = $('#duration').val();
            var dt_from      = "";
            var dt_to        = "";

            if(duration==1){

                var month   = parseInt($("#monthly_month").val());
                var year    = parseInt($("#monthly_year").val());

                dt_from      =  $.datepicker.formatDate('yy-mm-dd', new Date(year,month,1)) ;
                dt_to        =  $.datepicker.formatDate('yy-mm-dd', new Date(year,month+1,0))  ;              
                
            }else  if(duration==2){
                var quarter = parseInt($("#quarterly_quarter").val());
                var year    = parseInt($("#quarterly_year").val());

                var month_from = null;
                var month_to   = null;

                if (quarter==1){
                    var month_from = 0;
                    var month_to   = 2;

                }else if (quarter==2){
                    var month_from = 3;
                    var month_to   = 5;

                }else if (quarter==3){
                    var month_from = 6;
                    var month_to   = 8;

                }else if (quarter==4){
                    var month_from = 9;
                    var month_to   = 11;

                }else{

                    var month_from = 0;
                    var month_to   = 11;
                }

                dt_from      =  $.datepicker.formatDate('yy-mm-dd', new Date(year,month_from,1)) ;
                dt_to        =  $.datepicker.formatDate('yy-mm-dd', new Date(year,month_to+1,0)) ; 

                
            }else  if(duration==3){
                var bian    = parseInt($("#biannually_bian").val());
                var year    = parseInt($("#biannually_year").val());

                var month_from = null;
                var month_to   = null;

               if (bian==1){
                    var month_from = 0;
                    var month_to   = 5;

                }else if (bian==2){
                    var month_from = 6;
                    var month_to   = 11;

                }else{

                    var month_from = 0;
                    var month_to   = 11;
                }

                dt_from      =  $.datepicker.formatDate('yy-mm-dd', new Date(year,month_from,1)) ;
                dt_to        =  $.datepicker.formatDate('yy-mm-dd', new Date(year,month_to+1,0)) ;

                
            }else  if(duration==4){

                var year    = parseInt($("#yearly").val());

                var month_from = 0;
                var month_to   = 11;

                dt_from      =  $.datepicker.formatDate('yy-mm-dd', new Date(year,month_from,1)) ;
                dt_to        =  $.datepicker.formatDate('yy-mm-dd', new Date(year,month_to+1,0)) ;
                
            }else  if(duration==5){

                dt_from = $("#datepickerFrom").val();
                dt_to   = $("#datepickerTo").val();
                
            }else{

            }

            $("#date_from").val(dt_from);
            $("#date_to").val(dt_to);
        }


</script>
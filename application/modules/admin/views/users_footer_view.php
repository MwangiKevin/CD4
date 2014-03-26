<script>
	$().ready(function() {		
    	$("#par_div").hide();
    	$("#reg_div").hide();
    	$("#dis_div").hide();
    	$("#fac_div").hide();
	});
	$("#usr_grp").change(function(){ 
    	var usr_grp_id 	= $("#usr_grp").val();     	
    	if(usr_grp_id==3){	
    		$("#par_div").show();
	    	$("#reg_div").hide();
	    	$("#dis_div").hide();
	    	$("#fac_div").hide();
    	}else if(usr_grp_id==6){
    		$("#fac_div").show();		
	    	$("#par_div").hide();
	    	$("#reg_div").hide();
	    	$("#dis_div").hide();
    	}else if(usr_grp_id==9){
    		$("#reg_div").show();		
	    	$("#par_div").hide();
	    	$("#dis_div").hide();
	    	$("#fac_div").hide();
    	}else if(usr_grp_id==8){
	    	$("#dis_div").show();		
	    	$("#par_div").hide();
	    	$("#reg_div").hide();
	    	$("#fac_div").hide();
    	}else{ 				
	    	$("#par_div").hide();
	    	$("#reg_div").hide();
	    	$("#dis_div").hide();
	    	$("#fac_div").hide();
    	}

    });

    function edit_user(id,username,usertype,name,email,phone,editstatus){

		var str = "#tr_"+id;

		var row = $(str).html();

		$("#edit_table_row").html(row);

		$("#edituserid").val(id);
		$("#editusername").val(username);
		$("#editusertype").val(usertype);
		$("#editname").val(name);
		$("#editemail").val(email);
		$("#editphone").val(phone);

		$('input[name=editstatus][value=1]').prop('checked', false);
		$('input[name=editstatus][value=2]').prop('checked', false);
		$('input[name=editstatus][value=3]').prop('checked', false);

		$('input[name=editstatus][value='+editstatus+']').prop('checked', true);

			
		$("#editdetailsdiv").modal("show");

	}

	function hide_edit(){
		$("#editdetailsdiv").modal("hide");
	}


</script>
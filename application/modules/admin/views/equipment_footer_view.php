<script>
	$().ready(function() {
    	$("#equipmentdiv").hide();
    	$("#ctcdiv").hide();
    	//$("#rolloutstatusdiv").modal("show");
	});

	var json_equipment 	= '<?php echo json_encode($equipment_1);?>';
	var equipment 		=	JSON.parse(json_equipment);	

	$("#equipmentcategory").change(function(){ 
    	var eq_type 	= $("#equipmentcategory").val();
    	var options ='<option value="">*Select an Equipment*</option>';
    	for (i = 0; i < equipment.length; ++i) {  		
    		if(equipment[i]["equipment_category_id"]==eq_type){
    			options += '<option value="'+equipment[i]["id"]+'">'+equipment[i]["description"]+'</option>';
    		}
		}
		$("#equipment").html(options);

		if(!$("#equipmentcategory").val()){
			//alert($("#equipmentcategory").val());
			$("#equipmentdiv").hide();
		}else{
			$("#equipmentdiv").show();
		}
    });
    
    $("#equipment").change(function(){ 
		if($("#equipment").val()==4){
			$("#ctcdiv").show();
		}else{
			$("#ctcdiv").hide();
		}
 	});

 	$("#equipment").click(function(){



 	});

 	// this is the id of the form
	$("#idForm").submit(function() {

	    var url = "admin/equipment/save_fac_equip"; // the script where you handle the form input.

	    $.ajax({
	           type: "POST",
	           url: url,
	           data: $("#idForm").serialize(), // serializes the form's elements.
	           success: function(data)
	           {
	               alert(data); // show response from the php script.
	           }
	         });

	    return false; // avoid to execute the actual submit of the form.
	});

	function edit_equipment(id,category,desc,serial,fac_id,eq_sts){

		var str = "#tr_"+id;

		var row = $(str).html();

		$("#edit_table_row").html(row);

		$("#editequipmentid").val(id);
		$("#editequipmentcategory").val(category);
		$("#editequipment").val(desc);
		$("#editfac").val(fac_id);
		$("#editserial").val(serial);

		$('input[name=editstatus][value=1]').prop('checked', false);
		$('input[name=editstatus][value=2]').prop('checked', false);
		$('input[name=editstatus][value=3]').prop('checked', false);

		$('input[name=editstatus][value='+eq_sts+']').prop('checked', true);
			
		$("#editdetailsdiv").modal("show");

	}

	function hide_edit(){
		$("#editdetailsdiv").modal("hide");
	}


</script>
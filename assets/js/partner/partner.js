$().ready(function() {
    //$("#tabs1-pima").delay(2000).removeClass("tab-pane active");
    //$("#tabs1-pima").addClass("tab-pane");		
    //$("#linkPima").delay(2000).trigger("click");	
   	//$("#linkSummary").delay(2000).trigger("click");
   	var linkSummary = $("#tabs1-summary").html();
   	var linkPima = $("#tabs1-pima").html();
	$( "#linkSummary" ).click(function() {
  		$("#tabs1-summary").html(linkSummary);
	});
   	$( "#linkPima" ).click(function() {
  		$("#tabs1-pima").html(linkPima);
	});

});
var dataString ='<chart manageResize="1" dateFormat="dd/mm/yyyy" ganttLineColor="CCCCCC" ganttLineAlpha="20" gridBorderAlpha="20" showTaskNames="1" hoverCapBgColor="F1F1F1" hoverCapBorderColor="333333" paletteThemeColor="333333" hoverBandColor="3d3d3d" hoverBandAlpha="95" showGanttPaneHorizontalHoverBand="0" showGanttPaneVerticalHoverBand="0">\n\
<categories bgColor="333333"  baseFont="Arial" baseFontCOlor="FFFFFF" baseFontSize="12" showhoverband="0" >\n\
	<category start="1/1/2005" end="31/5/2005" align="center" name="Sales Territory Assignment" fontColor="ffffff" isBold="1" fontSize="16" />\n\
</categories>\n\
<categories font="Arial" fontColor="ffffff" isBold="1" fontSize="12" bgColor="333333">\n\
	<category start="1/1/2005" end="31/1/2005" name="January" />\n\
	<category start="1/2/2005" end="28/2/2005" name="February" />\n\
	<category start="1/3/2005" end="31/3/2005" name="March" />\n\
	<category start="1/4/2005" end="30/4/2005" name="April"/>\n\
	<category start="1/5/2005" end="31/5/2005" name="May" />\n\
</categories>\n\
<processes headerbgColor="333333" fontColor="ffffff" fontSize="12" bgColor="333333" align="right" >\n\
	<process Name="Tom" id="1" />\n\
	<process Name="Harry" id="2" />\n\
	<process Name="Mary" id="4" />\n\
	<process Name="Mike" id="3" />\n\
</processes>\n\
<tasks  color="" alpha="" font="" fontColor="" fontSize="" isAnimated="1">\n\
	<task name="North" processId="1" start="3/1/2005" end="4/2/2005" Id="1_1" color="e1f5ff" borderColor="AFD8F8"/>\n\
	<task name="East" processId="1" start="6/2/2005" end="24/3/2005" Id="1_2" color="e1f5ff" borderColor="AFD8F8"/>\n\
	<task name="Vacation" processId="1" start="25/3/2005" end="18/4/2005" Id="1_3" color="e1f5ff" borderColor="AFD8F8" height="2" showBorder="1" topPadding="49%"/>\n\
	<task name="South" processId="1" start="18/4/2005" end="24/5/2005" Id="1_4" color="e1f5ff" borderColor="AFD8F8"/>\n\
	<task name="South" processId="2" start="15/1/2005" end="5/3/2005" Id="2_1" color="F6BD0F" borderColor="F6BD0F"/>\n\
	<task name="West" processId="2" start="21/3/2005" end="10/5/2005" Id="2_2" color="F6BD0F" borderColor="F6BD0F"/>\n\
	<task name="Global" processId="3" start="7/1/2005" end="26/5/2005" Id="3_1" width="12" color="8BBA00" borderColor="8BBA00"/>\n\
  	<task name="South" processId="4" start="13/3/2005" end="19/4/2005" Id="4_1" width="12" color="FF654F" borderColor="FF654F" />\n\
</tasks>\n\
<connectors>\n\
	<connector fromTaskId="1_2" toTaskId="2_2" color="AFD8F8" thickness="2"/>\n\
	<connector fromTaskId="2_1" toTaskId="4_1" color="F7CB41" thickness="2"/>\n\
</connectors>\n\
</chart>';
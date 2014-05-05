var dataString ='<chart manageResize="1" showTaskNames="1" dateFormat="dd/mm/yyyy" hoverCapBgColor="FFFFFF" hoverCapBorderColor="333333" ganttLineColor="99CC00" ganttLineAlpha="20" baseFontColor="333333" gridBorderColor="99CC00" taskBarRoundRadius="4" showShadow="0">\n\
	<categories  bgColor="333333" fontColor="99cc00" isBold="1" fontSize="14" showHoverBand="0" >\n\
		<category start="1/9/2005" end="31/12/2005" name="2005" />\n\
		<category start="1/1/2006" end="31/7/2006" name="2006" />\n\
	</categories>\n\
	<categories  bgColor="99cc00" bgAlpha="40" fontColor="333333" align="center" fontSize="10" isBold="1" hoverBandColor="a8d326" hoverBandAlpha="20">\n\
		<category start="1/9/2005" end="30/9/2005" name="Sep" />\n\
		<category start="1/10/2005" end="31/10/2005" name="Oct" />\n\
		<category start="1/11/2005" end="30/11/2005" name="Nov" />\n\
		<category start="1/12/2005" end="31/12/2005" name="Dec" />\n\
		<category start="1/1/2006" end="31/1/2006" name="Jan" />\n\
		<category start="1/2/2006" end="28/2/2006" name="Feb" />\n\
		<category start="1/3/2006" end="31/3/2006" name="March" />\n\
		<category start="1/4/2006" end="30/4/2006" name="Apr" />\n\
		<category start="1/5/2006" end="31/5/2006" name="May" />\n\
		<category start="1/6/2006" end="30/6/2006" name="June" />\n\
		<category start="1/7/2006" end="31/7/2006" name="July" />\n\
	</categories>\n\
	<processes positionInGrid="right" align="center" headerText=" Leader  " fontColor="333333" fontSize="11" isBold="1" isAnimated="1" bgColor="99cc00" headerbgColor="333333" headerFontColor="9ece0c" headerFontSize="16" bgAlpha="40" hoverBandColor="9ece0c" hoverBandAlpha="30" >\n\
		<process Name="Mark" id="1" />\n\
		<process Name="Tom" id="2" />\n\
		<process Name="David" id="3" />\n\
		<process Name="Alan" id="4" />\n\
		<process Name="Adam" id="5" />\n\
		<process Name="Peter" id="6" />\n\
	</processes>\n\
	<dataTable showProcessName="1" fontColor="333333" fontSize="11" isBold="1" headerFontColor="000000" headerFontSize="11" >\n\
		<dataColumn headerbgColor="333333" width="150" headerfontSize="16" headerAlign="left" headerfontcolor="99cc00"  bgColor="99cc00" headerText=" Team" align="left" bgAlpha="65">\n\
			<text label=" MANAGEMENT" />\n\
			<text label=" PRODUCT MANAGER" />\n\
			<text label=" CORE DEVELOPMENT" />\n\
			<text label=" Q & A / DOC." />\n\
			<text label=" WEB TEAM" />\n\
			<text label=" MANAGEMENT" />\n\
		</dataColumn>\n\
	</dataTable>\n\
	<tasks  width="10" >\n\
		<task name="Survey" hoverText="Market Survey" processId="1" start="7/9/2005" end="10/10/2005" id="Srvy" color="99cc00" alpha="60" topPadding="19" />\n\
 		<task name="Concept" hoverText= "Develop Concept for Product" processId="1" start="25/10/2005" end="9/11/2005" id="Cpt1" color="99cc00" alpha="60"  />\n\
	 	<task name="Concept" showName="0" hoverText= "Develop Concept for Product" processId="2" start="25/10/2005" end="9/11/2005" id="Cpt2" color="99cc00" alpha="60"  />\n\
		<task name="Design" hoverText= "Preliminary Design" processId="2" start="12/11/2005" end="25/11/2005" id="Desn" color="99cc00" alpha="60"/>\n\
		<task name="Product Development" processId="2" start="6/12/2005" end="2/3/2006" id="PD1" color="99cc00" alpha="60"/>\n\
		<task name="Product Development" processId="3" start="6/12/2005" end="2/3/2006" id="PD2" color="99cc00" alpha="60" />\n\
		<task name="Doc Outline" hoverText="Documentation Outline" processId="2" start="6/4/2006" end="1/5/2006" id="DocOut" color="99cc00" alpha="60"/>\n\
		<task name="Alpha" hoverText="Alpha Release" processId="4" start="15/3/2006" end="2/4/2006" id="alpha" color="99cc00" alpha="60"/>\n\
		<task name="Beta" hoverText="Beta Release" processId="3" start="10/5/2006" end="2/6/2006" id="Beta" color="99cc00" alpha="60"/>\n\
		<task name="Doc." hoverText="Documentation" processId="4" start="12/5/2006" end="29/5/2006" id="Doc" color="99cc00" alpha="60"/>\n\
		<task name="Website Design" hoverText="Website Design" processId="5" start="18/5/2006" end="22/6/2006" id="Web" color="99cc00" alpha="60"/>\n\
		<task name="Release" hoverText="Product Release" processId="6" start="5/7/2006" end="29/7/2006" id="Rls" color="99cc00" alpha="60"/>\n\
		<task name="Dvlp" hoverText="Development on Beta Feedback" processId="3" start="10/6/2006" end="1/7/2006" id="Dvlp" color="99cc00" alpha="60"/>\n\
		<task name="QA" hoverText="QA Testing" processId="4" start="9/4/2006" end="22/4/2006" id="QA1" color="99cc00" alpha="60"/>\n\
  		<task name="QA2" hoverText="QA Testing-Phase 2" processId="4" start="25/6/2006" end="5/7/2006" id="QA2" color="99cc00" alpha="60"/>\n\
	</tasks>\n\
	<connectors color="99cc00" thickness="2" >\n\
		<connector fromTaskId="Cpt1" toTaskId="Cpt2" fromTaskConnectStart="1"/>\n\
		<connector fromTaskId="PD1" toTaskId="PD2" fromTaskConnectStart="1"/>\n\
		<connector fromTaskId="PD1" toTaskId="alpha" />\n\
		<connector fromTaskId="PD2" toTaskId="alpha" />\n\
		<connector fromTaskId="DocOut" toTaskId="Doc" />\n\
		<connector fromTaskId="QA1" toTaskId="beta" />\n\
		<connector fromTaskId="Dvlp" toTaskId="QA2" />\n\
		<connector fromTaskId="QA2" toTaskId="Rls" />\n\
	</connectors>\n\
	<milestones>\n\
		<milestone date="29/7/2006" taskId="Rls" radius="10" color="333333" shape="Star" numSides="5" borderThickness="1"/>\n\
		<milestone date="2/3/2006" taskId="PD1" radius="10" color="333333" shape="Star" numSides="5" borderThickness="1" />\n\
		<milestone date="2/3/2006" taskId="PD2" radius="10" color="333333" shape="Star" numSides="5" borderThickness="1"/>\n\
	</milestones>\n\
</chart>';
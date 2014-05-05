var dataString ='<chart bgColor="ffffff" caption="Sales distribution by Employee" numberPrefix="$" isSliced="1" showValues="1" >\n\
<set label="Buchanan" value="20000" />\n\
<set label="Callahan" value="49000" />\n\
<set label="Davolio" value="63000" />\n\
<set label="Dodsworth" value="41000" />\n\
<set label="Fuller" value="74000" />\n\
<styles>\n\
<definition>\n\
<style type="font" name="captionFont" size="18" font="Times New Roman"  align="left" borderColor="cccccc" bgColor="ededed"  bold="0"/>\n\
<style type="font" name="dataFont" size="14" italic="1"  font="Times New Roman" />\n\
<style name="Animation_1" type="ANIMATION" duration="2" start="0" param="_xScale" easing="bounce"/>\n\
</definition>\n\
<application>\n\
<apply toObject="CAPTION" styles="captionFont" />\n\
<apply toObject="DATAPLOT" styles="Animation_1"/>\n\
<apply toObject="DATALABELS" styles="dataFont"/>\n\
</application>\n\
</styles>\n\
</chart>';

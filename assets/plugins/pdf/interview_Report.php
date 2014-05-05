<?php
# pdf_example4
# a simple bar graph

// create a new pdf document
$pdf = pdf_new();
$filename = 'c:pdf_example4.pdf';
pdf_open_file($pdf, $filename);

// start a new page (Letter size)
pdf_begin_page($pdf, 612, 792);

// setup font and print hello world
pdf_set_parameter($pdf, 'FontOutline',
'Arial=c:windowsfontsarial.ttf');
$font = pdf_findfont($pdf, "Arial", "host", 1);
pdf_setfont($pdf, $font, 16);
pdf_show_xy($pdf, "Simple Bar Graph", 50, 720);

// draw the x and y axis
pdf_moveto($pdf, 50, 690);
pdf_lineto($pdf, 50, 520);
pdf_lineto($pdf, 400, 520);
pdf_stroke($pdf);

// draw the bar chart
$x = 80;
$y = 520;
$w = 40;

// the data and color for each column
$data = array('120','160','300','240');
$color = array('#4EC3BC', '#DAA876', '#E29CC8', '#FDE0C6');

// get into some meat now, cheese for vegetarians;
for ($i=0;$i<count($data);$i++){

// calculate the height of the bar
$y_ht = ($data[$i]/max($data))* 100;

// set the color for each bar
list($r, $g, $b) = hex2rgb($color[$i]);
pdf_setcolor($pdf, "fill", "rgb", $r, $g, $b, 0);

// draw the bar
pdf_rect($pdf, $x, $y, $w, $y_ht);
pdf_fill_stroke($pdf);

// write the bar label
pdf_setcolor($pdf, "fill", "rgb", 0, 0, 0, 0);
pdf_setfont($pdf, $font, 10);
pdf_show_xy($pdf, $data[$i], $x+12, $y-16);

// go to the next bar
$x = $x+$w+40;
}

// done
pdf_end_page($pdf);
pdf_close($pdf);
pdf_delete($pdf);

// send it to browser
header("Content-type: application/pdf");
header("Content-Disposition: inline; filename=pdf_example3.pdf");
readfile($filename);
unlink($filename);

// function to convert a standard rgb from hex to float
function hex2rgb($hex) {
$color = str_replace('#','',$hex);
$r = hexdec(substr($color,0,2))/255;
$g = hexdec(substr($color,2,2))/255;
$b = hexdec(substr($color,4,2))/255;
return array($r, $g, $b);
}

?>

Read more at http://www.devshed.com/c/a/PHP/Generate-PDF-Documents-with-PHP-on-the-Windows-Platform/4/#i4Qly6wMSR7uB3UB.99 
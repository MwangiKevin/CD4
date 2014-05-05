<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class chart extends MY_Controller {

	public function index()	{
	}
	public function chart_test_data_line(){
		return '{
			  "chart": {
			    "caption":"",
			    "subcaption":"",
			    "yAxisName":"Reported Facilities",
			    "lineThickness":"2",
			    "showValues":"0",
			    "formatNumberScale":"0",
			    "anchorRadius":"2",
			    "divLineAlpha":"20",
			    "divLineColor":"CC3300",
 				"divLineIsDashed":"1" ,
 				"showAlternateHGridColor":"1" ,
 				"alternateHGridAlpha":"5" ,
 				"alternateHGridColor":"CC3300" ,
 				"shadowAlpha":"40" ,
 				"labelStep":"" ,
 				"numvdivlines":"10" ,
 				"chartRightMargin":"35" ,
 				"bgColor":"D0F0F0" ,
 				"bgAngle":"270" ,
 				"bgAlpha":"10,10" ,
 				"showBorder":"0" ,
 				"formatNumberScale":"0"
			  },
			  "categories": [
			    {
			      "category": [
			        {
			          "label": "Jan"
			        },
			        {
			          "label": "Feb"
			        },
			        {
			          "label": "Mar"
			        },
			        {
			          "label": "Apr"
			        },
			        {
			          "label": "May"
			        },
			        {
			          "label": "Jun"
			        },
			        {
			          "label": "Jul"
			        },
			        {
			          "label": "Aug"
			        },
			        {
			          "label": "Sep"
			        },
			        {
			          "label": "Oct"
			        },
			        {
			          "label": "Nov"
			        },
			        {
			          "label": "Dec"
			        }
			      ]
			    }
			  ],
			  "dataset": [
			    {
			      "seriesname": "PIMA",
			      "color": "A66EDD",
			      "data": [
			        {
			          "value": "1154"
			        },
			        {
			          "value": "1234"
			        },
			        {
			          "value": "1256"
			        },
			        {
			          "value": "1565"
			        },
			        {
			          "value": "4454"
			        },
			        {
			          "value": "1654"
			        },
			        {
			          "value": "1234"
			        },
			        {
			          "value": "1356"
			        },
			        {
			          "value": "1365"
			        },
			        {
			          "value": "1454"
			        },
			        {
			          "value": "1565"
			        },
			        {
			          "value": "1134"
			        }
			      ]
			    },
			    {
			      "seriesname": "Other Device",
			      "color": "F6BD0F",
			      "data": [
			        {
			          "value": "954"
			        },
			        {
			          "value": "624"
			        },
			        {
			          "value": "996"
			        },
			        {
			          "value": "565"
			        },
			        {
			          "value": "1154"
			        },
			        {
			          "value": "654"
			        },
			        {
			          "value": "634"
			        },
			        {
			          "value": "456"
			        },
			        {
			          "value": "165"
			        },
			        {
			          "value": "444"
			        },
			        {
			          "value": "155"
			        },
			        {
			          "value": "145"
			        }
			      ]
			    }
			  ],
			  "styles": {
			    "definition": [
			      {
			        "name": "XScaleAnim",
			        "type": "ANIMATION",
			        "duration": "0.5",
			        "start": "0",
			        "param": "_xScale"
			      },
			      {
			        "name": "YScaleAnim",
			        "type": "ANIMATION",
			        "duration": "0.5",
			        "start": "0",
			        "param": "_yscale"
			      },
			      {
			        "name": "XAnim",
			        "type": "ANIMATION",
			        "duration": "0.5",
			        "start": "0",
			        "param": "_yscale"
			      },
			      {
			        "name": "AlphaAnim",
			        "type": "ANIMATION",
			        "duration": "0.5",
			        "start": "0",
			        "param": "_alpha"
			      }
			    ],
			    "application": [
			      {
			        "toobject": "CANVAS",
			        "styles": "XScaleAnim, YScaleAnim,AlphaAnim"
			      },
			      {
			        "toobject": "DIVLINES",
			        "styles": "XScaleAnim,AlphaAnim"
			      },
			      {
			        "toobject": "VDIVLINES",
			        "styles": "YScaleAnim,AlphaAnim"
			      },
			      {
			        "toobject": "HGRID",
			        "styles": "YScaleAnim,AlphaAnim"
			      }
			    ]
			  }
			}';
	}
	public function chart_test_data_pie(){

		echo '{
			  "chart": {
			    "caption":"",
			    "subcaption":"",
			    "yAxisName":"Reported Facilities",
			    "lineThickness":"2",
			    "showValues":"0",
			    "formatNumberScale":"0",
			    "anchorRadius":"2",
			    "divLineAlpha":"20",
			    "divLineColor":"CC3300",
 				"divLineIsDashed":"1" ,
 				"showAlternateHGridColor":"1" ,
 				"alternateHGridAlpha":"5" ,
 				"alternateHGridColor":"CC3300" ,
 				"shadowAlpha":"40" ,
 				"labelStep":"" ,
 				"numvdivlines":"10" ,
 				"chartRightMargin":"35" ,
 				"bgColor":"D0F0F0" ,
 				"bgAngle":"270" ,
 				"bgAlpha":"10,10" ,
 				"showBorder":"0" ,
 				"formatNumberScale":"0"
			  },
			  "data": [
			    {
			      "label": "PIMA",
			      "value": "100524",
			      "issliced": "1",
			      "color" : "0372AB"
			    },
			    {
			      "label": "OTHER",
			      "value": "87790",
			      "issliced": "0",
			      "color" : "FF0000"
			    }
			    
			  ],
			  "styles": {
			    "definition": [
			      {
			        "type": "font",
			        "name": "CaptionFont",
			        "size": "15",
			        "color": "666666"
			      },
			      {
			        "type": "font",
			        "name": "SubCaptionFont",
			        "bold": "0"
			      }
			    ],
			    "application": [
			      {
			        "toobject": "caption",
			        "styles": "CaptionFont"
			      },
			      {
			        "toobject": "SubCaption",
			        "styles": "SubCaptionFont"
			      }
			    ]
			  }
			}';
	}
	public function chart_test_data_column(){
		echo '{
			    "chart": {
			        "caption":"",
				    "subcaption":"",
				    "yAxisName":"Error Frequency",
				    "lineThickness":"2",
				    "showValues":"0",
				    "placevaluesinside":"0",
				    "formatNumberScale":"0",
				    "anchorRadius":"2",
				    "divLineAlpha":"20",
				    "divLineColor":"CC3300",
	 				"divLineIsDashed":"1" ,
	 				"showAlternateHGridColor":"1" ,
	 				"alternateHGridAlpha":"5" ,
	 				"alternateHGridColor":"CC3300" ,
	 				"shadowAlpha":"40" ,
	 				"labelStep":"" ,
	 				"numvdivlines":"10" ,
	 				"chartRightMargin":"35" ,
	 				"bgColor":"D0F0F0" ,
	 				"bgAngle":"270" ,
	 				"bgAlpha":"10,10" ,
	 				"showBorder":"0" ,
	 				"formatNumberScale":"0"
			    },
			    "data": [
			        {
			            "label": "201",
			            "value": "3"
			        },
			        {
			            "label": "200",
			            "value": "2"
			        },
			        {
			            "label": "210",
			            "value": "5"
			        },
			        {
			            "label": "300-399",
			            "value": "1"
			        },
			        {
			            "label": "810",
			            "value": "7"
			        }
			    ]
			}';
	}
}

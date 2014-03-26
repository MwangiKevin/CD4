<?php

$config['chart_header']		=	array(
										"chart" =>	array(
													"caption"					=>			"",
												    "subcaption"				=>			"",
												    "yAxisName"					=>			"",
												    "lineThickness"				=>			"2",
												    "showValues"				=>			"0",
												    "formatNumberScale"			=>			"1",
												    "anchorRadius"				=>			"2.5",
												    "divLineAlpha"				=>			"20",
												    "divLineColor"				=>			"DD3300",
									 				"divLineIsDashed"			=>			"1" ,
									 				"showAlternateHGridColor"	=>			"1" ,
									 				"alternateHGridAlpha"		=>			"5" ,
									 				"alternateHGridColor"		=>			"CC3300" ,
									 				"shadowAlpha"				=>			"40" ,
									 				"labelStep"					=>			"1" ,
									 				"numvdivlines"				=>			"10" ,
									 				"chartRightMargin"			=>			"35" ,
									 				"bgColor"					=>			"D0F0F0" ,
									 				"bgAngle"					=>			"270" ,
									 				"bgAlpha"					=>			"10,10" ,
									 				"showBorder"				=>			"0" ,
									 				"formatNumberScale"			=>			"0"
							 				)
									);
$config["line_graph_style"]=	array(
									"styles" 	=> 	array(
															"definition"	=>	array(
																	array(
																			"name"     		=>	 "XScaleAnim",
																	        "type"     		=>	 "ANIMATION",
																	        "duration"     	=>	 "0.5",
																	        "start"     	=>	 "0",
																	        "param"     	=>	 "_xScale"
																		),
																	array(
																			"name"     		=>	 "YScaleAnim",
																	        "type"     		=>	 "ANIMATION",
																	        "duration"     	=>	 "0.5",
																	        "start"     	=>	 "0",
																	        "param"     	=>	 "_yscale"
																		),
																	array(
																			"name"     		=>	 "XAnim",
																	        "type"     		=>	 "ANIMATION",
																	        "duration"     	=>	 "0.5",
																	        "start"     	=>	 "0",
																	        "param"     	=>	 "_yscale"
																		),
																	array(
																			"name"     		=>	 "AlphaAnim",
																	        "type"     		=>	 "ANIMATION",
																	        "duration"     	=>	 "0.5",
																	        "start"     	=>	 "0",
																	        "param"     	=>	 "_alpha"
																		)
																),
															"application"	=>	array(
																	array(
																			"toobject"     	=>	 "CANVAS",
			        														"styles"     	=>	 "XScaleAnim, YScaleAnim,AlphaAnim"
																		),
																	array(
																			"toobject"     	=>	 "DIVLINES",
			        														"styles"     	=>	 "XScaleAnim,AlphaAnim"
																		),
																	array(
																			"toobject"     	=>	 "VDIVLINES",
			        														"styles"     	=>	 "YScaleAnim,AlphaAnim"
																		),
																	array(
																			"toobject"     	=>	 "HGRID",
			        														"styles"     	=>	 "YScaleAnim,AlphaAnim"
																		)
																)
														)
									);

$config["pie_chart_style"]=	array(

			"styles"=>array(
					    "definition"=>array(
							      array(
								        "type"		=>	"font",
								        "name"		=>	"CaptionFont",
								        "size"		=>	"15",
								        "color"		=> 	"666666"
							      ),
							      array(
								        "type"		=> "font",
								        "name"		=> "SubCaptionFont",
								        "bold"		=> "0"
							     			)
					    ),

					    "application" => array(
							      array(
								        "toobject"=> "caption",
								        "styles"=> "CaptionFont"
							      		),
							      array(
								        "toobject"=> "SubCaption",
								        "styles"=> "SubCaptionFont"
							      		)
					    					)
			  		)

			);

//all highchart shell array are pefixed "hgc"

$config["hgc_column_stacked_grouped"] 		= 		array(
														'chart'	=>	array(
																		'type'	=>	"column",
																		'height' => "260",
															),
														'title'	=>	array(
																		'text'	=>	""
															),
														'xAxis'	=>	array(
																		'categories'	=>	array(),
																		'labels'		=> 	array(
																								'rotation'	=>	-45,
																								'align'		=>	"right",
																								'style'		=>	array(
																										'fontSize'	=> "11px"
																									)
																				)
															),
														'yAxis'	=>	array(
																		'allowDecimals'	=>	false,
																		'min'			=>	0,
																		'title'			=>	array(
																			)
															),
														'credits'	=>	array(
																			'enabled'	=>	false
															),
														'plotOptions'	=>	array(
																		'column'	=>	array(
																							'stacking'	=>	"normal"
																			)
															),
														'series'	=>	array(),
														'tooltip'	=>	"null"

													);

$config["hgc_pie_"] 						= 		array(
														'chart'	=>	array(
																		'type'	=>	"pie",
																		'height' => "400"
															),
														'title'	=>	array(
																		'text'	=>	""
															),
														'xAxis'	=>	array(
																		'categories'	=>	array()
															),
														'yAxis'	=>	array(
																		'allowDecimals'	=>	false,
																		'min'			=>	0,
																		'title'			=>	array(
																								'text' 	=>	"YAxis"
																			)
															),
														'credits'	=>	array(
																			'enabled'	=>	false
															),
														'plotOptions'	=>	array(
																		'column'	=>	array(
																							'stacking'	=>	"normal"
																			)
															),
														'series'	=>	array(),
														'tooltip'	=>	"null"
													);
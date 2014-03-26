<?php 

class reports_model extends CI_Model{

//Combo Box for Device Number on reports page
function DeviceNumberOptions($partnerID)
{

	//$groupquery=$this->db->query("SELECT f.facility_equipment_id, f.serial_num FROM facility_pima f, pima_upload p WHERE f.facility_equipment_id = p.facility_pima_id AND p.uploaded_by ='".$partnerID."' GROUP BY f.facility_equipment_id");
	
	$groupquery=$this->db->query("SELECT f.facility_equipment_id, f.serial_num
									FROM facility_pima f, pima_upload p
									WHERE p.uploaded_by =  '".$partnerID."'
									GROUP BY f.facility_equipment_id");

	
	if($groupquery->num_rows()>0)
	{
		foreach ($groupquery->result() as $value) 
		{
			$DeviceOptions[]=$value->serial_num;
		}
		return $DeviceOptions;
	}
	else
	{
		$DeviceOptions="No device";
		return $DeviceOptions;
	}			
	
}

 function getyearsreported($partnerid)
  {
		$sql="SELECT DISTINCT YEAR( pt.result_Date ) AS yr
						FROM pima_test pt, pima_upload pu
						WHERE pu.uploaded_by =  '".$partnerid."'
						AND pu.id = pt.pima_upload_id";
		$query=$this->db->query($sql);

		if($query->num_rows()>0)
		{
			foreach ($query->result_array() as $value) 
			{
				$res[]=$value;
			}
		}
		else
		{
			$res="No data";
		}
		return $res;
		
			
	}

	function getFacilities($partnerid)
	{
		$sql="SELECT f.name FROM facility f, facility_equipment fe, cd4_test cd4t, pima_upload pU
					WHERE cd4t.facility_equipment_id = fe.id
					AND cd4t.facility_id = fe.facility_id
					AND cd4t.facility_id=f.id
					AND pU.uploaded_by ='".$partnerid."' GROUP BY f.name";

		$query=$this->db->query($sql);

		if($query->num_rows()>0)
		{
			foreach ($query->result() as $value) 
			{
				$res[]=$value->name;
			}
			
		}
		else
		{
			$res="No facility";
		}			

		return $res;
	}

/*...................Start of PDF Functions..............................*/

	function year_month_report($Year,$Monthly,$all,$facility,$device,$from_month,$end_month,$report_type)
	{
		$img=base_url().'img/nascop.jpg';// Nascop Logo
		$Data['img']=$img;

		$this->load->model('reports_charts_model');
		$the_month=$this->GetMonthName($Monthly);

		if($facility!="")
		{
			$pdf_facility_results=$this->cd4_test_facility_PDF($facility,$from_month,$end_month);
			$device="";
			$all="";
			if($report_type==1)
			{

							$tests_done=0;
							$count=0;
							$errors=0;

							if($pdf_facility_results!="")
							{
								foreach ($pdf_facility_results as $value) 
								{
									if($value['valid']==1)
									{
										$tests_done+=$value['valid'];
										$count++;
									}
									else
									{
										$count++;
									}
								}
							}else
							{
								$tests_done=0;
								$count=0;
							}	
							
							
				
			}
			else if($report_type==2)
			{

				
							$tests_done=0;
							$errors=0;
							$count=0;
							
							if($pdf_facility_results!="")
							{
								foreach ($pdf_facility_results as $value) 
								{
									if($value['valid']==0)
									{
										$errors++;
										$count++;
									}
									else
									{
										$count++;
									}
								
								}
							}else
							{
								$errors=0;
								$count=0;
							}
							
			}
			else
			{
				
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_facility_results!="")
						{
							foreach ($pdf_facility_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							$tests_done=0;
							$errors=0;
							$count=0;
						}

														
			}				

		}

		if($device!="")
		{
			$pdf_device_results=$this->cd4_test_device_PDF($device,$from_month,$end_month);
			$facility="";
			$all="";
			if($report_type==1)
			{
				
							$tests_done=0;
							$errors=0;
							$count=0;

							if($pdf_device_results!="")
							{
								foreach ($pdf_device_results as $value) 
								{
									if($value['valid']==1)
									{
										$tests_done+=$value['valid'];
										$count++;
									}
									else
									{
										$count++;
									}
								}
							}else
							{
								$tests_done=0;
								$count=0;
							}

							
							
			}
			else if($report_type==2)
			{
							$tests_done=0;
							$errors=0;
							$count=0;
							
							if($pdf_device_results!="")
							{
								foreach ($pdf_device_results as $value) 
								{
									if($value['valid']==0)
									{
										$errors++;
										$count++;
									}
									else
									{
										$count++;
									}
								
								}
							}else
							{
								$errors=0;
								$count=0;
							}
				
			}

			else
			{
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_device_results!="")
						{
							foreach ($pdf_device_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							$tests_done=0;
							$errors=0;
							$count=0;
						}
								
							
			}
		}

		if($all==3)
		{
			$pdf_results=$this->cd4_test_report($from_month,$end_month);
			$device="";
			$facility="";
			if($report_type==1)
			{

						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_results!="")
						{
							foreach ($pdf_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$count++;
								}
							}
						}else
						{
							$tests_done=0;
							$count=0;
						}

			}
			else if($report_type==2)
			{
						$errors=0;
						$count=0;
						
						if($pdf_results!="")
						{
							foreach ($pdf_results as $value) 
							{
								if($value['valid']==0)
								{
									$errors++;
									$count++;
								}
								else
								{
									$count++;
								}
							
							}
						}else
						{
							$errors=0;
							$count=0;
						}

			}

			else
			{
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_results!="")
						{
							foreach ($pdf_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							
							$tests_done=0;
							$errors=0;
							$count=0;
						}
		
			}
		}

							/*
								put data in array to load in view
								
							*/
							$Data['img']=$img;
							$Data['report_type']=$report_type;
							$Data['tests_done']=$tests_done;
							$Data['errors']=$errors;
							$Data['count']=$count;
							$Data['facility']=$facility;
							$Data['device']=$device;
							$Data['all']=$all;
							$Data['the_month']=$the_month;
							$Data['quarter']="";
							$Data['q_no']="";
							$Data['bian']="";
							$Data['b_no']="";
							$Data['Year']=$Year;
							$Data['Year_cri']="";
							$Data['from']="";
							$Data['to']="";


							$this->load->view('report_pdf_view',$Data);// load view

	}

	

	function year_quarter_report($yearQ,$quarter,$q_no,$all,$facility,$device,$from_month,$end_month,$report_type)
	{
		$img=base_url().'img/nascop.jpg';// Nascop Logo

		$GraphPDF='<table width="53%" border="0" align="center">
						<tr>
							<td><center><img style="vertical-align: top;" src="'.$img.'"/></center></td>
						</tr>
					</table>';
		if($facility!="")//Check if a facility was picked
		{	
			$all="";
			$device="";

			$pdf_facility_results=$this->cd4_test_facility_PDF($facility,$from_month,$end_month);
			
			if($report_type==1)
			{
				//$facility;
				$device="";
				$all="";
			

						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_facility_results!="")
						{
							foreach ($pdf_facility_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$count++;
								}
							}
						}else
						{
							$tests_done=0;
							$count=0;
						}	
							
							
			}
			else if($report_type==2)
			{
				
						$tests_done=0;
						$errors=0;
						$count=0;
						
						if($pdf_facility_results!="")
						{
							foreach ($pdf_facility_results as $value) 
							{
								if($value['valid']==0)
								{
									$errors++;
									$count++;
								}
								else
								{
									$count++;
								}
							
							}
						}else
						{
							$errors=0;
							$count=0;
						}
							
			}
			else
			{
								
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_facility_results!="")
						{
							foreach ($pdf_facility_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							$tests_done=0;
							$errors=0;
							$count=0;
						}
										
			}


					
		}

		if($device!="")//Check if a device was picked
		{
			$facility="";
			$all="";
			
			$pdf_device_results=$this->cd4_test_device_PDF($device,$from_month,$end_month);
			
			if($report_type==1)
			{
				
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_device_results!="")
						{
							foreach ($pdf_device_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$count++;
								}
							}
						}else
						{
							$tests_done=0;
							$count=0;
						}	
					
			}
			else if($report_type==2)
			{
				
						$tests_done=0;
						$errors=0;
						$count=0;
						
						if($pdf_device_results!="")
						{
							foreach ($pdf_device_results as $value) 
							{
								if($value['valid']==0)
								{
									$errors++;
									$count++;
								}
								else
								{
									$count++;
								}
							
							}
						}else
						{
							$errors=0;
							$count=0;
						}
					
			}
			else
			{
				
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_device_results!="")
						{
							foreach ($pdf_device_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							$tests_done=0;
							$errors=0;
							$count=0;
						}
						
			}

		}

		if($all==3)
		{
			$device="";
			$facility="";

			$pdf_results=$this->cd4_test_report($from_month,$end_month);
			
			if($report_type==1)
			{
		
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_results!="")
						{
							foreach ($pdf_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$count++;
								}
							}
						}else
						{
							$tests_done=0;
							$count=0;
						}	
					

			}
			else if($report_type==2)
			{
		
						$tests_done=0;
						$errors=0;
						$count=0;
						
						if($pdf_results!="")
						{
							foreach ($pdf_results as $value) 
							{
								if($value['valid']==0)
								{
									$errors++;
									$count++;
								}
								else
								{
									$count++;
								}
							
							}
						}else
						{
							$errors=0;
							$count=0;
						}
			}

			else
			{
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_results!="")
						{
							foreach ($pdf_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							$tests_done=0;
							$errors=0;
							$count=0;
						}
								
			}
		}

					$Data['img']=$img;
					$Data['report_type']=$report_type;
					$Data['tests_done']=$tests_done;
					$Data['errors']=$errors;
					$Data['count']=$count;
				    $Data['facility']=$facility;
					$Data['device']=$device;
					$Data['all']=$all;

					//die;
					$Data['the_month']="";
					$Data['quarter']=$quarter;
					$Data['q_no']=$q_no;
					$Data['bian']="";
					$Data['b_no']="";
					$Data['Year']=$yearQ;
					$Data['Year_cri']="";
					$Data['from']="";
					$Data['to']="";


					$this->load->view('report_pdf_view',$Data);
		
	}

	

	function year_biannual_report($yearB,$biannual,$b_no,$all,$facility,$device,$from_month,$end_month,$report_type)
	{
		$img=base_url().'img/nascop.jpg';// Nascop Logo

		$GraphPDF='<table width="53%" border="0" align="center">
						<tr>
							<td><center><img style="vertical-align: top;" src="'.$img.'"/></center></td>
						</tr>
					</table>';

		if($facility!="")
		{
			$device="";
			$all="";
			$pdf_facility_results=$this->cd4_test_facility_PDF($facility,$from_month,$end_month);
			
			if($report_type==1)
			{

						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_facility_results!="")
						{
							foreach ($pdf_facility_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$count++;
								}
							}
						}else
						{
							$tests_done=0;
							$count=0;
						}	
			}
			else if($report_type==2)
			{
						$tests_done=0;
						$errors=0;
						$count=0;
						
						if($pdf_facility_results!="")
						{
							foreach ($pdf_facility_results as $value) 
							{
								if($value['valid']==0)
								{
									$errors++;
									$count++;
								}
								else
								{
									$count++;
								}
							
							}
						}else
						{
							$errors=0;
							$count=0;
						}
							
			}
			else
			{
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_facility_results!="")
						{
							foreach ($pdf_facility_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							$tests_done=0;
							$errors=0;
							$count=0;
						}
								
							
			}

		}

		if($device!="")
		{
			$facility="";
			$all="";
			$pdf_device_results=$this->cd4_test_device_PDF($device,$from_month,$end_month);
			
			if($report_type==1)
			{
				
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_device_results!="")
						{
							foreach ($pdf_device_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$count++;
								}
							}
						}else
						{
							$tests_done=0;
							$count=0;
						}	
			}
			else if($report_type==2)
			{
				
						$tests_done=0;
						$errors=0;
						$count=0;
						
						if($pdf_device_results!="")
						{
							foreach ($pdf_device_results as $value) 
							{
								if($value['valid']==0)
								{
									$errors++;
									$count++;
								}
								else
								{
									$count++;
								}
							
							}
						}else
						{
							$errors=0;
							$count=0;
						}
							
			}
			else
			{
				
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_device_results!="")
						{
							foreach ($pdf_device_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							$tests_done=0;
							$errors=0;
							$count=0;
						}
								
							
			}
		}

		if($all==3)
		{
			$device="";
			$facility="";
			$pdf_results=$this->cd4_test_report($from_month,$end_month);
			
			
			if($report_type==1)
			{
				$GraphPDF.='<table border="1" align="center" width="480">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>
								<tr>
								';
								$tests_done=0;
								$errors=0;
								$count=0;

								if($pdf_results!="")
								{
									foreach ($pdf_results as $value) 
									{
										if($value['valid']==1)
										{
											$tests_done+=$value['valid'];
											$count++;
										}
										else
										{
											$count++;
										}
									}
								}else
								{
									$tests_done=0;
									$count=0;
								}	
							$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';

			}
			else if($report_type==2)
			{
				$GraphPDF.='<table width="480" border="1" align="center">
								<tr>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests with Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>
								';
								$tests_done=0;
								$errors=0;
								$count=0;
								
								if($pdf_results!="")
								{
									foreach ($pdf_results as $value) 
									{
										if($value['valid']==0)
										{
											$errors++;
											$count++;
										}
										else
										{
											$count++;
										}
									
									}
								}else
								{
									$errors=0;
									$count=0;
								}
							$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
			}

			else
			{
				$GraphPDF.='<table width="580" border="1" align="center">
								<tr>
									<th bgcolor="#006600" style="color:#FFF;">Successful Tests Done</th>
									<th bgcolor="#CC0000" style="color:#FFF;">Tests With Errors</th>
									<th bgcolor="#000066" style="color:#FFF;">Total Number of Tests</th>
								</tr>';
								$tests_done=0;
								$errors=0;
								$count=0;

								if($pdf_results!="")
								{
									foreach ($pdf_results as $value) 
									{
										if($value['valid']==1)
										{
											$tests_done+=$value['valid'];
											$count++;
										}
										else
										{
											$errors++;
											$count++;
										}
									}
								}
								else
								{
									$tests_done=0;
									$errors=0;
									$count=0;
								}
								
							$GraphPDF.='<tr><td align="center">'.$tests_done.'</td>';
							$GraphPDF.='<td align="center">'.$errors.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
			}
		}
		
						

					$Data['img']=$img;
					$Data['report_type']=$report_type;
					$Data['tests_done']=$tests_done;
					$Data['errors']=$errors;
					$Data['count']=$count;
					$Data['facility']=$facility;
					$Data['device']=$device;
					$Data['all']=$all;					
					$Data['the_month']="";
					$Data['quarter']="";
					$Data['q_no']="";
					$Data['bian']=$biannual;
					$Data['b_no']=$b_no;
					$Data['Year']=$yearB;
					$Data['Year_cri']="";
					$Data['from']="";
					$Data['to']="";


					$this->load->view('report_pdf_view',$Data);
		
	}


	function year_report($yearo,$all,$facility,$device,$from_month,$end_month,$report_type)
	{
		$img=base_url().'img/nascop.jpg';// Nascop Logo

		$GraphPDF='<table width="53%" border="0" align="center">
						<tr>
							<td><center><img style="vertical-align: top;" src="'.$img.'"/></center></td>
						</tr>
					</table>';

		if($facility!="")
		{
			$pdf_facility_results=$this->cd4_test_facility_PDF($facility,$from_month,$end_month);
			$device="";
			$all="";
			if($report_type==1)
			{
				

						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_facility_results!="")
						{
							foreach ($pdf_facility_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$count++;
								}
							}
						}else
						{
							$tests_done=0;
							$count=0;
						}	
					
			}
			else if($report_type==2)
			{

						$tests_done=0;
						$errors=0;
						$count=0;
						
						if($pdf_facility_results!="")
						{
							foreach ($pdf_facility_results as $value) 
							{
								if($value['valid']==0)
								{
									$errors++;
									$count++;
								}
								else
								{
									$count++;
								}
							
							}
						}else
						{
							$errors=0;
							$count=0;
						}
			}
			else
			{

						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_facility_results!="")
						{
							foreach ($pdf_facility_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							$tests_done=0;
							$errors=0;
							$count=0;
						}
								
			}

		}

		if($device!="")
		{
			$pdf_device_results=$this->cd4_test_device_PDF($device,$from_month,$end_month);
			$facility="";
			$all="";
			if($report_type==1)
			{
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_device_results!="")
						{
							foreach ($pdf_device_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$count++;
								}
							}
						}else
						{
							$tests_done=0;
							$count=0;
						}	
			}
			else if($report_type==2)
			{
						$tests_done=0;
						$errors=0;
						$count=0;
						
						if($pdf_device_results!="")
						{
							foreach ($pdf_device_results as $value) 
							{
								if($value['valid']==0)
								{
									$errors++;
									$count++;
								}
								else
								{
									$count++;
								}
							
							}
						}else
						{
							$errors=0;
							$count=0;
						}
			}
			else
			{

						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_device_results!="")
						{
							foreach ($pdf_device_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							$tests_done=0;
							$errors=0;
							$count=0;
						}
								
			}
		}

		if($all==3)
		{
			$pdf_results=$this->cd4_test_report($from_month,$end_month);
			$device="";
			$facility="";
			
			if($report_type==1)
			{
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_results!="")
						{
							foreach ($pdf_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$count++;
								}
							}
						}else
						{
							$tests_done=0;
							$count=0;
						}	

			}
			else if($report_type==2)
			{	
								$tests_done=0;
								$errors=0;
								$count=0;
								
								if($pdf_results!="")
								{
									foreach ($pdf_results as $value) 
									{
										if($value['valid']==0)
										{
											$errors++;
											$count++;
										}
										else
										{
											$count++;
										}
									
									}
								}else
								{
									$errors=0;
									$count=0;
								}
							$GraphPDF.='<tr><td align="center">'.$errors.'</td>';
							$GraphPDF.='<td align="center">'.$count.'</td></tr>';
							$GraphPDF.='</table>';
			}

			else
			{
						$tests_done=0;
						$errors=0;
						$count=0;

						if($pdf_results!="")
						{
							foreach ($pdf_results as $value) 
							{
								if($value['valid']==1)
								{
									$tests_done+=$value['valid'];
									$count++;
								}
								else
								{
									$errors++;
									$count++;
								}
							}
						}
						else
						{
							$tests_done=0;
							$errors=0;
							$count=0;
						}
							
			}
		}

		
					$Data['img']=$img;
					$Data['report_type']=$report_type;
					$Data['tests_done']=$tests_done;
					$Data['errors']=$errors;
					$Data['count']=$count;
					$Data['facility']=$facility;
					$Data['device']=$device;
					$Data['all']=$all;				
					$Data['the_month']="";
					$Data['quarter']="";
					$Data['q_no']="";
					$Data['bian']="";
					$Data['b_no']="";
					$Data['Year']="";
					$Data['Year_cri']=$yearo;
					$Data['from']="";
					$Data['to']="";


					$this->load->view('report_pdf_view',$Data);
	}

	

	function customized_dates_report($fromdate,$todate,$all,$facility,$device,$report_type)
	{
		$img=base_url().'img/nascop.jpg';// Nascop Logo

		
		if($facility!="")
		{	
			$device="";
			$all="";
			$sql_data="";

			$sql_data=$this->tests_details($fromdate,$todate);// get the data
			

			if($report_type==1)
			{
				$tests_done=0;
				$errors=0;
				$count=0;
				
				if($sql_data!="")
				{
					foreach($sql_data as $data)
					{
						if($data['valid']==1)
						{
							$tests_done+=$data['valid'];
							$count++;
						}
						else if($data['valid']==0)
						{
							$count++;
						}
					}
				}else
				{
					$tests_done=0;
					$count=0;
				}

				
			}
			else if($report_type==2)
			{
				$tests_done=0;
				$errors=0;
				$count=0;
				
				if($sql_data!="")
				{
					foreach($sql_data as $data)
					{
						if($data['valid']==1)
						{
							$count++;
						}
						else if($data['valid']==0)
						{
							$errors++;
							$count++;
						}
					}
				}
				else
				{
					$errors=0;
					$count=0;
				}

				
			}
			else
			{
				
				$tests_done=0;
				$errors=0;
				$count=0;
				
				if($sql_data!="")
				{
					foreach($sql_data as $data)
					{
						if($data['valid']==1)
						{
							$tests_done+=$data['valid'];
							$count++;
						}
						else if($data['valid']==0)
						{
							$errors++;
							$count++;
						}
					}
				}
				else
				{
					$tests_done=0;
					$errors=0;
					$count=0;
				}

				
			}

		}

		if($device!="")
		{	
			//echo "here";
			//echo $device;
			//die;
			$facility="";
			$all="";
			$sql_data="";

			$sql_data=$this->tests_details($fromdate,$todate);// get the data
			

			if($report_type==1)
			{
				$tests_done=0;
				$errors=0;
				$count=0;
				
				if($sql_data!="")
				{
					foreach($sql_data as $data)
					{
						if($data['valid']==1)
						{
							$tests_done+=$data['valid'];
							$count++;
						}
						else if($data['valid']==0)
						{
							$count++;
						}
					}
				}
				else
				{
					$tests_done=0;
					$count=0;
				}
			}
			else if($report_type==2)
			{
				$tests_done=0;
				$errors=0;
				$count=0;
				
				if($sql_data!="")
				{
					foreach($sql_data as $data)
					{
						if($data['valid']==1)
						{
							$count++;
						}
						else if($data['valid']==0)
						{
							$errors++;
							$count++;
						}
					}
				}
				else
				{
					$errors=0;
					$count=0;
				}
			}
			else
			{
				$tests_done=0;
				$errors=0;
				$count=0;
				
				if($sql_data!="")
				{
					foreach($sql_data as $data)
					{
						if($data['valid']==1)
						{
							$tests_done+=$data['valid'];
							$count++;
						}
						else if($data['valid']==0)
						{
							$errors++;
							$count++;
						}
					}
				}
				else
				{
					$tests_done=0;
					$errors=0;
					$count=0;
				}
			}
		}

		if($all==3)
		{
			$facility="";
			$device="";

			$pdf_results=$this->cd4_test_report($fromdate,$todate);
			if($report_type==1)
			{
					$tests_done=0;
					$errors=0;
					$count=0;

					if($pdf_results!="")
					{
						foreach ($pdf_results as $value) 
						{
							if($value['valid']==1)
							{
								$tests_done+=$value['valid'];
								$count++;
							}
							else
							{
								$count++;
							}
						}
					}else
					{
						$tests_done=0;
						$count=0;
					}	

			}
			else if($report_type==2)
			{
				$tests_done=0;
				$errors=0;
				$count=0;
				
				if($pdf_results!="")
				{
					foreach ($pdf_results as $value) 
					{
						if($value['valid']==0)
						{
							$errors++;
							$count++;
						}
						else
						{
							$count++;
						}
					
					}
				}else
				{
					$errors=0;
					$count=0;
				}
			}

			else
			{
					$tests_done=0;
					$errors=0;
					$count=0;

					if($pdf_results!="")
					{
						foreach ($pdf_results as $value) 
						{
							if($value['valid']==1)
							{
								$tests_done+=$value['valid'];
								$count++;
							}
							else
							{
								$errors++;
								$count++;
							}
						}
					}
					else
					{
						$tests_done=0;
						$errors=0;
						$count=0;
					}
			}
		}

					$Data['img']=$img;
					$Data['report_type']=$report_type;
					$Data['tests_done']=$tests_done;
					$Data['errors']=$errors;
					$Data['count']=$count;
					$Data['facility']=$facility;
					$Data['device']=$device;
					$Data['all']=$all;				
					$Data['the_month']="";
					$Data['quarter']="";
					$Data['q_no']="";
					$Data['bian']="";
					$Data['b_no']="";
					$Data['Year']="";
					$Data['Year_cri']="";
					$Data['from']=$fromdate;
					$Data['to']=$todate;


					$this->load->view('report_pdf_view',$Data);
	}

	/*..................End of PDF Functions.....................*/

	/*..................Start Of Excel Functions.................*/

	function excel_year_month($YearM,$monthly,$facility,$device,$from_month,$end_month,$report_type)
	{
		$this->load->library('excel');
		$Month=$this->GetMonthName($monthly);

		if($facility!="")
		{
			$sql_data=$this->cd4_test_details_facility($from_month,$end_month,$facility);
			
			$PHPExcel[]=$this->excel->getActiveSheet()->setTitle('REPORT FOR CD4 SAMPLES TESTED');
			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A1','Report for '.$facility.' - '.$Month.', '.$YearM.' ' );
			
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A1:P1');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			/*$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A2','Patient ID');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A2:B2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D2','Device');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D2:E2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G2','Date Of Test');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G2:I2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			if($report_type==1)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else if($report_type==2)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P2:Q2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}


			$num=3;

			foreach ($sql_data as $value) 
		 	{

		 		$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D'.$num.'',$value['serial_num']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D'.$num.':E'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G'.$num.'',$value['result_date']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G'.$num.':I'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						
				if($report_type==1)
				{
					if($value['valid']==1)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

					}
				}
				else if($report_type==2)
				{
					if($value['valid']==0)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					}
				}

				else
				{

					if($value['valid']==1)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					}
					else if($value['valid']==0)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
					}
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P'.$num.':Q'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
				}

		 		$num++;
			}

		
	 	}
	 	if($device!="")
	 	{
	 		$sql_data=$this->cd4_test_details_device($from_month,$end_month,$device);// get the data

			$PHPExcel[]=$this->excel->getActiveSheet()->setTitle('REPORT FOR CD4 SAMPLES TESTED');
			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A1','Report for '.$device.' - '.$Month.','.$YearM.'');
			
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A1:P1');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			/*$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A2','Patient ID');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A2:B2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D2','Facility');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D2:F2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G2','Date Of Test');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G2:I2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			
			if($report_type==1)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else if($report_type==2)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P2:Q2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
	 		
	 		$num=3;
			foreach ($sql_data as $value) 
	 		{
		 		
		 		$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D'.$num.'',$value['name']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D'.$num.':F'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G'.$num.'',$value['result_date']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G'.$num.':I'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		 		if($report_type==1)
		 		{
		 			if($value['valid']==1)
			 		{
			 			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			 		}
		 		}
			 		
		 		else if($report_type==2)
		 		{
		 			if($value['valid']==0)
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 		}
		 		else
		 		{
		 			if($value['valid']==1)
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 			else
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P'.$num.':Q'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		 		}


		 		$num++;
	 		}
	 	}


		return $PHPExcel;
	}


	function excel_year_quarter_report($yearQ,$quarter,$facility,$device,$from_month,$end_month,$report_type)
	{
		$this->load->library('excel');

		if($facility!="")
		{
			$sql_data=$this->cd4_test_details_facility($from_month,$end_month,$facility);

			$PHPExcel[]=$this->excel->getActiveSheet()->setTitle('REPORT FOR CD4 SAMPLES TESTED');
			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A1','Report for '.$facility.' - '.$quarter.','.$yearQ.' ');
			
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A1:P1');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			/*$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A2','Patient ID');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A2:B2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D2','Device');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D2:E2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G2','Date Of Test');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G2:I2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			if($report_type==1)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else if($report_type==2)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P2:Q2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}


			$num=3;

			foreach ($sql_data as $value) 
		 	{
		 		
		 		$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D'.$num.'',$value['serial_num']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D'.$num.':E'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G'.$num.'',$value['result_date']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G'.$num.':I'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		 		if($report_type==1)
				{
					if($value['valid']==1)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);

					}
					else
					{
						//$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',' - ');
					}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

					
				}
				else if($report_type==2)
				{
					if($value['valid']==0)
					{
						//$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);

					}
					else
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',' - ');
					}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
				}

				else
				{

					if($value['valid']==1)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					}
					else if($value['valid']==0)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
					}
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P'.$num.':Q'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
				}

		 		$num++;
			}
		}

		if($device!="")
		{
			$sql_data=$this->cd4_test_details_device($from_month,$end_month,$device);// get the data

			$PHPExcel[]=$this->excel->getActiveSheet()->setTitle('REPORT FOR CD4 SAMPLES TESTED');
			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A1','Report for '.$device.' - '.$quarter.','.$yearQ.'');
			
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A1:P1');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			/*$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A2','Patient ID');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A2:B2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D2','Facility');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D2:E2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G2','Date Of Test');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G2:I2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			if($report_type==1)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else if($report_type==2)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P2:Q2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
	 		
	 		$num=3;

			foreach ($sql_data as $value) 
	 		{
		 		//echo $value['cd4_count'];
		 		$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D'.$num.'',$value['name']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D'.$num.':F'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G'.$num.'',$value['result_date']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G'.$num.':I'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	 			if($report_type==1)
		 		{
		 			if($value['valid']==1)
			 		{
			 			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
			 		}

			 		else
			 		{

			 		}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			 		
		 		}
			 		
		 		else if($report_type==2)
		 		{
		 			if($value['valid']==0)
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
		 			}
		 			else
		 			{

		 			}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 		
		 		else
		 		{
		 			if($value['valid']==1)
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 			else
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P'.$num.':Q'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		 		}

		 		$num++;
	 		}
		}

		
		return $PHPExcel;
	}

	function excel_year_biannual_report($yearB,$biannual_name,$facility,$device,$from_month,$end_month,$report_type)
	{
		$this->load->library('excel');

		if($facility!="")
		{
			$sql_data=$this->cd4_test_details_facility($from_month,$end_month,$facility);

			$PHPExcel[]=$this->excel->getActiveSheet()->setTitle('REPORT FOR CD4 SAMPLES TESTED');
			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A1','Report for '.$facility.' - '.$biannual_name.','.$yearB.'');

			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A1:P1');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			/*$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A2','Patient ID');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A2:B2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D2','Device');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D2:E2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G2','Date Of Test');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G2:I2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			if($report_type==1)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else if($report_type==2)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P2:Q2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}

			$num=3;

			foreach ($sql_data as $value) 
		 	{
		 		
		 		$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D'.$num.'',$value['serial_num']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D'.$num.':E'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G'.$num.'',$value['result_date']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G'.$num.':I'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		 		if($report_type==1)
				{
					if($value['valid']==1)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
					}
					else
					{

					}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

					}
				
				else if($report_type==2)
				{
					if($value['valid']==0)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
					}
					else
					{

					}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}

				else
				{

					if($value['valid']==1)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					}
					else if($value['valid']==0)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
					}
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P'.$num.':Q'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
				}

		 		$num++;
			}
		}

		if($device!="")
		{
			$sql_data=$this->cd4_test_details_device($from_month,$end_month,$device);// get the data

			$PHPExcel[]=$this->excel->getActiveSheet()->setTitle('REPORT FOR CD4 SAMPLES TESTED');
			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A1','Report for '.$device.' - '.$biannual_name.','.$yearB.'');

			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A1:P1');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			/*$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A2','Patient ID');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A2:B2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D2','Facility');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D2:E2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G2','Date Of Test');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G2:I2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			if($report_type==1)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else if($report_type==2)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P2:Q2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
	 		
	 		$num=3;

			foreach ($sql_data as $value) 
	 		{
		 		//echo $value['cd4_count'];
		 		$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D'.$num.'',$value['name']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D'.$num.':F'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G'.$num.'',$value['result_date']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G'.$num.':I'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		 		if($report_type==1)
		 		{
		 			if($value['valid']==1)
			 		{
			 			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
			 		}
			 		else
			 		{

			 		}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 		}
		 		
			 		
		 		else if($report_type==2)
		 		{
		 			if($value['valid']==0)
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
		 			}
		 			else
		 			{

		 			}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	 			}
		 		
		 		else
		 		{
		 			if($value['valid']==1)
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 			else
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P'.$num.':Q'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		 		}

		 		$num++;
	 		}
		}

		return $PHPExcel;
	}

	 function excel_year_report($YearO,$facility,$device,$from_month,$end_month,$report_type)
	 {
	 	$this->load->library('excel');

	 	if($facility!="")
	 	{	
	 		$sql_data=$this->cd4_test_details_facility($from_month,$end_month,$facility);

	 		$PHPExcel[]=$this->excel->getActiveSheet()->setTitle('REPORT FOR CD4 SAMPLES TESTED');
			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A1','Report for '.$facility.' - '.$YearO.' ');

			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A1:P1');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			/*$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A2','Patient ID');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A2:B2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D2','Device');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D2:E2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G2','Date Of Test');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G2:I2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			if($report_type==1)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else if($report_type==2)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P2:Q2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}

			$num=3;

			foreach ($sql_data as $value) 
		 	{
		 		
		 		$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D'.$num.'',$value['serial_num']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D'.$num.':E'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G'.$num.'',$value['result_date']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G'.$num.':I'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		 		if($report_type==1)
				{
					if($value['valid']==1)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
					}
					else
					{

					}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				}
				
				else if($report_type==2)
				{
					if($value['valid']==0)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
					}
					else
					{

					}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}

				else
				{

					if($value['valid']==1)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					}
					else if($value['valid']==0)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
					}
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P'.$num.':Q'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
				}

		 		$num++;
			}
	 	}

	 	if($device!="")
	 	{
	 		$sql_data=$this->cd4_test_details_device($from_month,$end_month,$device);// get the data

	 		$PHPExcel[]=$this->excel->getActiveSheet()->setTitle('REPORT FOR CD4 SAMPLES TESTED');
			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A1','Report for '.$device.' - '.$YearO.'');

			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A1:P1');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			/*$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A2','Patient ID');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A2:B2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D2','Facility');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D2:E2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G2','Date Of Test');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G2:I2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			if($report_type==1)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else if($report_type==2)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P2:Q2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
	 		
	 		$num=3;

			foreach ($sql_data as $value) 
	 		{
		 		//echo $value['cd4_count'];
		 		$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D'.$num.'',$value['name']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D'.$num.':F'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G'.$num.'',$value['result_date']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G'.$num.':I'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		 		if($report_type==1)
		 		{
		 			if($$value['valid']==1)
			 		{
			 			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
			 		}
			 		else
			 		{

			 		}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 		}
		 		
			 		
		 		else if($report_type==2)
		 		{
		 			if($value['valid']==0)
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
		 			}
		 			else
		 			{

		 			}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	 			}
		 		
		 		else
		 		{
		 			if($value['valid']==1)
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 			else
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P'.$num.':Q'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		 		}

		 		$num++;
	 		}
	 	}

	return $PHPExcel;
	 
	 }

	 
	 function excel_customized_dates_report($Fromdate,$Todate,$facility,$device,$report_type)
	 {
	 	$this->load->library('excel');

	 	if($facility!="")
	 	{
	 		$sql_data=$this->cd4_test_details_facility($Fromdate,$Todate,$facility);// get the data

			$PHPExcel[]=$this->excel->getActiveSheet()->setTitle('REPORT FOR CD4 SAMPLES TESTED');
			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A1','Report for '.$facility.' - Between '.$Fromdate.' and '.$Todate.'');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A1:P1');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			/*$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A2','Patient ID');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A2:B2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D2','Device');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D2:E2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G2','Date Of Test');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G2:I2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			if($report_type==1)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else if($report_type==2)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			
			$num=3;

			foreach ($sql_data as $value) 
		 	{
		 		
		 		$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D'.$num.'',$value['serial_num']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D'.$num.':E'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G'.$num.'',$value['result_date']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G'.$num.':I'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		 		if($report_type==1)
				{
					if($value['valid']==1)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
					}
					else
					{

					}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				}
				
				else if($report_type==2)
				{
					if($value['valid']==0)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
					}
					else
					{

					}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}
			
				else
				{

					if($value['valid']==1)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					}
					else if($value['valid']==0)
					{
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
					}
						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P'.$num.':Q'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
				}

		 		$num++;
		 	}
	 	}

	 	if($device!="")
	 	{
	 		$sql_data=$this->cd4_test_details_device($Fromdate,$Todate,$device);// get the data


			$PHPExcel[]=$this->excel->getActiveSheet()->setTitle('REPORT FOR CD4 SAMPLES TESTED');
			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A1','Report for '.$device.' - Between '.$Fromdate.' and '.$Todate.' ');
			
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A1:P1');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			/*$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('A2','Patient ID');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('A2:B2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D2','Facility');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D2:E2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G2','Date Of Test');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setSize(12);
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getFont()->setBold(true);
			$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G2:I2');
			$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			if($report_type==1)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else if($report_type==2)
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','CD4 Count');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			else
			{
				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J2','Successful Tests');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J2:K2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L2','Errors');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L2:M2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N2','Operator');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getFont()->setBold(true);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N2:O2');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}

			$num=3;

			foreach ($sql_data as $value) 
		 	{
		 		//echo $value['cd4_count'];
		 		$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('D'.$num.'',$value['name']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('D'.$num.':F'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('D'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('G'.$num.'',$value['result_date']);
		 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getFont()->setSize(12);
				$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('G'.$num.':I'.$num.'');
				$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('G'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		 		if($report_type==1)
		 		{
		 			if($value['valid']==1)
			 		{
			 			$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
			 		}
			 		else
			 		{

			 		}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 		}
	
		 		else if($report_type==2)
		 		{
		 			if($value['valid']==0)
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
		 			}
		 			else
		 			{

		 			}
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 		}
		 		else
		 		{
		 			if($value['valid']==1)
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('J'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('J'.$num.':K'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('J'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 			else
		 			{
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('L'.$num.'',$value['valid']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('L'.$num.':M'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('L'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 			}
		 				$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('N'.$num.'',$value['cd4_count']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('N'.$num.':O'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('N'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

						$PHPExcel[]=$this->excel->getActiveSheet()->setCellValue('P'.$num.'',$value['operator']);
				 		$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getFont()->setSize(12);
						$PHPExcel[]=$this->excel->getActiveSheet()->mergeCells('P'.$num.':Q'.$num.'');
						$PHPExcel[]=$this->excel->getActiveSheet()->getStyle('P'.$num.'')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
		 		}

		 		$num++;
		 	}
	 	}

	 	

		return $PHPExcel;
	 }

	 function month_check($partnerid)
	 {
	 	$sql="SELECT DISTINCT MONTH( c.result_Date ) AS mth
									FROM cd4_test c, facility_pima fp, pima_upload pu
									WHERE c.facility_equipment_id = fp.facility_equipment_id
									AND fp.id = pu.facility_pima_id
									AND pu.uploaded_by = '".$partnerid."' ";
		//echo $sql;die;
	 	$res=$this->db->query($sql);

	 	if($res->num_rows()>0)
	 	{
	 		foreach ($res->result_array() as $value) 
	 		{
	 			$monthNumber[]=$value['mth'];
	 		}
	 		
	 	}
	 	return $monthNumber;
	 	
	 }
	 function year_check($partnerid)
	 {
	 	$sql="SELECT DISTINCT YEAR( c.result_Date ) AS yr
									FROM cd4_test c, facility_pima fp, pima_upload pu
									WHERE c.facility_equipment_id = fp.facility_equipment_id
									AND fp.id = pu.facility_pima_id
									AND pu.uploaded_by = '".$partnerid."' ";
		//echo $sql;die;
	 	$res=$this->db->query($sql);

	 	if($res->num_rows()>0)
	 	{
	 		foreach ($res->result_array() as $value) 
	 		{
	 			
	 			$YearNumber[]=$value['yr'];
	 		}
	 		
	 	}
	 	return $YearNumber;
	 	
	 }

	 function GetMonthName($month)
		{
			$monthname="";

			 if ($month==1)
			 {
			     $monthname="January";
			 }
			  else if ($month==2)
			 {
			     $monthname="February";
			 }else if ($month==3)
			 {
			     $monthname="March";
			 }else if ($month==4)
			 {
			     $monthname="April";
			 }else if ($month==5)
			 {
			     $monthname="May";
			 }else if ($month==6)
			 {
			     $monthname="June";
			 }else if ($month==7)
			 {
			     $monthname="July";
			 }else if ($month==8)
			 {
			     $monthname="August";
			 }else if ($month==9)
			 {
			     $monthname="September";
			 }else if ($month==10)
			 {
			     $monthname="October";
			 }else if ($month==11)
			 {
			     $monthname="November";
			 }
			  else if ($month==12)
			 {
			     $monthname="December";
			 }
			  else if ($month==13)
			 {
			     $monthname=" Jan - Sep  ";
			 }
			return $monthname;
		}

		public function tests_details($from,$to)//Get all the data
		{
			$this->load->config("sql");

			$sql = $this->config->item('preset_sql');

			$tests_sql= $sql["tests_details"];

			$date_delimiter	 	=	"";
		
			if(!$from==""||!$from==0||!$from==null)
			{
				$date_delimiter	=	" WHERE `tst`.`result_date` between '$from' and '$to' ";
			}

			$test_details=R::getAll($tests_sql.$date_delimiter);

			//echo $tests_sql.$date_delimiter;
	
			//die;

			return $test_details;

		}

		function cd4_test_details_facility($from,$to,$facility)
		{
			$sql=$this->db->query('SELECT c.cd4_count, c.result_date, fp.serial_num, f.name, p.operator,c.valid
									FROM cd4_test c, facility_pima fp, facility f, pima_test p
									WHERE c.facility_equipment_id = fp.facility_equipment_id
									AND f.id = c.facility_id
									AND c.id = p.cd4_test_id
									AND c.result_date
									BETWEEN "'.$from.'"
									AND "'.$to.'"
									AND f.name="'.$facility.'" ');

			if($sql->num_rows()>0)
			{
				foreach ($sql->result_array() as $value) 
				{
					$result[]=$value;
				}
			return $result;
			}
			
		}

		function cd4_test_details_device($from,$to,$device)
		{
			$sql='SELECT c.cd4_count, c.result_date, fp.serial_num, f.name, p.operator,c.valid
									FROM cd4_test c, facility_pima fp, facility f, pima_test p
									WHERE c.facility_equipment_id = fp.facility_equipment_id
									AND f.id = c.facility_id
									AND c.id = p.cd4_test_id
									AND c.result_date
									BETWEEN "'.$from.'"
									AND "'.$to.'"
									AND fp.serial_num = "'.$device.'" ';

			$Qresults=$this->db->query($sql);
			

			if($Qresults->num_rows()>0)
			{
				foreach ($Qresults->result_array() as $value) 
				{
					$result[]=$value;
				}
			
				return $result;
			
			}
			
			
		}

		function cd4_test_device_PDF($device,$from,$to)
		{
			$pdf_device_results="";
			
			$sql='SELECT c.cd4_count, c.facility_equipment_id, c.facility_id, fp.serial_num, c.valid
						FROM cd4_test c, facility_pima fp
						WHERE c.facility_equipment_id = fp.facility_equipment_id
						AND c.result_date
						BETWEEN "'.$from.'"
						AND "'.$to.'"
						AND fp.serial_num = "'.$device.'"';


			$result_device=$this->db->query($sql);

			foreach ($result_device->result_array() as $value) 
			{
				$pdf_device_results[]=$value;
			}


			return $pdf_device_results;
			
		}

		function cd4_test_facility_PDF($Facility,$from,$to)
		{
			$pdf_facility_results="";

			$sql='SELECT c.cd4_count, c.facility_equipment_id, c.facility_id, f.name, c.valid
							FROM cd4_test c, facility f
							WHERE c.facility_id = f.id
							AND c.result_date
							BETWEEN "'.$from.'"
							AND "'.$to.'"
							AND f.name = "'.$Facility.'" ';
			

			$result_device=$this->db->query($sql);

			foreach ($result_device->result_array() as $value) 
			{
				$pdf_facility_results[]=$value;
			}


			return $pdf_facility_results;
		}

		function cd4_test_report($from,$to)
		{
			$pdf_all_results="";

			$sql='SELECT c.cd4_count, c.facility_equipment_id, c.facility_id, f.name, c.valid
							FROM cd4_test c, facility f
							WHERE c.facility_id = f.id
							AND c.result_date
							BETWEEN "'.$from.'"
							AND "'.$to.'"';
			
			$result_device=$this->db->query($sql);

			foreach ($result_device->result_array() as $value) 
			{
				$pdf_all_results[]=$value;
			}


			return $pdf_all_results;
			
		}
		

	




}


?>
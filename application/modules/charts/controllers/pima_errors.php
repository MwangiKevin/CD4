<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class pima_errors extends MY_Controller {

  function __construct() {
    parent::__construct();
    
    $this->load->model('pima_errors_model');
  }


  public function monthly_error_trend($criteria1,$criteria2){

    $from 		=	$this->get_filter_start_date();
    $to			=	$this->get_filter_stop_date();


    $this->load->model('pima_errors_model');
    $res = $this->pima_errors_model->error_charts_data($from,$to,$criteria1,$criteria2); 

    $Xvalues="";

    if(Date("Y",strtotime($from))==Date("Y",strtotime($to))){
      $Xvalues="month";

    }else{
      $Xvalues="yearmonth";
    } 

    $categoriesnum		 =	array();
    $categories 		   =	array();
    $tests 			       =	array();
    $errors 			     =	array();
    $user_errors		   =	array();
    $device_errors		 =	array();

    if($Xvalues=="month"){
      $categoriesnum             =     $this->get_month_categories($from,$to);
    }elseif ($Xvalues=="yearmonth") {
      $categoriesnum             =     $this->get_yearmonth_categories($from,$to);
    }

    foreach($categoriesnum as $cat){
      if($Xvalues=="month"){
        $categories[] = $this->get_month_name($cat);
      }elseif ($Xvalues=="yearmonth") {
        $categories[] = $this->get_yearmonth_name($cat);
      }
    }



    //initialize tests, errors, user_errors and device_errors
    foreach ($categoriesnum as $cat) {
      $tests[$cat]                  =     0;
      $errors[$cat]                 =     0;
      $user_errors[$cat]            =     0;
      $device_errors[$cat]          =     0;
    }

    foreach ($res as $row) {

      		//tests, errors, user_errors and device_errors

      $tests_val              =     0;
      $errors_val             =     0;
      $user_errors_val        =     0;
      $device_errors_val      =     0;

      foreach ($categoriesnum as $cat) {
              //tests
        if($cat==$row[$Xvalues] && $row["valid"]==1){
          $tests[$cat]       +=    $row["valid_count"];                              
        }
              //errors
        if($cat==$row[$Xvalues] && $row["valid"]==0){
          $errors[$cat]  += (int) $row["valid_count"];
        }

              //device_errors
        if($cat==$row[$Xvalues] && $row["pima_error_type"]==1 ){
          $user_errors[$cat]       +=    $row["valid_count"];                               
        }

              //user_errors
        if($cat==$row[$Xvalues] && $row["pima_error_type"]==2){
          $device_errors[$cat]     +=    $row["valid_count"];                               
        }     		
      }
    }	


            //change arrays structures
    $tests_temp             =     array();    
    $errors_temp            =     array();     
    $user_errors_temp       =     array();
    $device_errors_temp     =     array();


    foreach ($tests as $key => $value) {
      $tests_temp[]=$value;
    } 
    foreach ($errors as $key => $value) {
      $errors_temp[]=$value;
    } 
    foreach ($user_errors as $key => $value) {
      $user_errors_temp[]=$value;
    } 
    foreach ($device_errors as $key => $value) {
      $device_errors_temp[]=$value;
    } 

    $tests            = $tests_temp    ; 
    $errors           = $errors_temp   ; 
    $user_errors      = $user_errors_temp;
    $device_errors    = $device_errors_temp;


    $chart_data = $this->config->item("hgc_column_stacked_grouped");
    $chart_data["xAxis"]["categories"]= $categories;
    $chart_data["yAxis"]['title']['text'] = "# Reported";
    $chart_data["chart"]["width"] = "1150";

    $series =   array(
      array(
        "name"      =>     "Total Tests",
        "data"      =>     $tests,
        "stack"     =>     "Test",
        "color"     =>     "#a4d53a"
        ),
      array(
        "name"      =>     "Total Errors",
        "data"      =>     $errors,
        "stack"     =>     "Tot",
        "color"     =>     "#aa1919"
        ),
      array(
        "name"      =>     "User Errors",
        "data"      =>     $user_errors,
        "stack"     =>     "typ",
        "color"     =>     "#33c6e7"
        ),
      array(
        "name"      =>     "Device Errors",
        "data"      =>     $device_errors,
        "stack"     =>     "typ",
        "color"     =>     "#624289"
        ),
      );

    $chart_data["series"]   =     $series;

    $json       =     json_encode($chart_data);     

    $json       =str_replace('"tooltip":"null"', "tooltip: {
      formatter: function() {
        var perc = ((this.y)/(this.point.stackTotal))*100
        return '<b>'+ this.x +'</b><br/>'+
        this.series.name +': '+ this.y +'<br/>'+
        'Percentage: '+ perc +'%<br/>'+
        'Total: '+ this.point.stackTotal;
      }
    }", $json) ;

    $script = "
    <div id='monthly_error_trend'></div>
    <script id = 'monthlyerrortrendscript'>
    var colors = Highcharts.getOptions().colors;
    $('#monthly_error_trend').highcharts(".$json.");
    </script>";
    echo $script;

  }
  public function error_type_pie($criteria1,$criteria2){

    $from             =     $this->get_filter_start_date();
    $to               =     $this->get_filter_stop_date();

    $res = $this->pima_errors_model->error_charts_data($from,$to,$criteria1,$criteria2); 

    $error_types    = R::getAll("SELECT `description` FROM `pima_error_type`");        
    $errors         = R::getAll("SELECT `error_code`,`description` AS `type` ,CONCAT(`error_detail`,'(',`error_code`,')') AS `cat` FROM `pima_error` LEFT JOIN `pima_error_type` ON `pima_error_type`.`id` = `pima_error`.`pima_error_type`");
    $data           = array();
    $colors         = array("#a4d53a","#aa1919","#33c6e7","#624289","#624289","#624289","#624289");

    // main categories
    $categories = array();
    foreach ($error_types as $row) {
      $categories[]   =  $row["description"];  
    }

    $i=0;
    $c=2;
    foreach ($error_types as $type) {
      $data[$i]["y"]      =  0; 
      $data[$i]["color"]  =  $colors[$c];
      $data[$i]["drilldown"]["name"]          =   $type["description"] ;
      $data[$i]["drilldown"]["color"]         =   $colors[$c] ;
      $data[$i]["drilldown"]["error_codes"]   = array();
      $data[$i]["drilldown"]["categories"]    = array();
      $data[$i]["drilldown"]["data"]          = array();

      foreach ($errors as $err) {
        if($err["type"]==$type["description"]){
          $data[$i]["drilldown"]["name"]          =   $err["type"] ;
          $data[$i]["drilldown"]["error_codes"][] =   $err["error_code"] ;
          $data[$i]["drilldown"]["categories"][]  =   $err["cat"] ;
          $data[$i]["drilldown"]["color"]         =   $colors[$c] ;
          $data[$i]["drilldown"]["data"][]        =   0;
        }
      }
      $i++;
      $c++;
    }


    foreach ($res as $row) {
      $i=0;
      foreach ($data as $dat){ 
        if($dat["drilldown"]["name"]==$row["error_type_description"]){
          $data[$i]["y"]      +=  $row["valid_count"];
          foreach ($dat["drilldown"]["error_codes"] as $key => $dat1 ){ 
            if($dat1 ==$row["error_code"]){
             $data[$i]["drilldown"]["data"][$key]      +=  $row["valid_count"];
           }
         }
       }                 
       $i++;               
     }
   }


    // echo "<pre>"; 
    // //print_r($data);
    // echo "</pre>";

   $json_data         = json_encode($data);
   $json_categories   = json_encode($categories);

   $script = "
   <div id='error_type_pie_gr'></div>
   <script id = 'errortypepiescript'>

   var colors = Highcharts.getOptions().colors,
   categories = ".$json_categories.",
   name = 'Errors Encountered',
   data = ".$json_data.";


                                // Build the data arrays
   var errorData = [];
   var errorTypeData = [];
   for (var i = 0; i < data.length; i++) {

                                    // add browser data
    errorData.push({
      name: categories[i],
      y: data[i].y,
      color: data[i].color
    });

                                    // add version data
        for (var j = 0; j < data[i].drilldown.data.length; j++) {
          var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
          errorTypeData.push({
            name: data[i].drilldown.categories[j],
            y: data[i].drilldown.data[j],
            color: Highcharts.Color(data[i].color).brighten(brightness).get()
          });
        }
        }

                                        // Create the chart
        $('#error_type_pie_gr').highcharts({
          chart: {
            type: 'pie',
            height: 265

          },
          title: {
            text: 'Errors Encountered'
          },
          yAxis: {
            title: {
              text: ''
            }
          },
          credits:{
            enabled:false
          }, 
          plotOptions: {
            pie: {
              shadow: false,
              center: ['50%', '50%']
            }
          },
          tooltip: {
            valueSuffix: '<br/>.',
          },
          series: [{
            name: 'Error Types',
            data: errorData,
            size: '35%',
            dataLabels: {
              formatter: function() {
                return this.y > 5 ? this.point.name : null;
              },
              color: 'white',
              distance: -30
            }
          }, {
            name: 'Types',
            data: errorTypeData,
            size: '60%',
            innerSize: '50%',
            dataLabels: {
              formatter: function() {
                                                        // display only if larger than 1
                return this.y > 0 ? '<b>'+ this.point.name +':</b> '+ this.y +' ('+Math.round(this.percentage,2)+' %)'  : null;
              }
            }
          }]
        });

        </script>";

    echo $script;

  }

  public function error_table($criteria1,$criteria2){
    $from             =     $this->get_filter_start_date();
    $to               =     $this->get_filter_stop_date();

    $this->load->model('pima_errors_model');
    $res = $this->pima_errors_model->error_details_table($from,$to,$criteria1,$criteria2); 

    $this->load->view('pima_error_table_view',$res[0]);
  }

  public function errors_column($criteria1,$criteria2){

    $from             =     $this->get_filter_start_date();
    $to               =     $this->get_filter_stop_date();


    //$res = $this->pima_errors_model->error_details_charts($from,$to,$criteria1,$criteria2); 
    
      
    $res = $this->pima_errors_model->error_charts_data($from,$to,$criteria1,$criteria2); 

    $errors         = R::getAll("SELECT `error_code`,`description` AS `error_type` ,CONCAT(`error_detail`,'(',`error_code`,')') AS `name` FROM `pima_error` LEFT JOIN `pima_error_type` ON `pima_error_type`.`id` = `pima_error`.`pima_error_type` ORDER BY `name`");

      //initialize data
    foreach ($errors as $key => $value) {
      $errors[$key]["data"][0]= 0;
    }

      // assign
    foreach ($res as $reported) {
      $i=0;
      foreach ($errors  as $err) {
        if($err["error_code"]==$reported["error_code"]){
          $errors[$i]["data"][0]+= $reported["valid_count"];
        }
        $i++;
      }
    }

    $data["data"] = json_encode($errors);

        //print "<pre>";
        //print_r($errors); 
        //echo $data["data"]; 
        //print "</pre>";
    $this->load->view('pima_error_column_view',$data);
  }
  public function error_yearly_trends($user_group_id,$user_filter_used){

    $this->load->model('pima_errors_model');

    $data           =   $this->pima_errors_model->error_yearly_trends($user_group_id,$user_filter_used,$this->get_date_filter_year());
    $data["date_filter_year"] = $this->get_date_filter_year();

    $this->load->view("pima_error_trend_view",$data);

  }

  public function error_types_col($user_group_id,$user_filter_used){

    $this->load->model('pima_errors_model');

    $data   =   $this->pima_errors_model->error_types_col($user_group_id,$user_filter_used,$this->get_filter_start_date(),$this->get_filter_stop_date());

    $this->load->view("pima_error_types_col_view",$data);

  }

}
/* End of file pima_errors.php */
/* Location: ./application/modules/charts/controller/pima_errors.php */
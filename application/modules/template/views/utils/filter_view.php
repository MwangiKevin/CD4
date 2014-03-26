<div style="float:center">
  <script>
    function date_filter(type,value){
      $.ajax({
          type:"POST",
          async:false,
          data:"type="+type+"&value="+value,
            url:"<?php echo base_url()."Home/date_filter_post"; ?>",  
            success:function(data) {
                  $("#exists").val(data);           
              }
      });
    }
    function date_filter_custom(){
      var from  = "";
      var to    = "";
      from      =  $("#filterfromdate").val();
      to        =  $("#filtertodate").val();
      
      if(to!="" && from!=""){
        var fromdate  = $.datepicker.parseDate("yy-mm-dd",  from);
        var todate    = $.datepicker.parseDate("yy-mm-dd",  to);
        if(todate>fromdate){
          var type  = "Custom";
          var value = {from:from,to:to};
          var value_json =  JSON.stringify(value, null, 2);

          date_filter(type,value_json);

          location.reload();
        }else{alert("To (Date) must be greater than From (Date)");}
      }else{
        alert("No dates Selected!");
      }
    }
  </script>
  <table align="center" border="1" style="font-size:10px" >
    <tr style="background: rgba(211, 220, 227, 0.42);">
      <td style="width: 43.5%;" class="filter">
        <ul class="tabbed" id="network-tabs"  >
          <li>
            <span>Period:  |</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="All"){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span> &nbsp&nbsp <a href="" onclick="date_filter('All','all')">All Time</a> &nbsp&nbsp |</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Periodic" && $date_filter_desc=="The Last 6 Calendar Months"){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span> &nbsp&nbsp <a href="" onclick="date_filter('Periodic',6)">Last 6 Months</a> &nbsp&nbsp |</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Periodic" && $date_filter_desc=="The Last 3 Calendar Months"){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span> &nbsp&nbsp <a href="" onclick="date_filter('Periodic',3)">Last 3 Months</a> &nbsp&nbsp |</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Periodic" && $date_filter_desc=="This Month"){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span> &nbsp&nbsp <a href="" onclick="date_filter('Periodic',1)">Last Upload Month</a> &nbsp&nbsp |</span>
          </li>
          <li style="width: 22%;" class = "<?php 
                        if($filter_used=="Custom"){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <div>
              <div>
                <span> &nbsp&nbsp <a onClick="toggleHideCustomize()" href = "javascript:void(null);">Customize dates</a> &nbsp&nbsp </span>
                <div >
                  <div id = "customize" class="mycontainer" style="width: 19%; padding-bottom: 9px;border-bottom: 4px solid #D0D0D0;position: fixed;z-index: 20; filter:alpha(opacity=90); opacity:.93;background-color: white;display: none;">                
                    <button type="button" class="close" style="margin:2px;margin-bottom:9px;" onClick="toggleHideCustomize()" >×</button>
                    <div class="input-group" style="width: 100%;margin:2px;margin-top:19px;">
                      <span class="input-group-addon" style="width: 40%;">From :</span>
                      <div class="input-group date" id="from_div" data-date="" data-date-format="dd-mm-yyyy">
                        <input id="filterfromdate" class="span2" size="22%" type="text" style="height: 28px;" value="">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                    </div>
                    <div class="input-group" style="width: 100%;margin:2px;margin-top:9px;">
                      <span class="input-group-addon" style="width: 40%;">To :</span>
                      <div class="input-group date" id="from_div" data-date="" data-date-format="dd-mm-yyyy">
                        <input id="filtertodate" class="span2" size="22%" type="text" style="height: 28px;" value="">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                    </div>
                    <button name="reset" onclick="date_filter_custom()" type="button" style="width: 100%;margin:2px;margin-top:9px;" class="btn btn-default btn-minii"><i class="glyphicon glyphicon-search"></i> Filter</button>               
                   </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </td>
      <td class="filter">
        <ul class="tabbed" id="network-tabs">
          <li>
            <span>Year:  |</span>
          </li>
          <li>
            <span>&nbsp&nbsp...&nbsp&nbsp|</span>
          </li>
          <?php 
            $strtyr   = $this->config->item("starting_year");
            $curryr   = (int)(date("Y"));
            for($i= $strtyr;$i<=$curryr;$i++){
          ?>
          <li class = "<?php 
                        if(($filter_used=="Yearly" && $date_filter_year==$i)||$filter_used=="Monthly" && $date_filter_year==$i){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp&nbsp<a href="" onclick="date_filter('Yearly',<?php echo $i;?>)"><?php echo $i;?></a>&nbsp&nbsp|</span>
          </li> 
          <?php
            }
          ?> 
          <li>
            <span>&nbsp&nbsp...&nbsp&nbsp|</span>
          </li>        
        </ul>
      </td> 
      <td class="filter">
        <ul class="tabbed" id="">
          <li >
            <span>Month:  |</span>
          </li>
          <li class="<?php 
                        if($filter_used=="Yearly"){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Yearly',<?php echo date("Y",strtotime($this-> session-> userdata('date_filter_start'))); ?>)">All</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==1){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',1)">Jan</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==2){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',2)">Feb</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==3){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',3)">Mar</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==4){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',4)">Apr</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==5){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',5)">May</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==6){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',6)">Jun</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==7){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',7)">Jul</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==8){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',8)">Aug</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==9){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',9)">Sep</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==10){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',10)">Oct</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==11){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',11)">Nov</a> &nbsp|</span>
          </li>
          <li class = "<?php 
                        if($filter_used=="Monthly" && $date_filter_month==12){
                          echo "current";
                        }else{echo "tab";}
                      ?>">
            <span>&nbsp <a href="" onclick="date_filter('Monthly',12)">Dec</a> &nbsp|</span>
          </li>
        </ul>
      </td> 
    </tr>
  </table>
</div>
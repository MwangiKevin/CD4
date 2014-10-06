<div style="overflow-y: auto; height: <?php echo $height?>px !important;">
  <table class="data-table" style=" margin-left:0px;margin-top: 0%;vertical-align: middle;margin-bottom: 0;">
    <tbody>
      <thead>                              
        <th colspan="4" rowspan="1" style="vertical-align: middle;"><center><b>Error Details</b></center></th>
      </thead>
      <tr>                              
        <td colspan="3" style="vertical-align: middle;"><center># Attempted Tests</center></td>
        <td colspan="1" style="vertical-align: middle;font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2;">
          <center>
            <?php echo $attempted;?>
          </center>
        </td>                                                         
      </tr>    
      <tr>                              
        <td colspan="1"   rowspan="3"  style="vertical-align: middle;"><center> # Successful tests  </center></td>
        <td  colspan="1"  rowspan="3" style="vertical-align: middle;font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2;">
          <center>
            <?php echo $successful;?>
          </center>
          <center>
            <b>
              <?php 
              if($attempted>0){
                echo "(".(round((($successful/$attempted)*100),1))." %)";
              }
              ?>
            </b>
          </center>
        </td>                                                        
      </tr>                       
      <tr>                              
        <td colspan="1"   rowspan="1"  style="vertical-align: middle;"><center># Tests &gt;=350 cells/mm3 </center></td>
        <td  colspan="1"  rowspan="1" style="vertical-align: middle;font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2;">
          <center>
            <?php echo $passed;?>
          </center>
          <center>
            <b>
              <?php 
              if($attempted>0){
                echo "(".(round((($passed/$attempted)*100),1))." %)";
              }
              ?>
            </b>
          </center>
        </td>                                                        
      </tr>                       
      <tr>                              
        <td colspan="1"   rowspan="1"  style="vertical-align: middle;"><center># Tests &lt;350 cells/mm3   </center></td>
        <td  colspan="1"  rowspan="1" style="vertical-align: middle;font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2;">
          <center>
            <?php echo $failed;?>
          </center>
          <center>
            <b>
              <?php 
              if($attempted>0){
                echo "(".(round((($failed/$attempted)*100),1))." %)";
              }
              ?>
            </b>
          </center>
        </td>                                                        
      </tr> 
      <tr>                              
        <td colspan="1"   rowspan="3"  style="vertical-align: middle;"><center> # Errors (unsuccessful tests) </center></td>
        <td  colspan="1"  rowspan="3" style="vertical-align: middle;font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2;">
          <center>
            <?php echo $errors;?>
          </center>
          <center>
            <b>
              <?php 
              if($attempted>0){
                echo "(".(round((($errors/$attempted)*100),1))." %)";
              }
              ?>
            </b>
          </center>
        </td>                                                        
      </tr>                       
      <tr>                              
        <td colspan="1"   rowspan="1"  style="vertical-align: middle;"><center># User Errors</center></td>
        <td  colspan="1"  rowspan="1" style="vertical-align: middle;font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2;">
          <center>
            <?php 
            echo $user_errors;
            ?>
          </center>
          <center>
            <b>
              <?php 
              if($attempted>0){
                echo "(".(round((($user_errors/$attempted)*100),1))." %)";
              }
              ?>
            </b>
          </center>
        </td>                                                        
      </tr>                       
      <tr>                              
        <td colspan="1"   rowspan="1"  style="vertical-align: middle;"><center># Device Errors</center></td>
        <td  colspan="1"  rowspan="1" style="vertical-align: middle;font-family:Georgia, 'Times New Roman', Times, serif ;background-color: #F2F2F2;">
          <center>
            <?php echo $device_errors;?>
          </center>
          <center>
            <b>
              <?php 
              if($attempted>0){
                echo "(".(round((($device_errors/$attempted)*100),1))." %)";
              }
              ?>
            </b>
          </center>
        </td>                                                        
      </tr>                      
    </tbody>
  </table>
</div>
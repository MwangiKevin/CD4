<?php //echo json_encode($tests); die();?>
<div class = "row tree-outer">
    <div class="col-md-12 well" id ="desc" style=" min-height: 10px;  padding: 8px;  margin-bottom: 0px; ">
        <div class="" style=" height:13px;  ">

            <b><center><div id="filter-identifier">National<div></div></div></center></b>
        </div>
    </div>
    <div class="col-md-3 well " style="overflow-y: auto; height: 560px !important;" id="tree">
                    <div class="loader" style"">Loading...</div>  
    </div>

        <div class="row">
            <div class="col-md-4" id="">
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div1">              
                        <div class="loader" style"">Loading...</div>      
                    </div>  
                </div> 
                
            </div>
            <div class="col-md-4" id="">        
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div2">
                        <div class="loader" style"">Loading...</div>    
                    </div>
                </div> 
            </div>
            <div class="col-md-4" id="">        
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div3">
                        <div class="loader" style"">Loading...</div>    
                    </div>
                </div> 
            </div>
            <div class="col-md-4" id="">
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div4">              
                        <div class="loader" style"">Loading...</div>      
                    </div>  
                </div> 
            </div>
            <!-- <div class="col-md-4" id="">        
               
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div5">
                        <div class="loader" style"">Loading...</div>    
                    </div>
                </div> 
            </div>
            <div class="col-md-4" id="">        
               
                <div class="panel panel-default" style="width:100%;padding:30px;box-shadow: 4px 4px 4px #888888;" >
                    <div id="div6">
                        <div class="loader" style"">Loading...</div>    
                    </div>
                </div> 
            </div> -->
        </div>
    

    <div class="col-md-12" style="overflow-y: auto; height: 560px !important;">
        <div class="row">
            <div class="row">
            <div class="col-md-12" id="">   
                <div class="section-title" ><center>Failed Controls</center></div>
                    <div>
                        <table id="failed_controls_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Facility</th>
                                    <th>Serial Number</th>
                                    <th>Total tests</th>
                                    <th>Total Unconfirmed Controls</th>
                                    <th>Total Confirmed controls</th>
                                    <th>Low Confirmed Controls</th>
                                    <th>Normal Confirmed Controls</th>
                                    <th>Failed Confirmed Controls</th>
                                    <th>Successful Confirmed Controls</th>
                                    <th>Errors</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                
            </div>
        </div>
            
            
        </div>
    </div>
    
   
</div>


<?php $this->load->view("pima_controls_footer_view");?>
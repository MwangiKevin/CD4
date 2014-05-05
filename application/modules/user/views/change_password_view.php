<center>
  <div class="section-title" ><center>Change Password</center></div> 
  <div class="mycontainer">
    <?php
        $username =$this->session->userdata("username");
        if(isset($success)){
          echo $success;
        }
      ?>
    <?php
      echo form_open(base_url().'user/change_password',"id='password_user'");
    ?>
    <div class="input-group" style="width: 100%;padding:4px;">
      <span class="input-group-addon" style="width: 40%;">Username :</span>
      <?php echo form_input(array('name' => 'username', 'id' => 'username', 'value'=>"$username", 'class'=>'textfield form-control', 'placeholder' => 'Username', 'readonly'=>"readonly"));?>
    </div>
    <div class="input-group" style="width: 100%;padding:4px;">
      <span class="input-group-addon" style="width: 40%;">Old Password :</span>
      <?php echo form_password(array('name' => 'oldPassword', 'id' => 'oldPassword', 'class'=>'textfield form-control', 'placeholder' => '***********'));?>
    </div>
    <?php 
      echo form_error('oldPassword', '<div class="error" style="margin:3px;border-radius:2px;">', '</div>');
    ?>
     <div class="input-group" style="width: 100%;padding:4px;">
      <span class="input-group-addon" style="width: 40%;">Password :</span>
      <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class'=>'textfield form-control', 'placeholder' => '***********'));?>
    </div>
     <?php 
      echo form_error('password', '<div class="error" style="margin:3px;border-radius:2px;">', '</div>');
    ?>
    <div class="input-group" style="width: 100%;padding:4px;">
      <span class="input-group-addon" style="width: 40%;">Confirm Password :</span>
      <?php echo form_password(array('name' => 'confPassword', 'id' => 'confPassword', 'class'=>'textfield form-control', 'placeholder' => '***********'));?>
    </div> 
     <?php 
      echo form_error('confPassword', '<div class="error" style="margin:3px;border-radius:2px;">', '</div>');
    ?>
     <div class="right" style="padding:7px;">    
        <button name="viewData" type="button" onclick="submit_password()" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-save"></i>Save Changes</button>               
    </div>
    <?php
      echo form_close();
    ?>
  </div>  
</center>
<?php $this->load->view('template/picture');
      $uemail = $this->session->userdata('logged_in')['username']; 
      $uid = $this->session->userdata('logged_in')['id']; 
      $staff_code = $this->db->get_where('tbl_institution_staff',array('email'=>$uemail,'status'=>'1'))->row_array(); 
      $provider_name = $this->db->get_where('tbl_user',array('id'=>$staff_code['insititution_id']))->row_array();
      $explode12 = explode('-',$prof_details['insititution_id']); 
      $user_ins_id = end($explode12);
      $institution = $this->db->get_where('tbl_user',array('id'=>$user_ins_id))->row_array(); ?>

<div class="innerContent">
    <div class="container">
        <div class="row">
        <?php $this->load->view('professional/sidebar'); ?>

    <div class="col-sm-9">
        <div class="clearfix">
            <h3 class="border-title pull-left">Settings</h3>
        <?php if($staff_code['activated'] == 1){ 
            if($institution['under_insititution'] == '0'){ ?>
        <a href="<?php echo BASE_URL.'web/'.$institution['insititution_id']; ?>" class="btn btn-primary pull-right" style="margin-top: -34px; margin-bottom: 10px;position: relative;z-index: 99;">INSTITUTION CE WEBPAGE</a>
        <?php }else{ ?>
            <a href="<?php echo BASE_URL.'share/viewprofile/'.$institution['id']; ?>" class="btn btn-primary pull-right" style="margin-top: -34px; margin-bottom: 10px;position: relative;z-index: 99;">INSTITUTION CE WEBPAGE</a>
            <?php } } ?>
        </div>

        <form action="<?php echo BASE_URL.'professional/settings';?>" method="post" enctype="multipart/form-data">

        <?php echo $this->session->flashdata('response');?>
            <!-- <div class="row mb-3">
                 <div class="col-sm-12">
                 	<span style="color: #808080;">After filling each section, Please click submit button which is below.</span>
                    <div class="form-group">
                        <label>Are you Under Institution ?</label> 
                        <select name="under_institution" id="under_institution" class="form-control" onchange="option()">
                            <option value="1" <?php if($prof_details['under_insititution'] == '1'){ echo 'selected'; }?> >Yes</option>
                            <option value="0" <?php if($prof_details['under_insititution'] == '0'){ echo 'selected'; }?> >No</option>
                        </select>
                    </div>
                </div>
                <span id="ins" style="display: none;">
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label>Select Institution </label>  
                            <select  name="institution" id="institution" class="form-control">
                                <option value="" selected>Please Select</option>
                                <?php $explode = explode('-',$prof_details['insititution_id']); 
                                      $user_ins_id = end($explode); ?>
                                <?php foreach($institution_list as $key => $value){ 
                                if($user_ins_id == $value['id']){ 
                                        $condition ='selected'; 
                                    }else{ 
                                        $condition =''; 
                                    } ?>
                                <option value="<?=$value['id']; ?>" <?=$condition;?> ><?=$value['name']; ?></option>
                                <?php }?>
                            </select> 
                        </div>
                    </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                            <label>Enter Institution code </label>
                            <input type="text" name="ins_code" class="form-control" value="<?php if($user_ins_id != $uid){ echo $prof_details['insititution_id']; } ?>"> 
                        </div>
                    </div>
                </span>
                    <p class="col-sm-12 submit alignleft">
                        <input class="btn btn-primary" value="Update" type="submit" name="ins_save">
                    </p>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Are you under CE Provider ?</label>
                        <select name="under_provider" id="under_provider" class="form-control" onchange="option2()">
                            <option value="1" <?php if($prof_details['under_provider'] != ''){ echo 'selected'; }?> >Yes</option>
                            <option value="0" <?php if($prof_details['under_provider'] == ''){ echo 'selected'; }?> >No</option>
                        </select> 
                    </div>
                </div>
                
                <span id="provider" style="display: none;">
                <div class="col-sm-6">
                    <div class="form-group">
                    <label>Select CE Provider </label> 
                        <select  name="provider_name" id="provider_name" class="form-control" onchange="return blank();" >
                            <option value="" selected>Please Select</option>
                        <?php     $explode = end(explode('-',$prof_details['under_provider']));  
                                  foreach ($provider_list as $key => $value){
                                  if($value['id'] == $explode){ $condition ='selected'; }else{ $condition =''; } ?>
                            <option value="<?php echo $value['id']; ?>" <?=$condition;?> ><?php echo $value['name']; ?>
                            </option><?php  } ?>
                        </select> 
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Enter CE Provider code </label> 
                        <input type="text" name="provider_code" id="provider_code" class="form-control" value="<?php echo $prof_details['under_provider']; ?>"> 
                    </div>
                </div>
                </span>
                <p class="col-sm-12 submit alignleft">
                    <input class="btn btn-primary" value="Update" type="submit" name="ce_save">
                </p>
            </div>
            <hr> -->
        <?php if($staff_code['status'] == 1 && $staff_code['prof_id'] == $uid){ 
            echo '<div class="jumbotron text-center">';
                echo'<p style="color:green;"><b>You are Enabled by CE Provider ('.$provider_name['name'].') </b></p>'; 
            
                if($staff_code['activated'] == 1){ 
                    echo'<h1 class="display-4"><i class="text-success">Congratulations!</i></h1><p style="color:green;"><b>You are Activated and ready to explore the institution\'s courses and training.</b></p>'; 
                }else {
                    echo'<p style="color:orange;"><b>Waiting for Institution activation</b></p>'; 
                }
            echo '</div>';
            }else{ ?>
            <div class="row">
                 <div class="col-sm-12">
                    <div class="form-group">
                        <label>CE Staff Code</label> 
                      
                        <input type="text" name="staff_code" class="form-control" value="" placeholder="Enter staff code which is given by CE Provider" required>
                        <span class="error"><?php echo  form_error('staff_code'); ?></span>
                    </div>
                </div>
                <p class="col-sm-12 submit alignleft">
                    <input class="btn btn-primary" value="Update" type="submit" name="save">
                </p>
            </div>
            <?php } ?> 
    	</form>
        
    </div>
                        
          
        </div>
    </div>
</div>

    <div id="staff_connected" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center><div class="site-logo__link" style="max-width: 34%;">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo"></a>
        </div></center>
      </div>
      <div class="modal-body text-center">
        <div class="jumbotron text-center">
            <span id="congrats"></span>
            <p id="stffcontent"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php if($staff_code['activated'] == 1){ 
        if($institution['under_insititution'] == '0'){ ?>
        <a href="<?php echo BASE_URL.'web/'.$institution['insititution_id']; ?>" class="btn btn-primary">INSTITUTION CE WEBPAGE</a>
        <?php }else{ ?>
        <a href="<?php echo BASE_URL.'share/viewprofile/'.$institution['id']; ?>" class="btn btn-primary">INSTITUTION CE WEBPAGE</a>
        <?php } } ?>
      </div>
    </div>

  </div>
</div>
    
<script type="text/javascript">
    $(document).ready(function(){
        var u_ins = $('#under_institution').val();
        var pro   = $('#under_provider').val(); 
        if(u_ins==1){
            $('#ins').show();
        }else{
            $('#ins').hide();
        }
        if(pro==1){
            $('#provider').show();
        }else{
            $('#provider').hide();
        }

    var done = '<?php if($staff_code['status'] == 1 && $staff_code['prof_id'] == $uid && $staff_code['activated'] == 0){ ?>' + $("#staff_connected").modal('show'); $("#stffcontent").html('<p style="color:green;"><b>You are now connected. Please wait for the activation of your account so that you can access the online courses and training of your institution.</b></p>'); +'<?php } ?>';

    var done1 = '<?php if($staff_code['status'] == 1 && $staff_code['prof_id'] == $uid && $staff_code['activated'] == 1){ ?>' + $("#staff_connected").modal('show'); $("#stffcontent").html('<p style="color:green;"><b> You can now access your Institution Continuing Education (ICE) Webpage.</b></p>'); $("#congrats").html(' <h4 class="modal-title text-center" style="color: red; font-weight: bold;font-family: cursive; font-size: 31px;"> <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/congratulations.png'; ?>" alt="congratulations"><span><i>!</i></span></a></h4>')+'<?php } ?>';
    

    });

    function blank(){
        $('#provider_code').val("");
    }

    function option(){
        var u_ins = $('#under_institution').val();
        if(u_ins==1){
            $('#ins').show();
        }else{
            $('#ins').hide();
        }
    }
    function option2(){
        var u_ins = $('#under_provider').val();
        if(u_ins==1){
            $('#provider').show();
        }else{
            $('#provider').hide();
        }
    }
    
</script>
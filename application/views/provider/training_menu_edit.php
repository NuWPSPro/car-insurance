<?php 	$methodname = $this->uri->segment(2);
		$idd = $this->uri->segment(3);
		$tdetails = $this->user->get_record_by_field_name_all_record('tbl_training','id',$idd);

 		$uid = $this->session->userdata('logged_in')['id'];
		$userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
		$under_insititution = $userdata['under_insititution']; 

	if($tdetails[0]['training_type'] == 0){
			// $_SESSION['service_type'] = "free";
			$type = 'free';
            $version = "Basic Version";
		} else {
            // $_SESSION['service_type'] = "paid";
			$type = 'pro';
		    $version = "Pro Version";
		} ?>
    <div class="clearfix">
        <h3 class="border-title pull-left">Upload Training/Seminar </h3>
        <a href="<?php echo base_url('provider/training_center_list'); ?>" class="btn btn-primary pull-right">Back</a>
        <?php if($type == "free"){ ?>
            <a href="javascript:void(0)" class="btn btn-primary pull-right mr-1" onclick="upgradetopro();">Upgrade to Pro-Version</a>
        <?php } ?>
    </div>
<div class="row">
    <div class="col-md-6">
	    <h4 style="color: red;"><?php echo $tdetails[0]['title']; ?> 
	        <span style="color: #478bca; font-weight: bold; margin-left: 12px;">(<?php echo $version; ?>)</span>
        </h4>
    </div>
    <div class="col-md-6">
        <?php if($type=="pro"){ ?>
            <a href="#"><input type="button" name="free" id="free" value="PROFESSIONAL VERSION" class="btn-danger pull-right"></a>
            <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-primary pull-right"></a>
        <?php }else{ ?>
            <a href="#"><input type="button" name="free" id="free" value="FREE VERSION" class="btn-primary pull-right"></a>
            <a href="#"><input type="button" name="free" id="free" value="TUTORIAL TO UPLOAD TRAININNG" class="btn-success pull-right"></a>
        <?php } ?>            
    </div>
</div>



<ul class="nav-tabs hidden-xs">
	<?php if($tdetails[0]['training_type']==0){?>
	<li class="<?php if($methodname=="training_center_free"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_center_free/').$idd;?>">Template</a></li>
	<?php }else{ ?>
	<li class="<?php if($methodname=="training_center_pro"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_center_pro/').$idd;?>">Template</a></li>
	<?php } ?>

	<li class="<?php if($methodname=="choose_certificate_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/choose_certificate_edit/').$idd;?>">Certificate</a></li>

	<li class="<?php if($methodname=="training_center_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_center_edit/').$idd; ?>">General Info</a></li>

	<li class="<?php if($methodname=="training_overview_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_overview_edit/').$idd;?>">Overview</a></li>

	<?php if($type=="pro"){ ?>
	<li class="<?php if($methodname=="customize_registration_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/customize_registration_edit/').$idd; ?>">Registration</a></li>
	<?php } ?>

	 <li class="<?php if($methodname=="training_speaker_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_speaker_edit/').$idd;?>">Speaker</a></li>


	<li class="<?php if($methodname=="training_schedule_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_schedule_edit/').$idd;?>">Schedule</a></li>

	<li class="<?php if($methodname=="training_evaluation_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_evaluation_edit/').$idd;?>">Evaluation</a></li>

	<?php if($under_insititution == '0' ){ ?>
	<li class="<?php if($methodname=="training_promotion_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_promotion_edit/').$idd;?>">Promotion</a></li>
	<?php } ?>

	<?php if($type=="pro"){ ?>
	<li class="<?php if($methodname=="training_sponsors_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_sponsors_edit/').$idd;?>">Sponsors</a></li>

	<li class="<?php if($methodname=="training_committee_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_committee_edit/').$idd;?>">Committee</a></li>
	<?php } ?>
	 
	<li class="<?php if($methodname=="training_publish_edit"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_publish_edit/').$idd;?>">Publish</a></li>
</ul>

<!-- Modal -->
<div class="modal fade" id="upgradetopro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php echo form_open('provider/upgradetopro/'.$idd); ?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upgrade to training PRO Template:

        <button type="submit" name="upgrade" class="btn btn-primary pull-right">Upgrade</button>
        </h5>
      </div>
    <?php	$tmscharge = $this->db->get_where('tbl_all_tax',array('id' =>6))->row_array()['total_amount']; ?>
      <div class="modal-body modal-lg">
                    
            <h2>What do you get from Training Pro-version ?</h2>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo14.jpeg" alt="">
                <span class="instant-content">instant Website  for your Training</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo13.jpeg" alt="">
                <span class="instant-content">Choose Website Template</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo7.jpeg" alt="">
                <span class="instant-content">Training Link As Digital Invitation</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo15.jpeg" alt="">
                <span class="instant-content">Online<br> Registration</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo12.jpeg" alt="">
                <span class="instant-content">Online<br> Payment</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo9.jpeg" alt="">
                <span class="instant-content">Training <br> Schedule</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo11.jpeg" alt="">
                <span class="instant-content">Training <br> Overview</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo10.jpeg" alt="">
                <span class="instant-content">Speaker's Profile & Lecture</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo8.jpeg" alt="">
                <span class="instant-content">Event Sponsor (Advertisement)</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo4.jpeg" alt="">
                <span class="instant-content">Digital Certificates <br> (Online Verifiable)</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo5.jpeg" alt="">
                <span class="instant-content">Online Evaluation <br> of Speakers & Training</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo6.jpeg" alt="">
                <span class="instant-content">Instant <br> Trng. Report</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo1.jpeg" alt="">
                <span class="instant-content">Venue <br> Section</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo3.jpeg" alt="">
                <span class="instant-content">The Host <br> Section</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/logo14.jpeg" alt="">
                <span class="instant-content">Featured <br> Listing</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/zoom.png" alt="">
                <span class="instant-content">Zoom</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/email.png" alt="">
                <span class="instant-content">Automail of Training Details <br> to Participants</span>
            </div>
            <div class="training-logo-box">
                <img src="<?php echo base_url();?>assets/images/play.png" alt="">
                <span class="instant-content">Upload <br>Promotional Video</span>
            </div>

      	<p> 
      		<label>Note:</label>
      		<ol>
      			<li>Pro template is a chargeable service for <?php echo '$'.$tmscharge; ?> only at the time of publishing this training. <br>You don't pay when you only save the training.</li>
      			<li>If you started uploading your training details at Free version template and upgraded to Pro vesrion template, <br>all your details will still be retained in each tab and will be saved.</li>
      			<li>Once you upgrade to Pro template you can not go back to back. You need to start again.</li>
      		</ol>
      	</p>
      </div>
      <div class="modal-footer">
        <button type="submit" name="upgrade" class="btn btn-primary pull-left">Upgrade</button>
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close()?>
    </div>
  </div>
</div>
	
<script>
   function upgradetopro(tid) {
   	$('#upgradetopro').modal('show');
        // var r = confirm('Do you want to upgrade to Pro Version!');
       //  if (r == true) {
       //      window.location.href = "<?php echo base_url('provider/upgradetopro/'); ?>"+tid;
      	// }
    }
</script>
            
		


<?php 
		$methodname = $this->uri->segment(2);
 		$uid = $this->session->userdata('logged_in')['id'];
		$userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
		$under_insititution = $userdata['under_insititution']; ?>

<ul class="nav-tabs hidden-xs">
	<?php if($methodname=="training_center_free"){ ?>
	<li class="<?php if($methodname=="training_center_free"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_center_free'); ?>">Template</a></li>
	<?php }else{?>
	<li class="<?php if($methodname=="training_center_pro"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_center_pro'); ?>">Template</a></li><?php }?>

	<li class="<?php if($methodname=="choose_certificate"){ echo "active";}?>"><a href="<?php echo site_url('provider/choose_certificate'); ?>">Certificate</a></li>

	<li class="<?php if($methodname=="upload_information"){ echo "active";}?>"><a href="<?php echo site_url('provider/upload_information'); ?>">General Info</a></li>

	<li class="<?php if($methodname=="training_overview"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_overview');?>">Overview</a></li>

	<?php if($this->session->userdata('training_types')=="pro"){ ?>
	<li class="<?php if($methodname=="customize_registration"){ echo "active";}?>"><a href="<?php echo site_url('provider/customize_registration'); ?>">Registration</a></li>
	<?php } ?>

	<li class="<?php if($methodname=="training_speaker"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_speaker'); ?>">Speaker</a></li>

	<li class="<?php if($methodname=="training_schedule"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_schedule'); ?>">Schedule</a></li>

	<li class="<?php if($methodname=="training_evaluation"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_evaluation');?>">Evaluation</a></li>
	<?php if($under_insititution == '0' ){ ?>
	<li class="<?php if($methodname=="training_promotion"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_promotion'); ?>">Promotion</a></li>
	<?php } ?>
	<?php if($this->session->userdata('training_types')=="pro"){ ?>
	<li class="<?php if($methodname=="training_sponsors"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_sponsors'); ?>">Sponsors</a></li>

	<li class="<?php if($methodname=="training_committee"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_committee');?>">Committee</a></li>
	<?php } ?>

	<li class="<?php if($methodname=="training_publish"){ echo "active";}?>"><a href="<?php echo site_url('provider/training_publish'); ?>">Publish</a></li>
</ul>

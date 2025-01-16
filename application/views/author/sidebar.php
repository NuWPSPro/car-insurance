<?php 
		$idd1 = $this->session->userdata('logged_in')['id'];
		$noticationCount = $this->db->get_where('tbl_notification',array('to'=>$idd1,'status'=>1))->result_array();
		$ncount = count($noticationCount);
		$datass = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_user','id',$idd1); 
		$uid = $this->session->userdata('logged_in')['id']; 
	  	$uprovider = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array()['under_provider']; 
	  	$up_id = end(explode('-', $uprovider)); 
	  	$uins = $this->db->get_where('tbl_user',array('id'=>$up_id))->row_array()['under_insititution']; 
	  	?>
<!-- <div class="col-sm-3 user-nav">
<a class="dashboard-btn" href="<?php echo base_url('author/overview'); ?>">Dashboard</a>
<ul class="navlist">
<?php if($uins=='0'){ ?>
<li <?php if($this->uri->segment(2)=="dashboard" || $this->uri->segment(2)=="overview"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/overview');?>"><i class="fa fa-book"></i>Create Online Course</a></li>
<?php } ?>
<li <?php if($this->uri->segment(2)=="course_listing"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/course_listing');?>"><i class="fa fa-list-ol"></i>Online Courses Listing</a></li>

<li <?php if($this->uri->segment(2)=="exam_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/exam_list');?>"><i class="fa  fa-list-alt"></i>Certificate Listing</a></li>

<?php if($uins=='0'){ ?>
<li <?php if($this->uri->segment(2)=="active_promotion"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/active_promotion');?>"><i class="fa fa-500px"></i>Promotion Listing</a></li>


<li <?php if($this->uri->segment(2)=="advertisement"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('share/advertisement');?>"><i class="fa fa-wifi"></i>Advertisement</a></li>  
 

<li <?php if($this->uri->segment(2)=="adslist"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/adslist');?>"><i class="fa fa-wifi"></i>Ads List</a></li>   -->
 
<!-- 
<li <?php if($this->uri->segment(2)=="purchase_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/purchase_list');?>"><i class="fa fa-list-alt"></i>Purchase List</a></li> 


<li <?php if($this->uri->segment(2)=="income_report"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/income_report?month=&year='.date('Y').'');?>"><i class="fa fa-money"></i>Income Report</a></li> -->
<?php } ?>


<!-- <li <?php if($this->uri->segment(2)=="training_center_plan"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/training_center_plan');?>"><i class="fa fa-signal"></i>Upload Training/Seminar</a></li>

<li <?php if($this->uri->segment(2)=="training_center_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/training_center_list');?>"><i class="fa fa-file-video-o"></i>Listing of Training/Seminar</a></li> -->






<?php   if($datass[0]['under_insititution']<1){  ?>
 
<!-- <li <?php if($this->uri->segment(2)=="purchase_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/purchase_list');?>"><i class="fa fa-list-alt"></i>Ads List</a></li>  --> 
<!-- 
<?php 
 } 
?>


<li <?php if($this->uri->segment(2)=="notification"){ ?> class="active notification"
			<?php } ?>><a href="<?php echo site_url('share/notification');?>"><i class="fa fa-envelope"></i> Notification  (<?php if($ncount > 0) { echo $ncount; }else{ echo $ncount;  } ?>) </a></li> -->
<!-- 
<li <?php if($this->uri->segment(2)=="tutorials"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('share/tutorials');?>"><i class="fa fa-file-video-o"></i> Tutorials</a></li>

<li <?php if($this->uri->segment(2)=="terms"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/terms');?>"><i class="fa fa-slideshare"></i> Terms </a></li> -->
<!-- 

<li <?php if($this->uri->segment(2)=="enquiry"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/enquiry');?>"><i class="fa fa-phone-square"></i>Contact Us</a></li> -->

<!-- <li style="display: none;" <?php if($this->uri->segment(2)=="training_registration"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/training_registration');?>"><i class="fa fa-user"></i>Training Registration</a></li> -->
<!-- <li><a href="#"><i class="fa fa-list-ol"></i>Certificate Listing</a></li> -->



<!-- <li><a href="#"><i class="fa fa-user"></i>Google Analytics</a></li>
<li><a href="<?php echo site_url('author/subscription');?>"><i class="fa fa-anchor"></i>Subscription</a></li>
<li><a href="<?php echo site_url('author/purchase_list');?>"><i class="fa fa-apple"></i>Active Advertisement</a></li> -->


<!-- <li><a href="<?php //echo site_url('author/notification');?>"><i class="fa fa-envelope"></i> Notification ( <?php //echo count($data); ?> )</a></li> -->
<!-- 
<li <?php if($this->uri->segment(2)=="profile"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/profile');?>"><i class="fa fa-edit"></i> Edit Profile</a></li> -->

<!-- <li <?php if($this->uri->segment(2)=="settings"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('author/settings');?>"><i class="fa fa-cog"></i> Settings</a></li> -->
<!-- 

</ul>
</div> -->


<div class="col-sm-3 user-nav">
	<a class="dashboard-btn" href="<?php echo base_url('author/index'); ?>">Dashboard</a>
	<?php 
		$uid = $this->session->userdata('logged_in')['id'];
		$noticationCount = $this->db->get_where('tbl_notification',array('to'=>$uid,'status'=>1))->result_array();
		$ncount = count($noticationCount);
		$uprofession = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_user','id',$uid);
		$data1 = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category','cat_name',$uprofession[0]['profession']);
	?>

		<ul class="navlist">

			<li <?php if($this->uri->segment(2)=="insurance_for_sale"){ echo 'class="active"'; } ?> ><a href="<?php echo site_url('author/insurance_for_sale');?>" ><i class="fa fa-list-alt" aria-hidden="true"></i>Car Insurance for Sale</a></li> 

			<li <?php if($this->uri->segment(2)=="buy_insurance_listing"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('author/buy_insurance_listing');?>"><i class="fa fa-list"></i>Buy Insurance Listing</a></li>
			
			<li <?php if($this->uri->segment(2)=="insurance_listing"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('author/insurance_listing');?>"><i class="fa fa-list"></i>Insurance Listing</a></li>
			
			<li <?php if($this->uri->segment(2)=="income_report"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('author/income_report');?>"><i class="fa fa-book"></i>Income Report</a></li>
			
			<li <?php if($this->uri->segment(2)=="insurance_package"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('author/insurance_package');?>"><i class="fa fa-book"></i>Insurance Package</a></li>

			<li <?php if($this->uri->segment(2)=="invoice"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('author/invoice');?>"><i class="fa fa-list-alt"></i> Invoice</a></li>

			<li <?php if($this->uri->segment(2)=="purchase_list"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('author/purchase_list');?>"><i class="fa fa-list-alt"></i> Purchase List</a></li>

			<li <?php if($this->uri->segment(2)=="notification"){ ?> class="active notification"
			<?php } ?>><a href="<?php echo site_url('author/notification');?>"><i class="fa fa-bell"></i> Notification  <?php if($ncount > 0) { echo '<span class="badge">'.$ncount.'</span>'; }else{ echo $ncount;  } ?> </a></li>

			<li <?php if($this->uri->segment(2)=="advertisement"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('share/advertisement');?>"><i class="fa fa-wifi"></i>Advertisement</a></li> 

			<li <?php if($this->uri->segment(2)=="settings"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('author/settings');?>"><i class="fa fa-cogs" aria-hidden="true"></i> Settings</a></li>


			<li <?php if($this->uri->segment(2)=="profile"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('author/profile');?>"><i class="fa fa-edit"></i> Edit Profile</a></li>
			
			<li <?php if($this->uri->segment(2)=="logout"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('users/logout');?>"><i class="fa fa-sign-out"></i> Logout</a></li>

			</ul>

		</div>



 
	
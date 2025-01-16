
	<div class="col-sm-3 user-nav">
	<a class="dashboard-btn" href="<?php echo base_url('professional/dashboard'); ?>">Dashboard</a>
		<?php 
		$uid = $this->session->userdata('logged_in')['id'];
		$noticationCount = $this->db->get_where('tbl_notification',array('to'=>$uid,'status'=>1))->result_array();
		$ncount = count($noticationCount);
		$uprofession = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_user','id',$uid);
		$data1 = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category','cat_name',$uprofession[0]['profession']);
		 /* print_r($uprofession[0]['profession']);  */ ?>
			<ul class="navlist">

			<li <?php if($this->uri->segment(2)=="dashboard"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/dashboard');?>"><i class="fa fa-book"></i> CE Certificates</a></li>
			<li <?php if($this->uri->segment(2)=="completencycard"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/completencycard');?>"><i class="fa fa-list"></i>Cards</a></li>
			
			<?php if($uprofession[0]['under_insititution']<1){?>
			<!-- <li <?php if($this->uri->segment(2)=="license_renewal_record"){ ?> class="active"
			<?php } ?>><a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i>License Renewal Record</a></li>-->

			<li <?php if($this->uri->segment(2)=="license_renewal_record"){ echo 'class="active"'; } ?> ><a href="<?php echo site_url('professional/license_renewal_record');?>" ><i class="fa fa-list-alt" aria-hidden="true"></i>Professional Identification Card(PIC) Renewal Record</a></li> 
			<?php }?>
			
			<li <?php if($this->uri->segment(2)=="course_list"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/course_list/'.$data1[0]['id'].'');?>"><i class="fa fa-book"></i> Online Courses</a></li>

			
			<li <?php if($this->uri->segment(2)=="training_list"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/training_list/'.$data1[0]['id'].'');?>"><i class="fa fa-book"></i> Training / Seminar Listing</a></li>


			<li <?php if($this->uri->segment(2)=="course_history"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/course_history');?>"><i class="fa fa-history"></i>Course History</a></li>
			
			<li <?php if($this->uri->segment(2)=="plan_subscription"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/plan_subscription');?>"><i class="fa fa-history"></i>PCE-MS Subscription Plan</a></li>

			<li <?php if($this->uri->segment(2)=="promotion_list"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/promotion_list');?>"><i class="fa fa-list-alt"></i> Promotion List</a></li>

			<li <?php if($this->uri->segment(2)=="purchase_list"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/purchase_list');?>"><i class="fa fa-list-alt"></i> Purchase List</a></li>

			<!-- 	<li <?php if($this->uri->segment(2)=="exam_list"){ ?> class="active"
						<?php } ?>><a href="<?php echo site_url('professional/exam_list');?>"><i class="fa fa-book"></i> Exam List</a></li> -->


			<!--	<li <?php if($this->uri->segment(2)=="advertise"){ ?> class="active"
						<?php } ?>><a href="<?php echo site_url('professional/advertise');?>"><i class="fa fa-wifi"></i> Advertise</a></li>

			-->
			<li <?php if($this->uri->segment(2)=="advertisement"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('share/advertisement');?>"><i class="fa fa-wifi"></i>Advertisement</a></li>  

			<li <?php if($this->uri->segment(2)=="advertise_list"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/advertise_list');?>"><i class="fa fa-list-alt"></i>Ads List</a></li>  


			<li <?php if($this->uri->segment(2)=="notification"){ ?> class="active notification"
			<?php } ?>><a href="<?php echo site_url('share/notification');?>"><i class="fa fa-bell"></i> Notification  <?php if($ncount > 0) { echo '<span class="badge">'.$ncount.'</span>'; }else{ echo $ncount;  } ?> </a></li>


			<li <?php if($this->uri->segment(2)=="tutorials"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('share/tutorials');?>"><i class="fa fa-file-video-o"></i> Tutorials</a></li>



			<li <?php if($this->uri->segment(2)=="terms"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/terms');?>"><i class="fa fa-slideshare"></i> Terms </a></li>


			<li <?php if($this->uri->segment(2)=="enquiry"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/enquiry');?>"><i class="fa fa-phone-square"></i> Contact Us</a></li>

			<li <?php if($this->uri->segment(2)=="profile"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/profile');?>"><i class="fa fa-edit"></i> Edit Profile</a></li>

			
			<li <?php if($this->uri->segment(2)=="connectToRboard"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/connectToRboard');?>"><i class="fa fa-cogs"></i>Regulatory Board Connectivity</a></li>

			<li <?php if($this->uri->segment(2)=="settings"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('professional/settings');?>"><i class="fa fa-cogs" aria-hidden="true"></i> Settings</a></li>
			
			

			</ul>

		</div>



 
	
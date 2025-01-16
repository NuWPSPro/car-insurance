
<div class="col-sm-3 user-nav">
	<a class="dashboard-btn" href="<?php echo base_url('provider/index'); ?>">Dashboard</a>
	<?php 
		$uid = $this->session->userdata('logged_in')['id'];
		$noticationCount = $this->db->get_where('tbl_notification',array('to'=>$uid,'status'=>1))->result_array();
		$ncount = count($noticationCount);
		$uprofession = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_user','id',$uid);
		$data1 = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_category','cat_name',$uprofession[0]['profession']);
	?>

		<ul class="navlist">

			<li <?php if($this->uri->segment(2)=="insurance_listing"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('provider/insurance_listing');?>"><i class="fa fa-list"></i>Purchased Insurance Listing</a></li>
			
			<li <?php if($this->uri->segment(2)=="insurance_for_sale"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('provider/insurance_for_sale');?>"><i class="fa fa-list"></i>Insurance for Sale Listing</a></li>
			
			<li <?php if($this->uri->segment(2)=="insurance_package"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('provider/insurance_package');?>"><i class="fa fa-book"></i>Insurance Package</a></li>
			
			<li <?php if($this->uri->segment(2)=="income_report"){ ?> class="active"
			<?php } ?>><a href="#"><i class="fa fa-book"></i>Income Report</a></li>
			<!-- <?php echo site_url('provider/income_report');?> -->

			<li <?php if($this->uri->segment(2)=="invoice"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('provider/invoice');?>"><i class="fa fa-list-alt"></i> Invoice</a></li>

			<li <?php if($this->uri->segment(2)=="purchase_list"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('provider/purchase_list');?>"><i class="fa fa-list-alt"></i> Purchase List</a></li>
			
			<li <?php if($this->uri->segment(2)=="broker_list"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('provider/broker_list');?>"><i class="fa fa-list-alt"></i> Broker List</a></li>

			<li <?php if($this->uri->segment(2)=="notification"){ ?> class="active notification"
			<?php } ?>><a href="<?php echo site_url('provider/notification');?>"><i class="fa fa-bell"></i> Notification  <?php if($ncount > 0) { echo '<span class="badge">'.$ncount.'</span>'; }else{ echo $ncount;  } ?> </a></li>

			<li <?php if($this->uri->segment(2)=="advertisement"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('share/advertisement');?>"><i class="fa fa-wifi"></i>Advertisement</a></li> 

			<li <?php if($this->uri->segment(2)=="settings"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('provider/settings');?>"><i class="fa fa-cogs" aria-hidden="true"></i> Settings</a></li>

			<li <?php if($this->uri->segment(2)=="change_password"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('provider/change_password');?>"><i class="fa fa-cogs" aria-hidden="true"></i> Change Password</a></li>


			<li <?php if($this->uri->segment(2)=="profile"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('provider/profile');?>"><i class="fa fa-edit"></i> Edit Profile</a></li>
			
			<li <?php if($this->uri->segment(2)=="logout"){ ?> class="active"
			<?php } ?>><a href="<?php echo site_url('users/logout');?>"><i class="fa fa-sign-out"></i> Logout</a></li>

			</ul>

		</div>



 
	
	<div class="col-sm-3 user-nav">
		<?php $segment = $this->uri->segment(2); ?>
		<a class="dashboard-btn" href="<?php echo site_url('admin/dashboard');?>">Dashboard</a>
		<ul class="navlist" style="height:950px; overflow:scroll;">

			<li class="<?php if($segment=="advertise"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/advertise');?>"><i class="fa fa-money"></i>Ads Packages</a></li>

			<li class="<?php if($segment=="adslists"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/adslists');?>"><i class="fa fa-money"></i>Ads List</a></li>

			<li class="<?php if($segment=="invoice_listing"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/invoice_listing');?>"><i class="fa fa-money"></i>Invoice Listing</a></li>

			<li class="<?php if($segment=="dashboard"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/dashboard/?month=&year='.date('Y').'');?>"><i class="fa fa-money"></i> Income Report</a></li>

			<li class="<?php if($segment=="active_promotion"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/active_promotion');?>"><i class="fa fa-arrow-circle-right"></i> Active Promotions</a></li>

			<li class="<?php if($segment=="certificate"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/certificate');?>"><i class="fa fa-money"></i>Certificate</a></li>
			
			<li class="<?php if($segment=="certificate_templete"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/certificate_templete');?>"><i class="fa fa-file" aria-hidden="true"></i>Certificate Template</a></li>

			<li class="<?php if($segment=="category"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/category');?>"><i class="fa fa-arrow-circle-right"></i>Course Category</a></li>
			
			<li class="<?php if($segment=="institution_category"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/institution_category');?>"><i class="fa fa-arrow-circle-right"></i>Institution Category</a></li>

			<li class="<?php if($segment=="subscription"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/subscription');?>"><i class="fa fa-anchor"></i> Subscription</a></li>

			<li class="<?php if($segment=="countrywebpage"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/countrywebpagelist');?>"><i class="fa fa-anchor"></i> Country Web Pages</a></li>

			<li class="<?php if($segment=="login_backend"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/login_backend');?>"><i class="fa fa-plus-circle"></i>Login Page backend</a></li>

			<li class="<?php if($segment=="blog"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/blog_list');?>"><i class="fa fa-comment"></i>News/Blog</a></li>
		
			<li class="<?php if($segment=="accreditation_list"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/accreditation_list');?>"><i class="fa fa-comment"></i>Accreditation List</a></li>

		<!-- 	<li><a href="<?php //echo site_url('admin/advertisment_listing');?>"><i class="fa fa-envelope"></i> Advertisment Listing</a></li> -->

			<li class="<?php if($segment=="course_listing"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/course_listing')?>"><i class="fa fa-list-ol"></i> Online Course Listing</a></li>

			<li class="<?php if($segment=="course_analytics"){ echo 'active'; } ?>">
				<a href="course_analytics"><i class="fa fa-signal"></i> Course Analytics</a></li>

			<li class="<?php if($segment=="training_center_list"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/training_center_list');?>"><i class="fa fa-bank"></i> Training Listing</a></li>

			<li class="<?php if($segment=="training_income"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/training_income');?>"><i class="fa fa-bank"></i> Training Income</a></li>

			<li class="<?php if($segment=="users"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/users')?>"><i class="fa fa-group"></i> User's Listing</a></li>


			<li class="<?php if($segment=="insititution"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/insititution')?>"><i class="fa fa-group"></i> Insititution Listing</a></li>


			<li class="<?php if($segment=="authors"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/authors')?>"><i class="fa fa-group"></i> Author's Listing</a></li>

			<li class="<?php if($segment=="rboard"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/rboard')?>"><i class="fa fa-university"></i> RBoard's Listing</a></li>

		<!-- <li><a href="<?php //echo site_url()?>/admin/job_listing"><i class="fa fa-envelope"></i> Jobs Listing</a></li>

			<li><a href="#"><i class="fa fa-envelope"></i> Placement Company Listing</a></li>

			<li><a href="#"><i class="fa fa-envelope"></i> Advertisment Companies</a></li> -->

			
			<li class="<?php if($segment=="provider_isting"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/provider_isting');?>"><i class="fa fa-group"></i> CPD Provider Listing</a>
			</li>

			<li class="<?php if($segment=="professional"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/professional');?>"><i class="fa fa-group"></i> Professional Listing</a>
			</li>

			<li class="<?php if($segment=="promoted_professional"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/promoted_professional');?>"><i class="fa fa-group"></i> Promoted Professional</a>
			</li>

			<li class="<?php if($segment=="notification"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/notification');?>"><i class="fa fa-envelope"></i> Notification</a>
			</li>

			<li class="<?php if($segment=="enquiry"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/enquiry');?>"><i class="fa fa-envelope"></i> Inbox Mail</a>
			</li>

			<li class="<?php if($segment=="profile"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/profile');?>"><i class="fa fa-edit"></i> Edit Profile</a>
			</li>

			<li class="<?php if($segment=="contactinfo"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/contactinfo');?>"><i class="fa fa-edit"></i>Manage Contact Info</a>
			</li>
			
			<li class="<?php if($segment=="guide"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/guide');?>"><i class="fa fa-edit"></i>Manage Guide & Exam Result</a>
			</li>

            <li class="<?php if($segment=="daily_promoted_price"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/daily_promoted_price');?>"><i class="fa fa-slideshare"></i>Daily Promoted Price </a>
			</li>
			
            <li class="<?php if($segment=="professionalplan"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/professionalplan');?>"><i class="fa fa-slideshare"></i>Professional Plans</a>
			</li>
			
			<li class="<?php if($segment=="banner_location"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/banner_location');?>"><i class="fa fa-slideshare"></i>Banner Location </a>
			</li>

			<li class="<?php if($segment=="banner_size"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/banner_size');?>"><i class="fa fa-slideshare"></i>Banner Size </a>
			</li>

			<li class="<?php if($segment=="banner"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/banner');?>"><i class="fa fa-slideshare"></i>Banner Images</a>
			</li>
			
			<li class="<?php if($segment=="tutorials"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/tutorials');?>"><i class="fa fa-slideshare"></i> Tutorial </a>
			</li>

			<li class="<?php if($segment=="countrywise_trail_days"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/countrywise_trail_days');?>"><i class="fa fa-slideshare"></i> Countrywise Trial Days </a>
			</li>

         	<li class="<?php if($segment=="faq"){ echo 'active'; } ?>">
			 	<a href="<?php echo site_url('admin/faq');?>"><i class="fa fa-question-circle"></i>FAQ</a>
				</li>

         	<li class="<?php if($segment=="client_invoice"){ echo 'active'; } ?>">
			 	<a href="<?php echo site_url('admin/client_invoice');?>"><i class="fa fa-files-o"></i>Client Invoice</a>
			</li>

         	<li class="<?php if($segment=="tax"){ echo 'active'; } ?>">
			 	<a href="<?php echo site_url('admin/tax');?>"><i class="fa fa-dollar"></i>Tax</a>
			</li>

			<li class="<?php if($segment=="terms"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/terms');?>"><i class="fa fa-file"></i> Terms </a>
			</li>

			<li class="<?php if($segment=="setting"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/setting');?>"><i class="fa fa-cogs"></i> Setting </a>
			</li>

			<li class="<?php if($segment=="digital_insurance_package"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/digital_insurance_package');?>"><i class="fa fa-certificate"></i>Digital Insurance Packages</a>
			</li>

			<li class="<?php if($segment=="ice_subscription_package"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/ice_subscription_package');?>"><i class="fa fa-cogs"></i> ICE Subscription Packages</a>
			</li>

			<li class="<?php if($segment=="rbsubscription"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('admin/rbsubscription');?>"><i class="fa fa-cogs"></i> RBoard Subscription Packages</a>
			</li>

			<li class="<?php if($segment=="logout"){ echo 'active'; } ?>">
				<a href="<?php echo site_url('users/logout');?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
			</li>

		</ul>
	</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
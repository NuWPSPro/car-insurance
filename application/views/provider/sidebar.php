
<div class="col-sm-3 user-nav">
<?php   if($under_insititution =='0'){  $cont = "provider/dashboard";  }else{ $cont = "provider/set_target";  } ?>
	<a href="<?php echo site_url().$cont; ?>" class="dashboard-btn">Dashboard</a>
<?php 
$idd1 = $this->session->userdata('logged_in')['id'];
$noticationCount = $this->db->get_where('tbl_notification',array('to'=>$uid,'status'=>1))->result_array();
$ncount = count($noticationCount);
$datass = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_user','id',$idd1);

$institution = $this->session->userdata('logged_in')['under_insititution']; ?>
<ul class="navlist">


<?php  if($datass[0]['under_insititution']>0){ ?>
<li <?php if($this->uri->segment(2)=="set_target"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/set_target');?>"><i class="fa fa-money"></i>Set Target VS. Accomplishment</a></li>

<li <?php if($this->uri->segment(2)=="staffcerecords"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/staffcerecords');?>"><i class="fa fa-book"></i>Staff Ce Record</a></li>
<?php } ?>

<?php 
if($datass[0]['under_insititution']<1){
?>
<li <?php if($this->uri->segment(2)=="income_report"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/income_report?month=&year='.date('Y').'');?>"><i class="fa fa-money"></i>Income Report</a></li>

<li <?php if($this->uri->segment(2)=="invoice_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/invoice_list');?>"><i class="fa fa-files-o" aria-hidden="true"></i>Create Invoice</a></li>

<li <?php if($this->uri->segment(2)=="accreditation"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/accreditation');?>"><i class="fa fa-list-alt"  aria-hidden="true"></i>Accreditation Record</a></li>

<?php } ?>


<li <?php if($this->uri->segment(2)=="exam_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/exam_list');?>"><i class="fa  fa-list-alt"></i>Certificate Listing</a></li>

<li <?php if($this->uri->segment(2)=="authors"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/authors');?>"><i class="fa fa-file-video-o"></i>Author's Listing</a></li>
			

<?php if($datass[0]['under_insititution']<1){?>
<li <?php if($this->uri->segment(2)=="dashboard" || $this->uri->segment(2)=="overview"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/overview');?>"><i class="fa fa-book"></i>Create Online Course</a></li>
<?php } ?>

<li <?php if($this->uri->segment(2)=="course_listing"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/course_listing');?>"><i class="fa fa-list-ol"></i>Online Courses Listing</a></li>

<?php if($datass[0]['under_insititution']<1){?>
<li <?php if($this->uri->segment(2)=="training_center_plan"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/training_center_plan');?>"><i class="fa fa-signal"></i>Upload Training/Seminar</a></li>
<?php } ?>

<li <?php if($this->uri->segment(2)=="training_center_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/training_center_list');?>"><i class="fa fa-file-video-o"></i>Listing of Training/Seminar</a></li>





<?php   if($datass[0]['under_insititution']<1){  ?>
<li <?php if($this->uri->segment(2)=="active_promotion"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/active_promotion');?>"><i class="fa fa-500px"></i>Promotion</a></li>

<li <?php if($this->uri->segment(2)=="advertisement"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('share/advertisement');?>"><i class="fa fa-wifi"></i>Advertisement</a></li>  
<?php  }  ?>

<!--<li <?php if($this->uri->segment(2)=="advertise_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/advertise_list');?>"><i class="fa fa-list-alt"></i>Ads List</a></li>-->
 
<?php //  if($datass[0]['under_insititution']<1){  ?>
<li <?php if($this->uri->segment(2)=="purchase_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/purchase_list');?>"><i class="fa fa-list-alt"></i>Purchase List</a></li>  
<?php //} ?>



<?php  if($datass[0]['under_insititution']>0){ ?>
<li <?php if($this->uri->segment(2)=="pre_paid_package"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/pre_paid_package');?>"><i class="fa fa-certificate"></i>Pre-Paid Digital Certificate Packages</a></li>  

<li <?php if($this->uri->segment(2)=="digitalSubscriptionTracker"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/digitalSubscriptionTracker');?>"><i class="fa fa-list"></i>Digital Subscription Tracker</a></li>  
<?php } ?>

<li <?php if($this->uri->segment(2)=="notification"){ ?> class="active notification" <?php } ?>><a href="<?php echo site_url('share/notification');?>"><i class="fa fa-envelope"></i> Notification  (<?php if($ncount > 0) { echo '<span class="badge">'.$ncount.'</span>'; }else{ echo $ncount;  } ?>) </a></li>

<li <?php if($this->uri->segment(2)=="tutorials"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('share/tutorials');?>"><i class="fa fa-file-video-o"></i> Tutorials</a></li>

<li <?php if($this->uri->segment(2)=="terms"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/terms');?>"><i class="fa fa-slideshare"></i> Terms </a></li>

<li <?php if($this->uri->segment(2)=="blog_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/blog_list');?>"><i class="fa fa-comment" aria-hidden="true"></i> News/Blog </a></li>

<li <?php if($this->uri->segment(2)=="enquiry"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/enquiry');?>"><i class="fa fa-phone-square"></i>Contact Us</a></li>

<!-- <li style="display: none;" <?php if($this->uri->segment(2)=="training_registration"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/training_registration');?>"><i class="fa fa-user"></i>Training Registration</a></li> -->
<!-- <li><a href="#"><i class="fa fa-list-ol"></i>Certificate Listing</a></li> -->

<!-- <li><a href="#"><i class="fa fa-user"></i>Google Analytics</a></li>
<li><a href="<?php echo site_url('provider/subscription');?>"><i class="fa fa-anchor"></i>Subscription</a></li>
<li><a href="<?php echo site_url('provider/purchase_list');?>"><i class="fa fa-apple"></i>Active Advertisement</a></li> -->


<!-- <li><a href="<?php //echo site_url('provider/notification');?>"><i class="fa fa-envelope"></i> Notification ( <?php //echo count($data); ?> )</a></li> -->
<?php $warning = (empty($datass[0]['paypal_email']))?'<i class="fa fa-warning" style="color:red"></i>':''; ?>
<li <?php if($this->uri->segment(2)=="profile"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/profile');?>"><i class="fa fa-edit"></i> Edit Profile <?php if($institution!=1){ echo $warning; } ?></a></li>


<?php  if($datass[0]['under_insititution']==0){ ?>
<li <?php if($this->uri->segment(2)=="editCEPWebpage"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/editCEPWebpage');?>"><i class="fa fa-edit"></i>Edit Webpage</a></li>
<?php } ?>

<li <?php if($this->uri->segment(2)=="connectToRboard"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/connectToRboard');?>"><i class="fa fa-cogs"></i>Regulatory Board Connectivity</a></li>

<li <?php if($this->uri->segment(2)=="settings"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('provider/settings');?>"><i class="fa fa-cogs"></i> Settings</a></li>


</ul>
</div>
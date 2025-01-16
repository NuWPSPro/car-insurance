<?php 
$uid = $this->session->userdata('logged_in')['id'];
$segment = $this->uri->segment(2);
$noticationCount = $this->rboard->get_rboard_notification($uid);
$ncount = count($noticationCount); ?>


<div class="col-sm-3 user-nav">
<a class="dashboard-btn" href="">Dashboard</a>
<ul class="navlist">

<li class="<?php if($segment=="subscription_package"){ echo 'active'; } ?>">
	<a href="<?php echo site_url('rboard/subscription_package');?>"><i class="fa fa-list"></i> Subscription Package </a>
</li>

<li class="<?php if($segment=="subscription_history"){ echo 'active';} ?>">
	<a href="<?php echo site_url('rboard/subscription_history');?>"><i class="fa fa-list"></i> Subscription History </a>
</li>

<li class="<?php if($segment=="purchase_history"){ echo 'active';} ?>">
	<a href="<?php echo site_url('rboard/purchase_history');?>"><i class="fa fa-list"></i> Purchase History </a>
</li>

<li class="notification <?php if($segment=="notification"){ echo 'active';} ?>">
	<a href="<?php echo site_url('share/notification');?>"><i class="fa fa-envelope"></i> Notification 
	<span class="badge"><?php if($ncount > 0){ echo $ncount; }else{ echo $ncount;  } ?></span> </a>
</li>

<li class="<?php if($segment=="terms"){ echo 'active'; }?>">
	<a href="<?php echo site_url('rboard/terms');?>"><i class="fa fa-slideshare"></i> Terms </a>
</li>
<li class="<?php if($segment=="tutorials"){ echo 'active'; }?>" >
	<a href="<?php echo site_url('share/tutorials');?>"><i class="fa fa-file-video-o"></i> Tutorials</a>
</li>

<li class="<?php if($segment=="edit_profile"){ echo 'active'; }?>">
	<a href="<?php echo site_url('rboard/edit_profile');?>"><i class="fa fa-edit"></i> Edit Profile </a>
</li>

<li class="<?php if($segment=="change_password"){ echo 'active'; }?>">
	<a href="<?php echo site_url('rboard/change_password');?>"><i class="fa fa-lock"></i> Change Password </a>
</li>

<li class="<?php if($segment=="settings"){ echo 'active'; } ?>">
	<a href="<?php echo site_url('rboard/settings');?>"><i class="fa fa-cogs"></i>Settings</a>
</li>


<!-- //for future refrence: Ralph will ask for these functionality also   
<li class="<?php if($segment=="enquiry"){ echo 'active'; } ?>" ><a href="<?php echo site_url('rboard/enquiry');?>"><i class="fa fa-phone-square"></i>Contact Us</a></li>
 -->

</ul>
</div>
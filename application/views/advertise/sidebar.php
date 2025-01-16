<div class="col-sm-3 user-nav">
    <?php 
$notification = $this->user->get_record_by_field_name_all_record_order_by_id_desc('tbl_notification','status',1);
?>
    <ul class="navlist">
      
       
    <!--  <li><a href="<?php echo site_url('advertise/dashboard');?>"><i class="fa fa-file-video-o"></i> Dashboard</a></li> -->
        <li <?php if($this->uri->segment(2)=="add_advertise"){ ?> class="active"
            <?php } ?>><a href="<?php echo site_url('advertise/add_advertise');?>"><i class="fa fa-file-video-o"></i> Add Advertise</a></li>
        <li <?php if($this->uri->segment(2)=="advertise"){ ?> class="active"
            <?php } ?>><a href="<?php echo site_url('advertise/advertise');?>"><i class="fa fa-file-video-o"></i>Purchase list</a></li>
        
		<li <?php if($this->uri->segment(2)=="notification"){ ?> class="active"
            <?php } ?>><a href="<?php echo site_url('advertise/notification');?>"><i class="fa fa-file-video-o"></i>Notification  (<?=count($notification)?>)</a></li>
        <li <?php if($this->uri->segment(2)=="tutorials"){ ?> class="active"
            <?php } ?>><a href="<?php echo site_url('share/tutorials');?>"><i class="fa fa-slideshare"></i> Tutorials </a></li>
        <li <?php if($this->uri->segment(2)=="terms"){ ?> class="active"
            <?php } ?>><a href="<?php echo site_url('advertise/terms');?>"><i class="fa fa-slideshare"></i> Terms </a></li>
        <li <?php if($this->uri->segment(2)=="enquiry"){ ?> class="active"
            <?php } ?>><a href="<?php echo site_url('advertise/enquiry');?>"><i class="fa fa-phone-square"></i> Contact Us</a></li>
        <li <?php if($this->uri->segment(2)=="profile"){ ?> class="active"
            <?php } ?>><a href="<?php echo site_url('advertise/profile');?>"><i class="fa fa-edit"></i> Edit Profile</a></li>
    </ul>
</div>
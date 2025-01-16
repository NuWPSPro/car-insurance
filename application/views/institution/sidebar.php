<div class="col-sm-12"><a class="dashboard-btn" href="<?php echo base_url('institution/settarget'); ?>">Dashboard</a></div>
<div class="col-sm-3 user-nav">
<?php 
 $uid = $this->session->userdata('logged_in')['id'];
 $noticationCount = $this->db->get_where('tbl_notification',array('to'=>$uid,'status'=>1))->result_array();
		$ncount = count($noticationCount);
 $userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','id',$uid); ?>

<ul class="navlist">
    
<?php if($userdetails[0]['under_insititution']=='0'){ ?>
<li <?php if($this->uri->segment(2)=="editwebpage"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/editwebpage');?>"><i class="fa fa-edit"></i> Edit Institution CE Webpage</a></li>
<?php } ?>


<li <?php if($this->uri->segment(2)=="settarget"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/settarget');?>"><i class="fa fa-money"></i> SUMMARY OF SET TARGET Vs. ACCOMPLISHMENT</a></li>

<?php if($userdetails[0]['parent_insititution']==0){ ?>
<li <?php if($this->uri->segment(2)=="subinsititution"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/subinsititution');?>"><i class="fa fa-university"></i>Sub institutions</a></li>
<?php } ?>

<li <?php if($this->uri->segment(2)=="ceproviders"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/ceproviders');?>"><i class="fa fa-user"></i> ce providers</a></li>

<li <?php if($this->uri->segment(2)=="autherlisting"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/autherlisting');?>"><i class="fa fa-list-alt"></i>  Authors Listing</a></li>

<li <?php if($this->uri->segment(2)=="staffcerecords"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/staffcerecords');?>"><i class="fa fa-list"></i> Staff ce record</a></li>
<li <?php if($this->uri->segment(2)=="certificate"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/certificate');?>"><i class="fa fa-list-alt"></i>Certificate Listing</a></li>

 


<li <?php if($this->uri->segment(2)=="courcelisting"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/courcelisting');?>"><i class="fa fa-book"></i> online course listing</a></li>    

<li <?php if($this->uri->segment(2)=="traininglisting"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/traininglisting');?>"><i class="fa fa-list-alt"></i> traning listings</a></li>    

 
<!-- <li <?php if($this->uri->segment(2)=="advertisements"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('share/advertisement');?>"><i class="fa fa-wifi"></i>Advertisement</a></li>

 <li <?php if($this->uri->segment(2)=="add_list"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/add_list');?>"><i class="fa fa-list-alt"></i>ADS LIST</a></li>
 -->        
        <li <?php if($this->uri->segment(2)=="purchase_lists"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/purchase_lists');?>"><i class="fa fa-list-alt"></i>Purchase List</a></li> 

 




<li <?php if($this->uri->segment(2)=="tutorials"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('share/tutorials');?>"><i class="fa fa-file-video-o"></i> Tutorials</a></li>

<li <?php if($this->uri->segment(2)=="terms"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/terms');?>"><i class="fa fa-slideshare"></i> Terms </a></li>



<li <?php if($this->uri->segment(2)=="blog_list"){ ?> class="active"
<?php } ?>>
<a href="<?php echo site_url('institution/blog_list');?>"><i class="fa fa-comment"></i>News/Blog </a></li>
<!-- <a href="javascript:void(0)" onclick="alert('Comming Soon!');"><i class="fa fa-slideshare"></i> Blog </a></li> -->

<li <?php if($this->uri->segment(2)=="profile"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/profile');?>"><i class="fa fa-edit"></i> Edit Profile</a></li>

<li <?php if($this->uri->segment(2)=="enquiry"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/enquiry');?>"><i class="fa fa-phone-square"></i>Contact Us</a></li>

<li <?php if($this->uri->segment(2)=="notification"){ ?> class="active notification"<?php } ?>>
	<a href="<?php echo site_url('share/notification');?>"><i class="fa fa-envelope"></i> Notification <?php if($ncount > 0) { echo '<span class="badge">'.$ncount.'</span>'; }else{ echo $ncount;  } ?> </a></li>

  
<li <?php if($this->uri->segment(2)=="settings"){ ?> class="active"
<?php } ?>><a href="<?php echo site_url('institution/settings');?>"><i class="fa fa-cogs"></i>Settings</a></li>

</ul>
</div>
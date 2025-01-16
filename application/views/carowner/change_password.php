<?php  $this->load->view('carowner/picture'); ?>

		<!-- Main body start -->
		<div class="col-sm-9">
			<?=$body_heading; ?>
            <?php echo $this->session->flashdata('response'); ?>
	                <p>Set New password(Enter Atleast 6 Digits)</p>
            	</div>
            
                <form action="<?php echo BASE_URL;?>professional/change_password" method="post" enctype="multipart/form-data" name="form1" id="form1">
                 
                    <?php    $email = $_REQUEST['username_email'];?>
                     <?php       $key = $_REQUEST['key'];?> 
                     <div class="col-sm-9 mb-3">
                     <label>Old Password</label>
					<input type="password" name="oldpassword" class="form-control">
                    <span class="error"><?php echo  form_error('oldpassword'); ?></span>
                    </div>
                    <div class="col-sm-9 mb-3">
                        <label>New Password <span class="required"> * </span> </label>
                        <input name="password" class="form-control" value="" size="20" type="password">
                        <!-- <input name="forgot_password_key" class="form-control" value="<?php echo $key; ?>" size="20" type="hidden">
                        <input name="email" class="form-control" value="<?php echo $email; ?>" size="20" type="hidden"> -->
                        <span class="error"><?php echo  form_error('password'); ?></span>
                        </div>
					<div class="col-sm-9 mb-3">
                        <label>Confirm Password <span class="required"> * </span> </label>
                        <input name="confpassword" class="form-control" value="" size="20" type="password">
                        <span class="error"><?php echo  form_error('confpassword'); ?></span>
                    </div>
                    <div class="col-sm-9 mb-3">
                        <input class="btn btn-lg col-xs-12 btn-primary" value="Submit" type="submit" name="Submit">
                    </div>
                  
                </form>
            </div>
        </div>
        <!-- <div class="col-sm-8">
 <?php 
						
						//  $topbanner = $this->advertiseads->getAdvertiserBanner('Register Side');					
						//   if(count($topbanner))
						//   {
						// 	  foreach($topbanner as $banner)
						// 	  {
						// 		  $this->advertiseads->updateCount($banner['id']); 
						// 		  ?>
						// 		  <div class="item">
                        //          <a href="<?php if($banner['website_url']){ echo $banner['website_url'];}else{ echo "#";}?>">
                        //             <img src="<?php echo ASSETS_URL; ?>upload/<?php echo $banner['banner_image'];?>" alt="">
                        //        </a>
                        //         </div>
						// 		  <?php
						// 		  break;
						// 	  }
						//   }else
						//   {
						?>
						<a href="#">
            <div class="item"><img src="<?php echo ASSETS_URL; ?>images/advertise/new-788-x-365.jpg" alt=""></div>
           </a>
			<?php
			
						//   }
			?>        </div> -->
    </div>
</div>
</div>
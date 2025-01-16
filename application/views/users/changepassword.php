<div class="container">
    <div class="row my-5">
        <div class="col-sm-4">
            <div class="clearfix login-grid">
            	<div>
	                <h3 class="mt-0">CHANGE PASSWORD</h3>
	                <p>Set New password(Enter Atleast 6 Digits)</p>
            	</div>
            
                <form action="<?php echo BASE_URL;?>users/changepassword" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <?php echo $this->session->flashdata('response');
                            $email = $_REQUEST['email'];
                            $key = $_REQUEST['key']; ?>
                    <p>
                        <label>New Password <span class="required"> * </span> </label>
                        <input name="password" class="form-control" value="" size="20" type="text">
                        <input name="forgot_password_key" class="form-control" value="<?php echo $key; ?>" size="20" type="hidden">
                        <input name="email" class="form-control" value="<?php echo $email; ?>" size="20" type="hidden">
                        <span class="error"><?php echo  form_error('password'); ?></span>
                    </p>
					<p>
                        <label>Confirm Password <span class="required"> * </span> </label>
                        <input name="confpassword" class="form-control" value="" size="20" type="text">
                        <span class="error"><?php echo  form_error('confpassword'); ?></span>
                    </p>
                    <p class="clearfix">
                        <input class="btn btn-lg col-xs-12 btn-primary" value="Submit" type="submit" name="Submit">
                    </p>
                    <div class="text-center">
                        <a href="<?php echo site_url('users');?>">Login</a> &nbsp;|&nbsp;<a href="<?php echo site_url('users/signup');?>">Register</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-8">
 <?php 
						
						 $topbanner = $this->advertiseads->getAdvertiserBanner('Register Side');					
						  if(count($topbanner))
						  {
							  foreach($topbanner as $banner)
							  {
								  $this->advertiseads->updateCount($banner['id']); 
								  ?>
								  <div class="item">
                                 <a href="<?php if($banner['website_url']){ echo $banner['website_url'];}else{ echo "#";}?>">
                                    <img src="<?php echo ASSETS_URL; ?>upload/<?php echo $banner['banner_image'];?>" alt="">
                               </a>
                                </div>
								  <?php
								  break;
							  }
						  }else
						  {
						?>
						<a href="#">
            <div class="item"><img src="<?php echo ASSETS_URL; ?>images/advertise/new-788-x-365.jpg" alt=""></div>
           </a>
			<?php
			
						  }
			?>        </div>
    </div>
</div>
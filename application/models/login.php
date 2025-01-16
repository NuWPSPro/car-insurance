<?php
if(!isset($_SESSION['display']))
{
$_SESSION['display']=1;
}
$display=$_SESSION['display'];
 $topbanner1 = $this->advertiseads->getAdvertiserBanner('Register Side');
  if(count($topbanner1))
	{
		$this->advertiseads->updateCount($banner[0]['id']); 
		$url=ASSETS_URL.'upload/'.$topbanner1[0]['banner_image'];
	}
	else
	{
		$url=BASE_URL.'/assets/images/login-ads.jpg';
	}	

?>

<div class="container"  >
    <div class="row my-5" <?php if($display==1){?>style="background-image: url('<?php echo $url; ?>');
	background-repeat: no-repeat;"<?php $_SESSION['display']=2; } ?>	>
        <div class="col-sm-4">
            <div class="clearfix login-grid">
                <div class="">
                    <h3 class="mt-0">LOGIN</h3>
                </div>
                <form action="<?php echo BASE_URL;?>users" method="post" enctype="multipart/form-data" name="form1" id="form1" autocomplete="off">
                    <?php echo $this->session->flashdata('response');?>
                    <p>
                        <label>Username/Email <span class="required"> * </span> </label>
                        <input name="username" class="form-control" value="" size="20" type="text">
                        <span class="error"><?php echo  form_error('username'); ?></span>
                    </p>
                    <p>
                        <label>Password <span class="required"> * </span> </label>
                        <input name="password" class="form-control" value="" size="20" type="password">
                        <span class="error"><?php echo  form_error('password'); ?></span>
                    </p>
                    <p class="text-right"><a href="<?php echo site_url('users/forgotpassword');?>">Forgot Password</a></p>
                    <input class="btn btn-lg btn-primary col-xs-12" value="Login" type="submit" name="save">
                </form>
            </div>
        </div>
        <div class="col-sm-8">

            <?php 
         // echo '<pre>';  print_r($adv);
            ?>
<?php if($display==2){?>
            <div class="login-ads dt-sc-ico-content">
			
			
                <div class="login-slider">
				<div class="item">
                                 
                                    <img src="<?=$url?>" alt="">
                               
                                   </div>
				   <?php 
						
						/* 					
						  if(count($topbanner))
						  {
							  foreach($topbanner as $banner)
							  {
								  $this->advertiseads->updateCount($banner['id']); 
								  ?>
								  <div class="item">
                                 
                                    <img src="<?php echo ASSETS_URL; ?>upload/<?php echo $banner['banner_image'];?>" alt="">
                               
                                   </div>
								  <?php
								  break;
							  }
						  }else
						  {
						?>
                            <div class="item"><img src="<?php echo BASE_URL;?>/assets/images/login-ads.jpg"></div>
          
							<?php
							
							} */
							?>
                    
                    
                </div>
            </div>
			<?php
$_SESSION['display']=1;
			} ?>
        </div>
    </div>
</div>
</div>
<?php
if(!isset($_SESSION['display']))
    {   $_SESSION['display'] = 1; }

        $display = $_SESSION['display'];
        $topbanner1 = $this->advertiseads->getAdvertiserBanner('Register Side');
  if(count($topbanner1))
	{
		$this->advertiseads->updateCount($banner[0]['id']); 
		$url = ASSETS_URL.'upload/'.$topbanner1[0]['banner_image'];
	}
	else
	{
        // $topbanner1 = $this->dashboards_model->get_login_backend(); 
        $topbanner1 = $this->db->get_where('tbl_login_backend',array('status'=>'1'))->result_array(); 
        $count = count($topbanner1);
        // echo $display;
        $profession_name = $this->db
        ->get_where('tbl_category',array('id'=>$topbanner1[$display]['profession_id']))
        ->row_array()['cat_name'];
		// $url = BASE_URL.'/assets/images/login-ads.png';
        $title = $topbanner1[$display]['title'];
        $sub_title = $topbanner1[$display]['sub_title'];
        $url = ASSETS_URL.'upload/login_backend/'.$topbanner1[$display]['background_image'];
	}	

?>
<?php
// echo $count;
?>
<?php if( $display==1){ ?>
<style>
    .login-backend-textbotom {
        display: none;
    }
    .login-backend-texttop {
        padding-left: 10%;
        display: block;
    }
    .login-backend-textbotom {
        left: 0;
    }
    .login_backend_box {
        position: relative;
    }
    .login_box_sec {
        position: absolute;
left: 440px;
text-align: left;
top: 50px;
    }
</style>
<?php $_SESSION['display']=2; } ?>

<section class="login-panal" <?php if( $display==1 || $display==2){ ?>style="background-image: url('<?php echo $url; ?>'); background-size: cover; background-repeat: no-repeat; position: relative;"<?php $_SESSION['display']=1; } ?>>
    <div class="login-backend-texttop">
        <div class="login_backend_box login-backend-text">
            <div class="login_box_sec">
                <h5><?php echo $title; ?></h5>
                <p><?php echo $sub_title; ?></p>
                <span><?php echo $profession_name; ?></span>
            </div>
        </div>
    </div>
  <div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="clearfix login-grid">
                <div class="">
                    <h3 class="mt-0">LOGIN</h3>
                </div>
                <form action="<?php echo BASE_URL;?>users" method="post" enctype="multipart/form-data" name="form1" id="form1" autocomplete="off">
                    <?php echo $this->session->flashdata('response');?>
                    <div class="form-group">
                        <label>Username/Email <span class="required"> * </span> </label>
                        <input name="username" class="form-control" value="<?php echo $_REQUEST['username']; ?>" size="20" type="text" autocomplete="false">
                        <input name="location" class="form-control" value="<?php echo $_REQUEST['location']; ?>" type="hidden" >
                        <span class="error"><?php echo  form_error('username'); ?></span>
                    </div>
                    <div class="form-group">
                        <label>Password <span class="required"> * </span> </label>
                        <div class="input_change_box">
                            <input name="password" class="form-control pwd" value="" size="20" type="password" autocomplete="false">
                            <span class="error"><?php echo  form_error('password'); ?></span>
                            <span class="input_change_icon position-absolute">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                    <p class="text-right"><a href="<?php echo site_url('users/forgotpassword');?>">Forgot Password</a></p>
                    <input class="btn btn-lg btn-primary col-xs-12" value="Login" type="submit" name="save">
                    <p class="text-center">No Account Yet? <a href="javascript:void(0);" onclick="register_now()" title="Register Now" > Register!</a></p>
                </form>
            </div>
        </div>
        <div class="col-sm-8">
            <?php 
         // echo '<pre>';  print_r($adv);
            ?>
        <?php if($display==3){?>
            <div class="login-ads dt-sc-ico-content" style="position: relative;">
                <div class="login-backend-textbotom">
                    <div class="login_backend_col_box login-backend-text">
                        <h5><?php echo $title; ?></h5>
                        <p><?php echo $sub_title; ?></p>
                        <span><?php echo $profession_name; ?></span>
                    </div>
                </div>
			
			
                <div class="login-slider">
				<div class="item">
                    <a href="<?php if($banner['website_url']){ echo $banner['website_url'];}else{ echo "#";}?>">
                        <img src="<?=$url?>" alt="">
                    </a>
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
			<?php $_SESSION['display'] = 1; } ?>
        </div>
    </div>
</div>
</section>

<a href="#" id="scroll"><span></span></a>

<script>
    $(".input_change_icon").on('click',function() {
           var $pwd = $(".pwd");
           if ($pwd.attr('type') === 'password') {
                  $pwd.attr('type', 'text');
           }
           else {
                  $pwd.attr('type', 'password');
            }
     });        
    $(document).ready(function(){
       $(".input_change_icon").click(function(){
            $(".input_change_icon i").toggleClass("fa-eye-slash");
       });
    });
</script>
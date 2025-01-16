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
        
    }   

?>

<style>
    .login-panal {
        position: relative;
        padding: 0;
        min-height: 550px;
    }
    .login-panal .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .login-panal .carousel-indicators {
        display: none;
    }
    .login_backend_box {
        position: absolute;
        left: 620px;
        top: 0;
        z-index: 99;
        width: 460px;
        text-align: left;
    }
    .login-panal .item:after {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0 auto;
        text-align: center;
        width: 100%;
        padding: 10px 0px;
            padding-left: 0px;
        background: rgba(0,0,0,0.3);
        height: 100%;
        content:'';
    }
    .input_change_box {
    position: relative;
    width: 100%;
    height: 100%;
}
.input_change_box input {
    padding-right: 30px;
    padding-right: 10%;
}
.input_change_icon {
    position: absolute;
    top: 0px;
    right: 0px;
    height: 100%;
    width: 10%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    cursor: pointer;
}
</style>

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
    
</style>
<?php $_SESSION['display']=2; } ?>

<section class="login-panal" <?php if( $display==1 || $display==2){ ?><?php $_SESSION['display']=2; } ?> >
    
    <div id="slider-container" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
            <?php foreach($topbanner1 as $key => $value){ 
                $profession_name = $this->db
                ->get_where('tbl_category',array('id'=>$value['profession_id']))
                ->row_array()['cat_name'];?>
                <div class="item">
                    <img src="<?php echo ASSETS_URL.'upload/login_backend/'.$value['background_image']; ?>" alt="">
                    <div class="login_backend_box login-backend-text">
                        <div class="box_slider_content">
                            <h5 style="font-family: 'Brush Script MT', cursive; font-style: italic; font-size: 60px"><?php echo $value['title']; ?></h5>
                            <p><?php echo $value['sub_title']; ?></p>
                            <span><?php echo $profession_name; ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
               <!--  <div class="item">
                    <img src="<?php echo $url; ?>" alt="">
                    <div class="login_backend_box login-backend-text">
                        <div class="box_slider_content">
                            <h5 style="font-family: 'Brush Script MT', cursive; font-style: italic; font-size: 60px"><?php echo $title; ?></h5>
                            <p><?php echo $sub_title; ?></p>
                            <span><?php echo $profession_name; ?></span>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo $url; ?>" alt="">
                    <div class="login_backend_box login-backend-text">
                        <div class="box_slider_content">
                            <h5 style="font-family: 'Brush Script MT', cursive; font-style: italic; font-size: 60px"><?php echo $title; ?></h5>
                            <p><?php echo $sub_title; ?></p>
                            <span><?php echo $profession_name; ?></span>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <img src="<?php echo $url; ?>" alt="">
                    <div class="login_backend_box login-backend-text">
                        <div class="box_slider_content">
                            <h5 style="font-family: 'Brush Script MT', cursive;font-style: italic; font-size: 60px"><?php echo $title; ?></h5>
                            <p><?php echo $sub_title; ?></p>
                            <span><?php echo $profession_name; ?></span>
                        </div>
                    </div>
                </div> -->
            </div>
            <ol class="carousel-indicators">
                <li data-target="#slider-container" data-slide-to="0" class="active"></li>
                <li data-target="#slider-container" data-slide-to="1"></li>
                <li data-target="#slider-container" data-slide-to="2"></li>
            </ol>
        </div>
    <!--<div class="login-backend-texttop">-->
        
    <!--</div>-->
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
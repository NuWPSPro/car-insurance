<section class="active_bg" style="background-image: url(<?php echo ASSETS_URL.'images/bg_welcome.jpg';?>); background-repeat: no-repeat;background-size: cover;">
<div class="container">
    <div class="main_div" style="">
        <div class="site-logo__link">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo ASSETS_URL.'images/popup-logo.png'; ?>" alt="logo"></a>
        </div>
        <h5 class="welcome_text">
            <!-- <img src="<?php echo ASSETS_URL.'images/Welcome-text.png'; ?>" alt="welcome" width="175"> -->
            <img src="<?php echo ASSETS_URL.'images/congratulations.png';?>" alt="congratulations" width="175"><span style="color: red; font-size: 60px;"><i>!</i></span>
        </h5>
        <div class="para_text"><?php echo $this->session->flashdata('response'); ?></div>
        
        <!-- <a href="<?php echo base_url(); ?>" class="ceonpoint_btn">Go to ceonpoint.com</a>
        <span class="or_text">Or</span> -->
            <?php $location = explode('%22',$_SERVER['REQUEST_URI']);
            // print_r($location); die; ?>
        <a href="<?php echo BASE_URL.'users'?>?location=<?php echo $location[1]; ?>" class="login_btn">Log-in</a>
        <!-- <a href="<?php echo base_url('users/index?location='.htmlspecialchars($_REQUEST['location'])); ?>" class="btn btn-info">Login</a> -->
    </div>
</div>
</section>
<style>
    body{
        margin:0 !important;
    }
    .active_bg {
    height: 100vh;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}
.main_div {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
    width: 530px;
    padding: 30px 35px;
    margin: 0 auto;
    border-radius: 5px;
    background-color: rgba(255,255,255,0.6);
}
    .site-logo__link {
        width: 75%;
    }
    .site-logo__link a {
        display: inline-block;
    }
    .site-logo__link a img {
        width: 100% ;
    }
    .welcome_text {
        font-weight: bold;
        width: 100%;
    }
    .welcome_text img {
        width: 55%;
    }
    .para_text {
        margin-bottom: 20px;
        font-size: 18px;
        font-weight: 500;
        line-height: 20px;
    }
    .or_text {
        display: block;
        font-weight: 600;
        margin: 15px 0px;
    }
    .login_btn, .ceonpoint_btn {
        color: #fff;
        /*padding: 10px;*/
        padding: 7px 45px 7px 45px;
        text-decoration: none;
        border-radius: 5px;
    }
    .login_btn {
        background-color: #007ded;
        border-color: #007ded;
    }
    .ceonpoint_btn {
        background-color: #ffa500;
        border-color: #ffa500;
    }
</style>
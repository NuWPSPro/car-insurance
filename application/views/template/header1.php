<!DOCTYPE html>

<html class="yes-js js_active js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths gr__lmstheme_wpengine_com" style="" lang="en-US">


<head>
    <meta property="og:title" content="<?php echo (!empty($og_title))?$og_title:'';?>"/>
    <meta property="og:type" content="<?php echo (!empty($og_type))?$og_type:'';?>"/>
    <meta property="og:url" content="<?php echo (!empty($og_url))?$og_url:'';?>"/>
    <meta property="og:image" content="<?php echo (!empty($og_image))?$og_image:'';?>"/>
    <meta property="og:site_name" content="CEONPOINT"/>
    <meta property="fb:app_id" content="153607476069216"/>
    <meta property="og:description" content="<?php echo (!empty($og_description))?$og_description:'';?>"/>
    
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script type="text/javascript">
    document.documentElement.className = document.documentElement.className + ' yes-js js_active js'
    </script>
    <title>My CPD Unit</title>
    <link rel="shortcut icon" href="<?php echo ASSETS_URL; ?>images/favicon.png" type="image/x-icon">
    <link rel="icon" href="<?php echo ASSETS_URL; ?>images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL; ?>js/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL; ?>css/style.css">
    <link href="<?php echo ASSETS_URL ?>editor/css/froala_editor.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS_URL ?>editor/css/froala_content.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS_URL ?>editor/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo ASSETS_URL; ?>js/jquery.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>js/bootstrap.min.js"></script>
</head>

<body>
<div class="header-strip">
    <?php 
        $contactinfo = $this->db->get_where('tbl_contact_info',array('id'=>1))->row_array();
    ?>
    <div class="container text-right">
        <ul>
            <?php echo $contactinfo['phone'];?>
        </ul>
        <a href="mailto:<?php echo $contactinfo['email'];?>"><?php echo $contactinfo['email'];?></a>
    </div>
</div>

<header id="header">
    <div class="container">
        <div class="logo"><a href="<?php echo BASE_URL;?>"><img src="<?php echo ASSETS_URL; ?>images/logo.png" alt="logo"></a></div>
        <div class="header-register icons-header">
            <ul class="dt-sc-default-login">
                <?php if(empty($this->session->userdata('logged_in'))){ ?>
                <li><a href="<?php echo BASE_URL?>users" title="Login"><i class="fa fa-user"></i>Login</a><a href="<?php echo BASE_URL?>users/signup" title="Register Now" class="register">Register</a></li>
                <?php } else { 
				$role = $this->session->userdata('logged_in')['role'];	
				if($role==1){
				$cont = "professional";
				} 
				else if($role==2){
				$cont = "provider";
				}

				else if($role==10){
				$cont = "admin";
				}
					?>
                <li><a href="<?php echo BASE_URL.$cont?>/dashboard" title="My Account"><i class="fa fa-user"></i>My Account<span> | </span></a><a href="<?php echo BASE_URL?>users/logout" title="Logout">Logout</a></li>
                <?php 	} ?>
                <!-- <li class="dt-sc-cart">
                    <a href="#"><i class="fa fa-shopping-cart"></i><span class="cart-count">0</span></a>
                </li> -->
            </ul>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#myNavbar">
                <i class="fa fa-bars"></i> Menu
            </button>
        </div>
        <nav class="navbar">
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="current_page_item"><a href="<?php echo site_url();?>">Home</a></li>
                    <li><a href="<?php echo site_url('pages/courselist');?>">Online CPD Courses</a></li>
                    <li><a href="<?php echo site_url('pages/latestprofessional');?>">Professionals</a></li>
                    <li><a href="#">Jobs</a></li>
                    <li><a href="<?php echo site_url('pages/training');?>">Trainings/Seminars</a></li>
                    <li><a href="javascript:void(0);">Pages <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="<?php echo site_url('pages/certificatevalidation');?>">Certificate Validation</a></li>

                                <li><a href="<?php echo site_url('pages/cpdprovider');?>">CPD Providers</a></li>

                                <li><a href="<?php echo site_url('pages/guide');?>">CPD Guide</a></li>

                                <li><a href="<?php echo site_url('pages/prcexam');?>">PRC Exam Results</a></li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </div>
</header>
<?php
$currentPageTitle = ""; 
if($this->uri->segment(2)==""){
		$currentPageTitle = "Login"; 
}

if($this->uri->segment(2)=="signup"){
		$currentPageTitle = "Register"; 
}


if($this->uri->segment(2)=="forgotpassword"){
		$currentPageTitle = "Forgot Password"; 
}

?>
<!-- <div class="banner">
    <div class="container">
        <div class="row">
            <div class="banner-left">
                <h1><?php echo $currentPageTitle; ?></h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo BASE_URL;?>">Home</a></li>
                    <li><?php echo $currentPageTitle; ?></li>
                </ul>
            </div>
            <div class="header-search">
            	<form method="get" id="searchform" class="searchform" action="https://lmstheme.wpengine.com/">
                    <div class="selection-box">
                        <select name="searchtype" id="searchtype" class="selectpicker">
                            <option value="professsions">Professions</option>
                            <option value="courses">Courses</option>
                            <option value="teachers">Authors</option>
                        </select>
                    </div>
                    <input id="s" name="s" value="" class="text_input" placeholder="Search" type="text">
                    <input name="search-type" value="default" type="hidden">
                    <input value="" type="submit">
                </form>
            </div>
        </div>
    </div>
</div> -->
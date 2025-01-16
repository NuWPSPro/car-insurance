<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <title>Car Insurance</title>
	<meta property="og:title" content="<?php echo (!empty($og_title))?$og_title:'';?>"/>
	<meta property="og:type" content="<?php echo (!empty($og_type))?$og_type:'';?>"/>
	<meta property="og:url" content="<?php echo (!empty($og_url))?$og_url:'';?>"/>
	<meta property="og:image" content="<?php echo (!empty($og_image))?$og_image:'';?>"/>
	<meta property="og:site_name" content="CEONPOINT"/>
	<meta property="fb:app_id" content="153607476069216"/>
	<meta property="og:description" content="<?php echo (!empty($og_description))?$og_description:'';?>"/>
	
	
	
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
	
    <meta charset="utf-8">
    <script>
        if ( /*@cc_on!@*/ false) { document.documentElement.className = 'ie10'; }
    </script>

    <!--<![endif]-->
    <link rel="shortcut icon" href="<?php echo ASSETS_URL.'images/favicon.png'; ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo ASSETS_URL.'images/favicon.png'; ?>" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ASSETS_URL.'css/font-awesome.min.css'; ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL.'css/bootstrap.min.css'; ?>" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL.'css/owl.carousel.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL.'css/style.css'; ?>">
    <script src="<?php echo ASSETS_URL.'js/jquery.min.js'; ?>"></script>
    <script src="<?php echo ASSETS_URL.'js/bootstrap.min.js'; ?>"></script>
	<link href="<?php echo ASSETS_URL.'css/bootstrap-multiselect.css'; ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo ASSETS_URL.'js/bootstrap-multiselect.js'; ?>"></script>
    
    <!-- limonte-sweetalert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .social-list-header{position:relative}.social-list-header-addspace{position:absolute;top:6px;left:84px;width:300px;color:#fff;border-radius:3px}.social-list-header-img{width:300px;height:50px}.social-list-header-img img{max-width:100%;border-radius:3px;width:100%;height:100%}.main-addspace-box{display:flex;margin-top:25px}.main-addspace-iner-box{padding:0 2px}.main-addspace-iner-box img{max-height:100%;max-width:100%;border-radius:3px}.main-addspace-iner-box h1{padding:0;margin:0;font-size:23px;color:#fff;line-height:1}.bottome-addspace-box{border-radius:3px;max-height:150px;width:100%;margin-bottom:50px}.bottome-addspace-box img{max-width:100%;max-height:100%;height:100%;border-radius:3px}.bottome-addspace-box h1{color:#fff;text-transform:capitalize;margin:0}.footer-add{display:flex;margin-bottom:25px}.footer-add-box h1{padding:0;margin:0;font-size:23px;color:#fff;line-height:1}.footer-add-box{background-color:#f25c32;width:100%;margin-right:10px;padding:14px;border-radius:3px}.dropdown.open .dropdown-menu:before{display:none}.dropdown-sub-menu li:first-child a{border:none;padding-top:15px}.dropdown.open .dropdown-sub-menu{background:#fbfbfb;position:absolute;left:220px;top:20px;margin-top:0}.nav .open>a,.nav .open>a:focus,.nav .open>a:hover{border-color:rgba(197,203,207,.25)}
    </style>
    <script type="text/javascript" src="<?php echo ASSETS_URL.'tinymce/jscripts/tiny_mce/tiny_mce.js';?>"></script>
    <!-- <script type="text/javascript" src="<?php echo ASSETS_URL.'tinymce/tinymce.min.js';?>"></script> -->
    <!-- <script type="text/javascript" src="/powerpaste2/dist/powerpaste/plugin.js"></script> -->
    <script type="text/javascript"> $(document).ready(function(){ jQuery(function () { tinymce.init({ selector: '.text_editor' }); }); });</script>
</head>

<body>
    <div class="header-strip">
        <?php 
        $bannerList = $this->user->get_active_banner_list();
        $current_country = $this->session->userdata('current_country');
        $contactinfo = $this->db->get_where('tbl_contact_info',array('id'=>1))->row_array();
        
        ?>
        <div class="container text-left">
            <div class="row flex-center">
                <div class="col-md-3 col-sm-4">
				    <?php   if(empty($current_country) || $current_country =="home"):
                            $href= site_url();
                        else:
                            $href= site_url('pages/country/').$this->session->userdata('current_country');
                        endif; ?>
                    <div class="site-logo__link">
                        <a href="<?php echo $href; ?>"><img src="<?php echo ASSETS_URL.'images/logo.png'; ?>" alt="logo" title="ceonpoint.com"></a>
                    </div>
                </div>
                <div class="col-md-9 col-sm-4">
                  <div class="d-flex align-items-center justify-content-end">
                  <div class="social-list-header head-social-icons">
                       <!-- <a href="<?=base_url('pages/cpAauthor'); ?>" class="btn register text-uppercase border-btn">Become a CPD Author</a> -->
                       <a href="#">
                           <img src="<?php echo ASSETS_URL.'images/facebook.png'; ?>" title="ceonpoint on facebook">
                       </a>
                       <a href="#">
                           <img src="<?php echo ASSETS_URL.'images/youtube.png'; ?>" title="ceonpoint on youtube">
                       </a>
                       <a href="#">
                           <img src="<?php echo ASSETS_URL.'images/skype.png'; ?>" title="ceonpoint on skype">
                       </a>
                       <a href="#">
                           <img src="<?php echo ASSETS_URL.'images/whatsapp.png'; ?>" title="ceonpoint on whatsapp">
                       </a>
                 
                    <div class="header-register icons-header">
                        <ul class="dt-sc-default-login">
                            <?php if(empty($this->session->userdata('logged_in'))){ ?>
                                <!-- <li><a href="javascript:void(0);" onclick="mobile_app_popup()" class="lgn" title="Login"><i class="fa fa-user"></i>Login</a> -->
                                <li><a href="<?php echo base_url('users'); ?>" class="lgn" title="Login"><i class="fa fa-user"></i>Login</a>
                                    
                                </li>
                                <li><a href="javascript:void(0);" onclick="register_now()" title="Register Now" class="register">Sign Up</a></li>
                            <?php } else { 
                                $role = $this->session->userdata('logged_in')['role'];
                                $uins = $this->session->userdata('logged_in')['under_insititution'];   
                                if($role==1){
                                    $cont = "professional/dashboard";
                                }
                                elseif($role == 2){  
                                        $cont = "provider/index"; 
                                    // if($uins==0){ 
                                    //     $cont = "provider/dashboard"; 
                                    // }else{ 
                                    //     $cont = "provider/set_target"; 
                                    // }      
                                }
                                else if($role==5){
                                    if($uins==0){
                                        $cont = "institution/editwebpage";
                                    }else{
                                        $cont = "institution/settarget";
                                    }
                                }
                                else if($role==6){
                                    $cont = "author";
                                }
                                else if($role==7){
                                    $cont = "rboard/subscription_package";
                                }
                                else if($role==10){
                                    $cont = "admin/dashboard";
                                } else if($role==4){
                                    $cont = "advertise/advertise";
                                } ?>
                            <li><a href="<?php echo BASE_URL.$cont;?>" class="lgn mr-2" title="My Account"><i class="fa fa-user"></i> My Account</a>
                            <a href="<?php echo BASE_URL?>users/logout" class="register" title="Logout">Logout</a></li>
                            <?php   } ?>
                            
                        </ul>
                    </div>
               
               <div class="social-list-header-addspace">
               <?php  $topbanner = $this->advertiseads->getAdvertiserBanner('Top Menu');
                 if(count($topbanner))
                 {
                   foreach($topbanner as $banner)
                   {
                   $this->advertiseads->updateCount($banner['id']); ?>
               <a target="_blank" href="<?php if($banner['website_url']){ echo $banner['website_url'];}else{ echo "#";}?>">
               <div class="item">
                   <div class="social-list-header-img">
                       <img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image']; ?>" alt="" title="ceon-main-banner">
                   </div>
               </div>
               </a>
               <?php break; }
                     }else{ ?>
                   
               <?php  } ?>
               </div>
           </div>
                  </div>
                </div>
            </div>   
        </div>
    </div>

    <header id="header">
        <div class="container">
            <div class="logo"><a href="<?php echo BASE_URL;?>"><img src="<?php echo ASSETS_URL; ?>images/logo.png" alt="logo" title="ceon-logo"></a></div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#myNavbar">
                    <i class="fa fa-bars"></i> Menu
                </button>
            </div>
            
            <nav class="navbar">
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav mr-auto">
                        <li><?php if(empty($current_country) || $current_country =="home"){ ?>
                                <a href="<?php echo site_url();?>">Home</a>
                            <?php } else{ ?>
                                <a href="<?php echo site_url('pages/country/').$this->session->userdata('current_country');?>">Home</a>
                            <?php }?>
                        </li>
                    	<!-- <li class="dropdown training-manu">
                        	<a href="<?php echo site_url('pages/courses/');?>">Online Course</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                               <li><a href="<?php echo site_url('pages/ocms/').$this->uri->segment(3);?>">Online Course Management Software <br>(OCMS)</a></li>
	                        </ul>
                        </li> -->
                        <!-- <li class="dropdown training-manu">
                        	<a href="<?php echo site_url('pages/training');?>">Training</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                               <li><a href="<?php echo site_url('pages/training_management/').$this->uri->segment(3);?>">Training Management <br> System (TMS)</a></li>
	                        </ul>
                        </li> -->
						<!-- <li class="dropdown institutions-manu">
							<a href="<?php echo site_url('pages/Institutionspage');?>">Institutions</a>    
						    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						        <li>
						            <a href="<?php echo site_url('pages/InstitutionCEPlatform/').$this->uri->segment(3);?>">Institution Continuing Education Online Platform<br> (ICE Online Platform)</a>
						        </li>
						    </ul>
                        </li> -->
                        
                        <li class="dropdown institutions-manu">
							<a href="<?php echo site_url('pages/ceprovider');?>">Insurance Companies</a>   
						    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						        <!-- <li><a href="<?php echo site_url('pages/ceprovideplateform/').$this->uri->segment(3);?>">Continuing Education Provider Platform<br> (CEP Platform)</a></li> -->
                                <li><a href="<?php echo site_url('pages/authors');?>">Brokers</a></li>
                                <!-- <li><a href="<?php echo site_url('pages/cpAauthor');?>">Become a CPD Author</a></li> -->
						    </ul>
                        </li>
                        
                        <li>
							<a href="<?php echo site_url('pages/ceprovider');?>">Car Company</a>   
                        </li>
                          <!-- <li class="dropdown institutions-manu">
                                <a href="<?php echo site_url('pages/latestprofessional');?>">Car Owner</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a href="<?php echo site_url('pages/cetracker/').$this->uri->segment(3);?>">Professional Continuing Education Platform <br>(PCE Platform)</a></li>
                                </ul> 
                            </li>-->
                        <!-- <li class="dropdown institutions-manu">
							<a href="<?php echo site_url('pages/rboards');?>">RBoard</a>
						    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						        <li><a href="<?php echo site_url('rboard');?>">Professional Regulatory Board Platform</a></li>
						    </ul>
						</li> -->
                        
                        <li class="dropdown">
							<a class="dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Pages</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a href="<?php echo site_url('pages/cfvalidation/').$this->uri->segment(3);?>">Insurance Validation</a></li>
								<li><a href="<?php echo site_url('pages/faq');?>">Support</a></li>
								<li><a href="<?php echo site_url('pages/blog');?>">News/Blog</a></li>
								<li><a href="<?php echo site_url('pages/aboutus');?>">About Us</a></li>
                                <li><a href="<?php echo site_url('pages/contactus');?>">Contact Us</a></li>
								<!-- <li><a href="<?php echo site_url('pages/advertise');?>">Advertise</a></li> -->
								<li><a href="<?php echo site_url('pages/terms');?>">Terms</a></li>
							</ul>
						</li>
                    </ul>
                </div>
                <div class="current_page_item">
        <?php 
                $idd1 = $this->session->userdata('current_country');
                $cuntry1 = $this->db->get_where('countries',array('countries_id'=>$idd1,'display'=>'Yes'))->row_array(); 
                $cuntry13 = $this->db->get_where('countries',array('display'=>'Yes'))->result_array(); 
				
                $cnt = strtolower($cuntry1['countries_iso_code']); ?>
				
                    <!-- <?php if($idd1 == "home" || $idd1 == ""){ ?>
                    <span>
                        <img src="<?php echo ASSETS_URL; ?>country_icon/gloab.png" title="ceon-ct-global">
                    </span> <?php } else { ?>
                    <span>
                        <img src="<?php echo ASSETS_URL; ?>country_icon/<?php echo $cnt.'.png'; ?>" title="ceon-ct">
                    </span> 
                    <?php } ?> -->
                    <!-- <select name="countrylist" id="countrylist" class="form-control countrylist" onchange="filter(this)">
                        <option value="home" <?php if($idd1 == 'home'){ echo "selected" ;} ?>>International</option>
						<?php foreach( $cuntry13 as $c ){ ?>
                        <option value="<?=$c['countries_id']?>" <?php if($idd1==$c['countries_id']){ echo "selected" ;} ?>><?=$c['countries_name']?></option>
						<?php } ?>
                    </select> -->
                </div>
            </nav>
        </div>
    </header>

    <?php if($this->uri->segment(1)==""){  ?>
        <div class="banner-slider">
            <?php 
            if(count($bannerList) > 0){ 
                foreach($bannerList as $topbanr){
                    if(file_exists('./assets/images/banner/'.$topbanr->banner)){
                        $bannerlink = ($topbanr->url !="")?$topbanr->url:'javascript:void(0);';
                        echo '<a href="'.$bannerlink.'"><div class="item">
                            <div id="banner-grid" class="banner-grid py-0">
                                <img src="'.base_url('assets/images/banner/'.$topbanr->banner).'" width="100%">
                                <div class="container">
                                <div class="banner-content text-white text-uppercase">'; ?>
                                <div class="row">
                                    <div class="col-md-8">
                                        <?php echo'<h1><b><span style="font-size:85px;">'.$topbanr->title.' :</span> 
                                        <br>'.$topbanr->sub_title.'</b></h1>'; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="h2 text-white">Search Car Insurance</div>
                                        <form class="banner_form" action="#" method="get">
                                        <div class="form-group">
                                            <label>Type of Insurance</label>
                                            <select class="form-control" name="type">
                                            <option value="">Type of Insurance:</option>
                                            <option value="1">Comprehensive</option>
                                            <option value="0">Third Party</option>
                                            </select> 
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Price Range</label>
                                            <select class="form-control" name="price">
                                                <option value="">Price Range:</option>
                                                <option value="lt10">Less than $10</option>
                                                <option value="gt10">Greater than $10</option>
                                            </select> 
                                        </div>
                                        <div class="form-group">
                                            <label>Insurance Company</label>
                                            <select class="form-control" name="insurance_company">
                                                <option  value="">Insurance Comapany:</option>
                                                <?php if(isset($company)):
                                                    foreach($company as $comp): ?>
                                                    <option value="<?=$comp['id']; ?>"><?=$comp['name']; ?></option>
                                                <?php endforeach; endif; ?>
                                            </select> 
                                        </div>
                                            
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Search</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            <?php echo '</div>
                                </div>
                            </div>
                        </div></a>';
                    }	
                }
            }else{ ?>
            <a href="">
                <div class="item">
                    <div id="banner-grid" class="banner-grid py-0">
                        <img src="<?php echo ASSETS_URL; ?>images/home-banner1.png" width="100%">
                        <div class="banner-content text-white text-uppercase">
                            <h1>Your Text <br> <strong>Here</h1>
                        </div>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="item">
                    <div id="banner-grid" class="banner-grid py-0">
                        <img src="<?php echo ASSETS_URL; ?>images/home-banner1.png" width="100%">
                        <div class="banner-content text-white text-uppercase">
                            <h1>Your Text <br> <strong>Here</h1>
                        </div>
                    </div>
                </div>
            </a>

            <?php } ?>
        </div>
    
    <?php } ?>

    <!-- Modal -->
    <div id="myModalcertificate" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button onclick="myFunction()" style="float: left;" type="button" title="Print"><i class="fa fa-print"></i></button>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Certificate</h4>
                </div>
                <div class="modal-body">
                    <div id="filteredData22"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="uploadcertificates" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Certificate</h4>
                </div>
                <?php 
            if($this->session->userdata('logged_in')['role']==1){
                ?>
                <form action="<?php echo BASE_URL;?>professional/existing" method="post" enctype="multipart/form-data" name="existing" id="existing">
                    <div class="modal-body">
                        <input type="hidden" name="certi_popup" id="certi_popup" value="1">
                        <p>
                            <label>Certificate No </label>
                            <input name="certi_no" value="" size="20" type="text" palaceholder="Enter certificate number" class="form-control">
                            <span class="error">
                                <?php echo  form_error('certi_no'); ?></span>
                        </p>
                        <p>
                            <label>Course Title <span class="required text-danger"> * </span> </label>
                            <input name="course_name" value="" size="20" type="text" class="form-control" placeholder="Enter course name" required>
                            <span class="error">
                                <?php echo  form_error('course_name'); ?></span>
                        </p>
                        <p>
                            <label>Course Units <span class="required text-danger"> * </span> </label>
                            <input name="course_unit" value="" size="20" type="text" class="form-control" placeholder="Enter course unit" required>
                            <span class="error">
                                <?php echo  form_error('course_unit'); ?></span>
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <label>Date Issued <span class="required text-danger"> * </span> </label>
                                    <input name="course_start_date" value="" size="20" type="date" class="form-control" required>
                                    <span class="error">
                                        <?php echo  form_error('course_start_date'); ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    <label>Category<span class="required text-danger"> * </span> </label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="" selected>Please Select</option>
                                        <option value="general">General</option>
                                        <option value="specific">Specific</option>
                                    </select>
                                    <span class="error">
                                        <?php echo  form_error('category'); ?></span>
                                </p>
                            </div>
                        </div>
						
						
                        <p>
                            <label>Certificate <span class="required text-danger"> * </span> </label>
                            <input name="certificate" value="" size="20" type="file" class="form-control" required>
                            <span class="error">
                                <?php echo  form_error('certificate'); ?></span>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-primary" value="SAVE" type="submit" name="save">
                    </div>
                </form>
                <?php } else { ?>
                <div class="modal-body">
                    <p>Please login as a professional to upload certificate.</p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="confirmpopups" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Course/Training</h4>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <?php 
                if($this->session->userdata('logged_in')['role']==2){
                    ?>
                    <a href="<?php echo site_url('provider/overview'); ?>">
                        <input class="btn btn-primary" value="Upload Course" type="submit">
                    </a>
                    &nbsp;&nbsp;
                    <a href="<?php echo site_url('provider/training_center'); ?>">
                        <input class="btn btn-primary" value="Upload Training" type="submit">
                    </a>
                    <?php 
                } else {
                    ?>
                    <p>Please login as a provider to upload course & Training.</p>
                    <?php 
                }
                ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="loginform" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="logo-model">
                        <a href="<?php echo BASE_URL?>">
                            <img src="<?php echo ASSETS_URL.'images/model-logo.png';?>" alt="logo"  title="ceon-modal-logo">
                        </a>
                    </div>
                    <h4 class="modal-title">Please Login or Register before Uploading certifiacte</h4>
                </div>
                <form action="<?php echo BASE_URL;?>users" method="post" enctype="multipart/form-data" name="users" id="users" autocomplete="off">
                    <?php echo $this->session->flashdata('response');?>
                    <div class="modal-body">
                        <p>
                            <label>Username/Email <span class="required text-danger"> * </span> </label>
                            <input name="username" value="" size="20" type="text" placeholder="Enter username" class="form-control" required>
                            <span class="error">
                                <?php echo  form_error('username'); ?></span>
                        </p>
                        <p>
                            <label>Password <span class="required text-danger"> * </span> </label>
                            <input name="password" value="" size="20" type="password" placeholder="*******"class="form-control" required>
                            <span class="error">
                                <?php echo  form_error('password'); ?></span>
                        </p>
                        <input type="hidden" name="popups" id="popups">
                    </div>
                    <div class="modal-footer">
                        <p class="text-right">
                            <span class="pull-left register">No Account Yet? <a href="<?php echo site_url('users/signup/professional'); ?>">Sign Up</a></span>
                            <a href="<?php echo site_url('users/forgotpassword'); ?>">Forgot Password</a></p>
                        <input class="btn btn-primary" value="LOGIN" type="submit" name="save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="thankspopup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thank you for uploading certificate</h4>
                </div>
                <form action="<?php echo BASE_URL;?>users" method="post" enctype="multipart/form-data" name="users1" id="users1" autocomplete="off">
                    <?php echo $this->session->flashdata('response');?>
                    <div class="modal-body">
                        <p>
                            <div class="row">
                                <h4 class="modal-title text-center mb-5">1 Certificate <br>added successfully to your lists.</h4>
                                <div class="professionals-banner">
                                    <div class="row banner-count-desc">
                                        <div class="col-xs-3 text-center item">
                                            <div class="icon-container" style="background:#275bf4">120 <span>Units</span></div>
                                            <h2>Required Units for Renewal</h2>
                                        </div>
                                        <div class="col-xs-3 text-center item">
                                            <div class="icon-container">107 <span>Units</span></div>
                                            <h2>Total Units Obtained</h2>
                                        </div>
                                        <div class="col-xs-3 text-center item">
                                            <div class="icon-container" style="background:#a80693">13 <span>Units</span></div>
                                            <h2>CPD Units Balance</h2>
                                        </div>
                                        <div class="col-xs-3 text-center item">
                                            <div class="icon-container" style="background: #43c300; width: auto; line-height: 22px; font-size: 17px; padding: 0 10px;">
                                                On <br> Completion</div>
                                            <h2>Status</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </p>
                        <p class="center view-certificate">
                            <a href="<?php echo site_url('professional/dashboard'); ?>">Click Here</a><br> to View All your certificates!
                        </p>
                        <p class="Upload-Certificate center">
                            <a href="javascript:void(0);" onclick="uploadcertificatepopup();">Upload Certificate</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div id="register_nows" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align: center;">Sign Up</h4>
                </div>
                <div class="modal-body">
                    <div id="filteredData2211">
                    	
                   <div class="row signup-features d-flex">
                     <div class="col-md-3">
                        <div class="professionals-icons">
							
                            <a href="<?php echo site_url('users/signup/professional'); ?>">
                            <figure>
                                <img class="register_pro" src="https://www.shareicon.net/data/512x512/2015/09/15/641035_man_512x512.png"  title="Car Owner">
                            </figure>
                            <!-- <i class="fa fa-graduation-cap" aria-hidden="true"></i> -->
                            <span>Car Owner</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="professionals-icons">
                            <a href="<?php echo site_url('users/signup/provider'); ?>">
                            <figure>
                            <img class="register_pro" src="https://w7.pngwing.com/pngs/240/672/png-transparent-car-vehicle-insurance-insurance-policy-life-insurance-insurance-text-logo-monochrome-thumbnail.png"  title="Insurance Company">
                            </figure>
                            <!-- <i class="fa fa-graduation-cap" aria-hidden="true"></i> -->
                            <span>Insurance Company</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="professionals-icons">
                            <a href="<?php echo site_url('users/signup/authors'); ?>">
                            <figure>
                            <img class="register_pro" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTpPwUwBc7D6SN2XbhDq1tj8-i-7Q8YC1RSHg&usqp=CAU"  title="Car Business Owner">
                            </figure>
                            <!-- <i class="fa fa-graduation-cap" aria-hidden="true"></i> -->
                            <span>Broker</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="professionals-icons">
                            <a href="<?php echo site_url('users/signup/author'); ?>">
                            <figure>
                            <img class="register_pro" src="https://cdn3.iconfinder.com/data/icons/land-personal-vehicles/443/personal-transportation-005-512.png"  title="Car Business Owner">
                            </figure>
                            <!-- <i class="fa fa-graduation-cap" aria-hidden="true"></i> -->
                            <span>Car Business Owner</span>
                            </a>
                        </div>
                    </div>
              
                   	 
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="homepopup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align: center;">ADD CE UNIT OR CONTACT HOURS</h4>
                </div>
                <div class="modal-body">
                      <div class="row">
                <div class="col-md-3">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/courses'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/online.jpg'); ?>" alt="Online Courses"  title="ceon-online-courses">
                            </div>
                            <div class="online-text-pop">
                                <p>ONLINE <br>COURSE</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/training'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/traning.jpg'); ?>" alt="Training" title="ceon-training">
                            </div>
                            <div class="online-text-pop">
                                <p>TRAINING/<br>SEMINARS</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="online-box">
                       
                        <a href="javascript:void(0)" onclick="checklogin();" style="text-decoration: none;">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/certificates.jpg'); ?>" alt="Certificates" title="ceon-certificate">
                            </div>
                            <div class="online-text-pop">
                                <p>UPLOAD <br>CERTIFICATES</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/Institutionspage'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/institute.jpg'); ?>" alt="Institutes" title="ceon-institution">
                            </div>
                            <div class="online-text-pop">
                                <p>INSTITUTION <br>CE WEBPAGE</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>  
                </div>
            </div>
        </div>
</div>

<div id="uploadCertificateModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Certificate</h4>
            </div>



              <form action="<?php echo BASE_URL;?>professional/existing" method="post" enctype="multipart/form-data" name="existing1" id="existing1">
                <div class="modal-body"> 

                    <p>
                        <label>Certificate No </label>
                        <input name="certi_no" value="" size="20" type="text" placeholder="Enter certificate number" class="form-control">
                        <span class="error"><?php echo  form_error('certi_no'); ?></span>
                    </p>
                    <p>
                        <label>Course Title <span class="required text-danger"> * </span> </label>
                        <input name="course_name" value="" size="20" type="text" class="form-control" placeholder="Enter course name" required>
                        <span class="error"><?php echo  form_error('course_name'); ?></span>
                    </p>
                    <p>
                        <label>Course Units <span class="required text-danger"> * </span> </label>
                        <input name="course_unit" value="" size="20" type="number" class="form-control" placeholder="Enter course unit" required>
                        <span class="error"><?php echo  form_error('course_unit'); ?></span>
                    </p>

                    <div class="row">
                        <div class="col-md-12">
                            <p>
                                <label>Date Issued <span class="required text-danger"> * </span> </label>
                                <input name="course_start_date" value="" max="<?php echo date('Y-m-d')?>" type="date" class="form-control" required>
                                <span class="error"><?php echo  form_error('course_start_date'); ?></span>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <label>Category</label>
                                <select name="category" id="category1" class="form-control">
                                    <option value="" selected>Please Select</option>
                                    <option value="general">General</option>
                                    <option value="specific">Specific</option>
                                </select>
                                <span class="error"><?php echo  form_error('category'); ?></span>
                            </p>
                        </div>
						 <div class="col-md-6">
                            <p>
                                <label>Issued From<span class="required text-danger"> * </span> </label>
                                <select name="issue_from" id="issue_from" class="form-control" required>
                                    <option value="" selected>Please Select</option>
                                    <option value="Online Course">Online Course</option>
                                    <option value="Training">Training</option>
                                </select>
                                <span class="error"><?php echo  form_error('issue_from'); ?></span>
                            </p>
                        </div>
                    </div>
					
					<div class="row">
                        <div class="col-md-6">
                            <p>
                                <label>Issued By<span class="required text-danger"> * </span> </label>
                                <input name="issue_by" value=""  type="text" class="form-control" placeholder="Enter issued by" required>

                                <span class="error"><?php echo  form_error('issue_by'); ?></span>
                            </p>
                        </div>
						 <div class="col-md-6">
                             <p>
                        <label>Certificate <span class="required text-danger"> * </span> </label>
                        <input name="certificate" value="" size="20" type="file" class="form-control" required>
                        <span class="error"><?php echo  form_error('certificate'); ?></span>
                    </p>
                        </div>
                    </div>
					
                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" value="SAVE" type="submit" name="save">
                </div>
            </form>
        </div>
    </div>
</div>



<div id="alertpupop" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Alert</h4>
            </div>
                <div class="modal-body"> 
				<p>Please log-in or Sign Up as a <b> professional </b> to store your certificate in your account</p>
                  
				  <div class="logincheck">
				  <a href="<?php echo BASE_URL?>users" class="btn btn-primary" title="Login">Login</a>
                                      
                  <a href="javascript:void(0);" onclick="register_now()" title="Register Now" class="btn btn-success">Sign Up</a>  
                </div>
                </div>
                <div class="modal-footer">
				
                </div>
        </div>
    </div>
</div>

<div id="mobileAppPop" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close pumAfterClose" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">MOBILE APP DOWNLOAD</h4>
            </div>
                <div class="modal-body"> 
                    <a href="<?php echo BASE_URL.'';?>">
                        <img src="<?php echo ASSETS_URL.'/images/mobile_app_pop_up.png';?>" alt="" title="ceon-mobile-popup">
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pumAfterClose" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    jQuery('#mobileAppPop').on('click','.pumAfterClose', function () {
        window.location.href = "<?php echo BASE_URL.'users'; ?>";
    });
    function redirect(){
        var path = "<?php echo site_url('pages/courses/');?>"; 
        var dropDownValue = document.getElementById("dropDown").value;
        window.location.href = path+dropDownValue;
    }

    function filter(data) {

    	var path = "<?php echo site_url('pages/country'); ?>";
    	// var idd = $(".countrylist").val();	
        // alert(data);			
    	var idd = data.value;	
    	$(".countrylist").attr("disabled",true);				
            $.get( path + "/" + idd, function( data ) {
                $(".result").html( data );
                if (idd == "home") {
                    window.location = "<?php echo site_url(); ?>";
                } else {
                    window.location = path + "/" + idd;
                }
            });
    }
            
    function checklogin(){
    <?php if(isset($_SESSION['logged_in']) &&  $_SESSION['logged_in']['role']==1){ ?>	
    		$('#uploadCertificateModal').modal('show');
    			$('#homepopup').modal('hide');
                $("#upgradesuccess").modal('hide');
    	<?php }else{ ?>
    		 $('#alertpupop').modal('show');
    		 $('#homepopup').modal('hide');
    	<?php } ?>
    }

    function homepopup(){
       $('#alertpupop').modal('hide');
      $('#homepopup').modal('show');
      return false;
    }

    function model(){
      $('#uploadcertificates').modal('show');  
    }

    function certifiacte() {
    	//alert("caloing");
    	var certifiacte_no = $('#certifiacte_no').val();
    	if (certifiacte_no == "") {
    		document.getElementById('certifiacte_no').style.border = '1px solid #F00';
    		return false;
    	}
    	$('#myModalcertificate').modal('show');
    	$('#certi_button').text('Verify & Download');
    	if (certifiacte_no == "") {
    		return false;
    	} else {
    		$('#certi_button').text('Please wait...');
    		$.ajax({
    			type: "POST",
    			url: '<?php echo base_url()."users/certificate_download";?>',
    			data: { certifiacte_no: certifiacte_no }
    		}).done(function(result) {
    			$('#certi_button').text('Verify & Download');
    			$("#filteredData22").html(result);
    		});
    		return false;
    	}
    }

    // $( document ).ready(function($){
    //     $('.dropdown-menu a.dropdown-toggle').on('hover', function(e) {
    //       if (!$(this).next().hasClass('show')) {
    //         $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    //       }
    //       var $subMenu = $(this).next(".dropdown-menu");
    //       $subMenu.toggleClass('show');

    //       $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    //         $('.dropdown-submenu .show').removeClass("show");
    //       });

    //       return false;
    //     });
    // });
    function register_now(){
      $('#alertpupop').modal('hide');
      $('#register_nows').modal('show');
      return false;
    }

    function mobile_app_popup(){
      $('#mobileAppPop').modal('show');
      return false;
    }

    var pop = '<?php if($_REQUEST['p']==1){ ?>'+ uploadcertificatepopup(); + '<?php } ?>';
    var co = '<?php if($_REQUEST['p']==2){ ?>'+  uploadcourse(); + '<?php } ?>';
    var ppp = '<?php if($_REQUEST['p']==3){ ?>'+ $('#uploadcertificates').modal('hide'); $('#thankspopup').modal('show'); + '<?php } ?>';
    var register = '<?php if($_REQUEST['register']==1){ ?>'+  register_now(); + '<?php } ?>';

    </script>

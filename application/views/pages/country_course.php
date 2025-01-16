<?php   $current_country = $this->session->userdata('current_country');
        // $countryData = $this->db->get_where('countries',array('countries_id'=>$this->uri->segment(3)))->row_array(); 
        $countryData = $this->db->get_where('countries',array('countries_id'=>$country_id))->row_array(); ?>

             
<?php if($countryData['banner_image'] !=""){ ?>
<div class="country-banner" style="background-image:url('<?php echo ASSETS_URL.'upload/country/'.$countryData['banner_image']; ?>');">
<?php } else { ?>
<div class="country-banner" style="background-image:url('<?php echo ASSETS_URL.'upload/default.png'; ?>">
<?php } ?>




    <div class="container">
        <div class="country-caption">
            <h2><?php echo $countryData['hedding']; ?></h2>
            <h4><?php echo $countryData['sub_hedding']; ?></h4>
            <div class="btn-group-contry slider-search">
                <div class="video-icon-popup">
                    <a href="#" data-toggle="modal" data-target="#videoModal" data-theVideo="http://www.youtube.com/embed/loFtozxZG0s"><i class="fa fa-play" aria-hidden="true"></i></a>
                    
                </div>
                <a href="javascript:void(0);" onclick="homepopup();" class="btn btn-primary">ADD CE UNIT OR CONTACT HOURS</a>
                <!-- <a href="javascript:void(0);" onclick="uploadcertificatepopup();" class="btn btn-default upload-cer">UPLOAD CERTIFICATE</a>
                <div class="header-searchPart">
                    <form class="searchform">
                        <div class="selection-box">
                            <select name="searchtype" class="form-control" id="dropDown" onchange="redirect();">
                                <option value="" selected="">Find Courses: Choose Profession</option>
                                <option value="7">Accountancy</option>
                                <option value="17"> Aeronautical Engineering</option>
                            </select>
                        </div>
                    </form>
                </div> -->
                <div class="attr-camera">
                    <a target="_blank" href="<?php echo isset($countryData['link'])?$countryData['link']:'#'; ?>" title="<?php echo $countryData['name']; ?>"><i class="fa fa-camera" aria-hidden="true"></i> 
                    <span><?php echo $countryData['name']; ?></span><br />
                    <span><b><?php echo $countryData['photo_owner']; ?></b></span>
                </a>
                </div>
            </div>
        </div>
    </div>
    
  
</div>

 
<!-- Old Data -->
<!-- 
<div class="service-process" style="background: #e5e5e5;">

    <div class="container">

        <div class="row">

            <div class="col-sm-4 item">
                <div class="home-icon-certificate">
                    <img src="<?php echo ASSETS_URL.'images/home-cartificate.png'; ?>">
                </div>
                <div class="item-content">
                    <h3>Digital Certificate Storage</h3>
                    <p>Store unlimited digital & non-digital Certificates from your Online courses or training.</p>
                </div>
            </div>

            <div class="col-sm-4 item home-icon">
                <div class="home-icon-search">
                    <img src="<?php echo ASSETS_URL.'images/home-search.png'; ?>">
                </div>
                <div class="item-content">
                    <h3>CE Units Tracker</h3>
                    <p>Keep you updated of your Required, Obtained & Needed CE Units for License renewal or Performance appraisal.</p>
                </div>
            </div>

            <div class="col-sm-4 item">
                <div class="home-icon-message">
                    <img src="<?php echo ASSETS_URL.'images/home-message.png'; ?>">
                </div>
                <div class="item-content">
                    <h3>Electronic Reporting</h3>
                    <p>Report Directly your certificates To your regulatory board and Employer </p>
                </div>
            </div>
        </div>

    </div>

</div> -->

<div class="service-process" style=" background: #e5e5e5;">
    <div class="container">

        <div class="row">

            <div class="col-sm-4 d-flex">
                <div class="service-icons">
                    <img src="<?php echo ASSETS_URL.'images/home-cartificate.png'; ?>">
                    <!-- <i class="fa fa-graduation-cap"></i>  -->
                </div>
                <div class="item-content">
                    <h3>2,043 <br>
                        Digital Certificates Issued
                    </h3>
                    <!-- <p>(Fetch the data form admin Certificate listing)</p> -->
                </div>
            </div>

            <div class="col-sm-4 d-flex">
                <div class="service-icons">
                    <img src="<?php echo ASSETS_URL.'images/registered.png'; ?>">
                    <!-- <i class="fa fa-graduation-cap"></i>  -->
                </div>
                <div class="item-content">
                    <h3>1,212 <br>
                        Professionals Registered
                    </h3>
                    <!-- <p>(Fetch the data from admin Professional listing)</p> -->
                </div>
            </div>

            <div class="col-sm-4 d-flex">
                <div class="service-icons">
                    <img src="<?php echo ASSETS_URL.'images/countries.png'; ?>">
                    <!-- <i class="fa fa-graduation-cap"></i>  -->
                </div>
                <div class="item-content">
                    <h3>10 <br>
                        Countries Reached
                    </h3>
                    <!-- <p>(Fetch the data from the Database-there is none at the admin)</p> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <section class="main-addspace">
        <div class="container">
            <div class="main-addspace-box">
        <?php if(!empty($current_country)){$this->db->where('tbl_adv_package_purchased.country',$current_country);}
                $topbanner = $this->advertiseads->getAdvertiserBanner('Top Body');  
                // print_r($topbanner);die;                 
                          if(count($topbanner))
                           {
                               $i=1;
                              foreach($topbanner as $banner)
                              {
                                  if($i>4)
                                  {
                                      break;
                                  }
                                   $i++;
                                   
                                   $this->advertiseads->updateCount($banner['id']);
                                  $size=explode('x',$banner['size']);
                                  ?>
                                    <div class="item">
                                    
                                            <div class="main-addspace-iner-box">
                                                <a href="<?php if($banner['website_url']){ echo $banner['website_url'];}else{ echo "#";}?>"><img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image']; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" alt=""></a>
                                            </div>
                                    
                                    </div>
                            <?php                           
                                 
                              }
                           }else
                           {
                               ?>
                <a href="#"> <div class="item">
                   <div class="main-addspace-iner-box">
                        <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                   </div>
                </div>
                 </a> <a href="#"> <div class="item">
                   <div class="main-addspace-iner-box">
                        <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                   </div>
                </div>
                 </a> <a href="#"> <div class="item">
                   <div class="main-addspace-iner-box">
                        <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                   </div>
                </div>
                 </a> <a href="#"> <div class="item">
                   <div class="main-addspace-iner-box">
                        <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                   </div>
                </div>
                 </a>
                <?php
                           }
                ?>
            </div>

        </div>
</section> -->

    <div class="weOffer">
        <div class="container">
        <!--  <div class="row">
            <h1 class="border-title text-center text-uppercase mb-0 pb-0">products and services we OFFER</h1>
            <h4 class="mb-5 text-center">We specialize in continuing education platforms.</h4>
            <div class="owl-carousel-3 nav-button">
            <div class="item">
                <div class="jet-banner-wrapper">
                     <a href="<?php echo base_url()?>pages/cetracker"> 
                        <img src="<?php echo ASSETS_URL.'images/offer-1.jpg'; ?>" alt="PCE-MS" class="jet-banner_img">
                        <div class="jet-banner_content ">
                            <h5 class="jet-banner_title text-uppercase">PCE Platform</h5>
                            <div class="jet-banner_text">Professional Continuing Education (PCE) Platform</div>
                        </div>
                     </a> 
                </div>
                <ul class="jet-banner_list mb-3">
                    <li>Global access to CE courses</li>
                    <li>Access to Institution CE courses</li>
                    <li>PCE- Management Software</li>
                    <li>Professional Webpage</li>
                    <li>Mobile app</li>
                </ul>
                <a href="<?php echo base_url()?>pages/cetracker" class="btn btn-primary">Learn More</a>
            </div>
            <div class="item">
                <div class="jet-banner-wrapper">
                     <a href="<?php echo base_url()?>pages/InstitutionCEPlatform"> 
                        <img src="<?php echo ASSETS_URL.'images/offer-2.jpg'; ?>" alt="ICE-MS" class="jet-banner_img">
                        <div class="jet-banner_content ">
                            <h5 class="jet-banner_title text-uppercase">ICE Platform</h5>
                            <div class="jet-banner_text">Institution Continuing Education (ICE) Platform</div>
                        </div>
                     </a>
                </div>
                <ul class="jet-banner_list mb-3">
                    <li>ICE- Management Software</li>
                    <li>ICE Webpage</li>
                    <li>Mobile app</li>
                </ul>
                <a href="<?php echo base_url()?>pages/InstitutionCEPlatform" class="btn btn-primary">Learn More</a>
            </div>
            <div class="item">
                <div class="jet-banner-wrapper">
                     <a href="<?php echo base_url()?>pages/ceprovideplateform"> 
                        <img src="<?php echo ASSETS_URL.'images/offer-3.jpg'; ?>" alt="CEP-MS" class="jet-banner_img">
                        <div class="jet-banner_content ">
                            <h5 class="jet-banner_title text-uppercase">CEP Platform</h5>
                            <div class="jet-banner_text">Continuing Education Provider Platform</div>
                        </div>
                     </a> 
                </div>
                <ul class="jet-banner_list mb-3">
                    <li>CEP- Management Software</li>
                    <li>CEP Webpage</li>
                    <li>Local & global exposure of your online courses</li>
                    <li>Mobile app</li>
                    <li>Passive income</li>
                </ul>
                <a href="<?php echo base_url()?>pages/ceprovideplateform" class="btn btn-primary">Learn More</a>
            </div>
            <div class="item">
                <div class="jet-banner-wrapper">
                     <a href="<?php echo base_url()?>pages/training_management"> 
                        <img src="<?php echo ASSETS_URL.'images/offer-4.jpg'; ?>" alt="TMS" class="jet-banner_img">
                        <div class="jet-banner_content ">
                            <h5 class="jet-banner_title">TMS</h5>
                            <div class="jet-banner_text">Training Management Software</div>
                        </div>
                     </a> 
                </div>
                <ul class="jet-banner_list mb-3">
                    <li>Instant training webpage</li>
                    <li>Digital invitation to social media</li>
                    <li>Verifiable Digital Certificate</li>
                    <li>Online registration & payment</li>
                    <li>Online training evaluation</li>
                    <li>Printable training report</li>
                    <li>Training sponsors section</li>
                    <li>And more</li>
                </ul>
                <a href="<?php echo base_url()?>pages/training_management" class="btn btn-primary">Learn More</a>
            </div>
            <div class="item">
                <div class="jet-banner-wrapper">
                     <a href="<?php echo base_url()?>pages/cfvalidation"> 
                        <img src="<?php echo ASSETS_URL.'images/offer-5.jpg'; ?>" alt="TMS" class="jet-banner_img">
                        <div class="jet-banner_content ">
                            <h5 class="jet-banner_title">DCS</h5>
                            <div class="jet-banner_text">Digital Certificate Software</div>
                        </div>
                     </a> 
                </div>
                <ul class="jet-banner_list mb-3">
                    <li>Digitalize your certificatesto be issued to recipientsby creating a CEP account orInstitution account.</li>
                    <li>Online verification of digitalcertificates here at :<a href="https://ceonpoint.com/pages/cfvalidation" class="text-primary"> https://ceonpoint.com/pages/cfvalidation</a></li>
                </ul>
                <a href="<?php echo base_url()?>pages/cfvalidation" class="btn btn-primary">Learn More</a>
            </div>
            </div> -->
        <div class="mt-4">
            <h3 class="text-center text-uppercase border-title mb-0">Accredited continuing education courses </h3>
            <p class="text-center ">“Ensuring public safety and quality service through continuing education.”</p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="onlinecourse-box ">
                    <div class="panel panel-default btn-strip" style="margin-bottom:0;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="or-text">or</div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <a class="btn active showSingle" id="active"  target="1">Online courses</a>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <a class="btn onlinecourse showSingle" target="2">Trainings/SEMINAR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="online-latest targetDiv" id="div1">
            
                <h3 class="border-title text-center">LATEST ONLINE COURSES</h3>
                <div class="online-latest-bttn-box">
                    <form id="courseform" class="searchform" action="<?php echo base_url()?>pages/courses">
                            <div class="input-box-select">
                                <input type="text" name="course_title" id="course_title" class="form-control" placeholder="ENTER ONLINE COURSE TITLE" value="<?php echo $_REQUEST['course_title']; ?>">
                            </div>
                            <div class="input-box-select">
                                    <select name="category" class="form-control" id="dropDown">
                                        <option value="" selected="">PROFESSION</option>
                                        
                                        <?php foreach($category as $cate){ ?>
                                        <option value="<?php echo  $cate['id']; ?>"><?php echo  $cate['cat_name']; ?></option>
                                        <?php } ?>  
                                    </select>
                            </div>   

                            <div class="input-box-select">
                                    <select name="country" class="form-control" id="dropDown" >
                                       <option value="" selected="">COUNTRY</option>
                                    
                                        <?php foreach($countries as $country){?>
                                        <option value="<?php echo  $country['countries_id']; ?>"><?php echo  $country['countries_name']; ?> </option>
                                        <?php } ?>  
                                    </select>
                            </div> 

                        <div class="input-box-select">
                            <a href="javascript:void(0)" onclick="jQuery('#courseform').submit();" class="btn search"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
                        </div>
                    </form>
                    </div>

               
                <?php if(count($freecourse) > 0 ){  ?>   
                <div class="owl-carousel-3 nav-button">
                <?php foreach ($freecourse as $key => $value) {
                        $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
                        $Lessons = $this->db->get_where('tbl_lesson',array('course_id'=>$value['id']))->result_array();
                        $categoryname = $this->db->get_where('tbl_category',array('id'=>$value['course_category']))->row_array();
                        $country = $this->db->get_where('countries',array('countries_id'=>$value['country_id']))->row_array()['countries_name']; ?>
                    
                    <div class="item">
                        <div class="course-item">

                            <div class="course-double">
                              <?php if($value['paid_status']==2) { ?>
                               <div class="corner"></div>
                               <span class="corner-text">featured</span>
                               <?php } ?>
                                <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>" class="course-image">
                                
                                 <?php if ($value['course_photo']) { ?>
                                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo']; ?>" alt="">
                                <?php } else { ?>
                                    <img src="<?php echo ASSETS_URL.'images/uploads/IMG_1560995024.png'; ?>" alt="">
                                <?php } ?>
                                
                              </a>

                                <div class="dt-sc-course-details">

                                    <div class="course-price">$<?php echo floatval($value['total']);?></div>

                                    <h5><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>" title="<?php echo $value['course_title'];?>"><?php echo $value['course_title'];?></a></h5>

                                    <div class="clear-line"> </div>

                                    <p>By :  <?php echo $providername['name'];?><br>
                                    Country :  <?php echo $country;?></p>

                                    <ul class="course-meta">
                                        <li><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $categoryname['cat_name'];?></a></li>
                                        <li><?php echo count($Lessons);?> Lessons</li>
                                    </ul>

                                    <div class="course-data">
                                        <div class="course-duration"><i class="fa fa-list-ol"> </i> CE Units  <?php echo $value['units'];?></div>
                                        <div class="post-ratings">
                                        <?php for($i=1;$i<=5;$i++){

                                             if($i<=$value['rating'])
                                             {
                                            ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php
                                             }else
                                             {
                                            ?>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php
                                             }
                                            ?>
                                         
                                        <?php 
                                          }
                                        ?>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <?php  } ?>   
                </div>
                    <?php  }else{ echo '<div class="text-center">No Data Found!</div>'; } ?>
            </div>
        </div>
					
					

        <div class="row">
            <div class="online-latest targetDiv" id="div2" style="display:none;">
               
                <h3 class="border-title text-center">LATEST TRAINING/SYMPOSIUM/CONVENTION</h3>

                <div class="online-latest-bttn-box">
                    <form id="trainingform" class="searchform" action="<?php echo base_url('pages/training'); ?>">
                        <div class="input-box-select">
                            <input type="text" class="form-control" name="training_title" placeholder="ENTER TRAINING TITLE" value="<?php echo $_REQUEST['training_title']; ?>">
                        </div> 
                        <div class="input-box-select">
                            <select name="category" class="form-control" id="dropDown">
                                <option value="" selected="">PROFESSION</option>
                                <?php foreach($category as $cate) { ?>
                                <option value="<?php echo  $cate['id']; ?>"><?php echo  $cate['cat_name']; ?></option>
                                <?php } ?>  
                            </select>
                        </div>   
                        <div class="input-box-select"> 
                            <div class="text-box ">
                                <input type="text"  name="start_date" class="form-control datepicker" id="start_date" placeholder="TRAINING DATE" autocomplete="off" >
                            </div>
                        </div>

                        <div class="input-box-select">
                            <select name="country" class="form-control" id="countryDropDown" >         
                                <option value="" selected="">COUNTRY</option>
                                <?php foreach($countries as $country){ ?>
                                <option value="<?php echo  $country['countries_id']; ?>">
                                    <?php echo  $country['countries_name']; ?>                      
                                </option>
                                <?php } ?>  
                            </select>
                        </div> 
                            <div class="input-box-select">
                                <select name="country" class="form-control" id="specificLocation" >         
                                    <option value="">SPECIFIC LOCATION</option>
                                </select>
                        </div> 

                        <div class="input-box-select">
                            <a href="javascript:void(0)" onclick="jQuery('#trainingform').submit();" class="btn search"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
                        </div>
                    </form>
                </div>
                    
                
                
            <?php if(count($seminar) > 0 ){  ?>
            <div class="owl-carousel-3">                 
            <?php  foreach($seminar as $key => $value) {    ?>
             <?php $Profession = $this->db->get_where('tbl_category',array('id'=>$value['category_id']))->row_array()['cat_name'] ;?>     
                <div class="item">
                    <div class="course-item">
                        <div class="course-double">
                        <?php if($value['paid_status']==2) { ?>
                               <div class="corner"></div>
                               <span class="corner-text">featured</span>
                        <?php  }  ?>
                            <a href="<?php echo site_url('pages/training_details/').$value['id'];?>" class="course-image">
                            <img style="height:298px" src="<?php echo ASSETS_URL.'images/uploads/'.$value['image'];?>" alt="" onError="this.onerror=null;this.src='<?php echo ASSETS_URL."images/uploads/IMG_1560995024.png"; ?>'" >
                           </a>
                            <div class="dt-sc-course-details">

                                <div class="course-price">$<?php echo $value['price'];?></div>

                                <h5><a href="<?php echo site_url('pages/training_details/').$value['id']; ?>" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></a></h5>

                                <div class="clear-line"> </div>

                                 <ul class="course-meta">
                                    <li><i class="fa fa-calendar"></i>
                                        <?php echo $value['start_date'];?> @
                                        <?php echo $value['start_time'];?></li>
                                    </ul>
                                    <ul class="course-meta pb-10">
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                        <?php echo $value['location'];?>
                                        </li>
                                </ul>
                                <p>Profession : <?php echo $Profession; ?></p>
                               
                               

                                <div class="course-data">
                                    <div class="course-duration"><i class="fa fa-list-ol"> </i> CE Units <?php echo $value['units'];?></div>
                                    <div class="post-ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
                <?php } ?>
                </div>
                <?php }else{ echo '<div class="center">No Data found!</div>'; }  ?>
             

            </div>
        </div>
    </div>
</div> 


<section class="product-slid">
    <div class="container">
        <h1 class="border-title text-center text-uppercase mb-0 pb-0 text-white">products and services we OFFER</h1>
            <h4 class="mb-5 text-center text-white">We specialize in continuing education platforms and softwares.</h4>
            <div class="owl-carousel-3 nav-button">
                <div class="item">
                    <div class="jet-banner-wrapper">
                        <a href="<?php echo base_url()?>pages/cetracker">
                            <img src="<?php echo ASSETS_URL.'images/offer-1.jpg'; ?>" alt="PCE-MS"
                                class="jet-banner_img">
                            <div class="jet-banner_content ">
                                <h5 class="jet-banner_title text-uppercase">PCE Platform</h5>
                                <div class="jet-banner_text">Professional Continuing Education (PCE) Platform</div>
                            </div>
                        </a>
                    </div>
                    <!-- <ul class="jet-banner_list mb-3">
                    <li>Global access to CE courses</li>
                    <li>Access to Institution CE courses</li>
                    <li>PCE- Management Software</li>
                    <li>Professional Webpage</li>
                    <li>Mobile app</li>
                </ul> 
                <a href="<?php echo base_url()?>pages/cetracker" class="btn btn-primary">Learn More</a>-->
                </div>
                <div class="item">
                    <div class="jet-banner-wrapper">
                        <a href="<?php echo base_url()?>pages/InstitutionCEPlatform">
                            <img src="<?php echo ASSETS_URL.'images/offer-2.jpg'; ?>" alt="ICE-MS"
                                class="jet-banner_img">
                            <div class="jet-banner_content ">
                                <h5 class="jet-banner_title text-uppercase">ICE Online Platform</h5>
                                <div class="jet-banner_text">Institution Continuing Education (ICE) Online Platform
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- <ul class="jet-banner_list mb-3">
                    <li>ICE- Management Software</li>
                    <li>ICE Webpage</li>
                    <li>Mobile app</li>
                </ul>
                <a href="<?php echo base_url()?>pages/InstitutionCEPlatform" class="btn btn-primary">Learn More</a> -->
                </div>
                <div class="item">
                    <div class="jet-banner-wrapper">
                        <a href="<?php echo base_url()?>pages/ceprovideplateform">
                            <img src="<?php echo ASSETS_URL.'images/offer-3.jpg'; ?>" alt="CEP-MS"
                                class="jet-banner_img">
                            <div class="jet-banner_content ">
                                <h5 class="jet-banner_title text-uppercase">CEP Platform</h5>
                                <div class="jet-banner_text">Continuing Education Provider Platform</div>
                            </div>
                        </a>
                    </div>
                    <!-- <ul class="jet-banner_list mb-3">
                    <li>CEP- Management Software</li>
                    <li>CEP Webpage</li>
                    <li>Local & global exposure of your online courses</li>
                    <li>Mobile app</li>
                    <li>Passive income</li>
                </ul> 
                <a href="<?php echo base_url()?>pages/ceprovideplateform" class="btn btn-primary">Learn More</a>-->
                </div>
                <div class="item">
                    <div class="jet-banner-wrapper">
                        <a href="<?php echo base_url()?>pages/training_management">
                            <img src="<?php echo ASSETS_URL.'images/offer-4.jpg'; ?>" alt="TMS" class="jet-banner_img">
                            <div class="jet-banner_content ">
                                <h5 class="jet-banner_title">TMS</h5>
                                <div class="jet-banner_text">Training Management Software</div>
                            </div>
                        </a>
                    </div>
                    <!-- <ul class="jet-banner_list mb-3">
                    <li>Instant training webpage</li>
                    <li>Digital invitation to social media</li>
                    <li>Verifiable Digital Certificate</li>
                    <li>Online registration & payment</li>
                    <li>Online training evaluation</li>
                    <li>Printable training report</li>
                    <li>Training sponsors section</li>
                    <li>And more</li>
                </ul> 
                <a href="<?php echo base_url()?>pages/training_management" class="btn btn-primary">Learn More</a>-->
                </div>
                <div class="item">
                    <div class="jet-banner-wrapper">
                        <a href="<?php echo base_url()?>pages/ocms">
                            <img src="<?php echo ASSETS_URL.'images/offer-6.jpg'; ?>" alt="TMS" class="jet-banner_img">
                            <div class="jet-banner_content ">
                                <h5 class="jet-banner_title">OCMS</h5>
                                <div class="jet-banner_text">Online Course Management Software</div>
                            </div>
                        </a>
                    </div>
                    <!-- <ul class="jet-banner_list mb-3">
                    <li>InstantShows course overview, lesson, exam, certificate and evaluation.</li>
                    <li>Auto-checking of exam answers.</li>
                    <li>Issue digital certificate automatically upon passing the exam.</li>
                    <li>Mandatory course evaluation before viewing digital exam.</li>
                    <li>Online payment to access online course details.</li>
                    <li>Available in desktop and mobile app.</li>
                </ul>
                <a href="<?php echo base_url()?>pages/ocms" class="btn btn-primary">Learn More</a> -->
                </div>
                <div class="item">
                    <div class="jet-banner-wrapper">
                        <a href="<?php echo base_url()?>pages/cfvalidation">
                            <img src="<?php echo ASSETS_URL.'images/offer-5.jpg'; ?>" alt="TMS" class="jet-banner_img">
                            <div class="jet-banner_content ">
                                <h5 class="jet-banner_title">DCS</h5>
                                <div class="jet-banner_text">Digital Certificate Software</div>
                            </div>
                        </a>
                    </div>
                    <!-- <ul class="jet-banner_list mb-3">
                    <li>Digitalize your certificatesto be issued to recipientsby creating a CEP account orInstitution account.</li>
                    <li>Online verification of digitalcertificates here at :<a href="https://ceonpoint.com/pages/cfvalidation" class="text-primary"> https://ceonpoint.com/pages/cfvalidation</a></li>
                    </ul>
                    <a href="<?php echo base_url()?>pages/cfvalidation" class="btn btn-primary">Learn More</a> -->
                </div>
                <div class="item">
                    <div class="jet-banner-wrapper">
                        <a href="<?php echo base_url('rboard')?>">
                            <img src="<?php echo ASSETS_URL.'images/transfer.jpg'; ?>" alt="TMS" class="jet-banner_img">
                            <div class="jet-banner_content ">
                                <h5 class="jet-banner_title">PRB</h5>
                                <div class="jet-banner_text"> PRB Online Platform </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
    </div>
</section>

 <!-- <section class="bottome-addspace" style="padding: 10px 10px">
        <?php if(!empty($current_country)){ $this->db->where('tbl_adv_package_purchased.country',$current_country); }
                 $middlebanner = $this->advertiseads->getAdvertiserBanner('Middle Body');                       
                  if(count($middlebanner))
                   {	
                      foreach($middlebanner as $banner)
                      {
                          $this->advertiseads->updateCount($banner['id']);
                          $size=explode('x',$banner['size']);
                          ?>
                            <div class="item">
                                <div class="container">
                                    <div class="bottome-addspace-box">
                                        <a href="<?php if($banner['website_url']){ echo $banner['website_url'];}else{ echo "#";}?>"><img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image']; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" alt=""></a>
                                    </div>
                                </div>
                            </div>
        <?php break; }
                   }else
                   {  ?>
                       <div class="item">
                            <div class="container">
                                <div class="bottome-addspace-box">
                                    <img src="<?php echo ASSETS_URL.'images/advertise/new-1230-x-200.jpg';?>"  alt="">
                                </div>
                            </div>
                        </div>
               <?php } ?>       
        </section> -->



<div class="pb-3 latest-Professionals">

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h3 class="border-title border-title-h text-left">Latest Professionals</h3>
                <button class="btn btn-warning pull-right"><a class="text-white" href="<?php echo base_url('pages/latestprofessional'); ?>"  >View All Professionals</a></button>
            </div>
            <div class="col-md-3">
                <h3 class="border-title border-title-h text-left">NEWS/BLOG</h3>
                
                <button class="btn btn-info pull-right"><a class="text-white" href="<?php echo base_url('pages/blog'); ?>">View All</a></button>
            </div>   
                    
            <div class="col-md-9">
            <?php if(count($latestprofessionallist)>0){  ?>
            <div class="owl-carousel-3">
            <?php foreach($latestprofessionallist as $latpro){ 
                $profileimg = $this->db->get_where('tbl_user',array('id'=>$latpro['user_id']))->row_array()['image']; 
                $country = $this->db->get_where('countries',array('countries_id'=>$latpro['country_id']))->row_array()['countries_name'];?>

            <div class="item">
                <div class="new-training-box">
                    <a href="<?php echo site_url('share/viewprofile/').$latpro['user_id']; ?>">
                        <div class="training-box_overlay"></div>
                        <div class="training-box-image prof_images">
                            <img src="<?php echo ASSETS_URL."images/uploads/".$profileimg; ?>" onError="this.onerror=null;this.src='<?php echo ASSETS_URL."images/dummy-profile.jpg"; ?>';" alt="">
                        </div>
                        <div class="training-box-caption">
                            <h5 class="training-box_title"><?php echo $latpro['name']; ?></h5>
                            <div class="training-box_text"><?php echo $latpro['profession'].'<br>'.$country; ?></div>
                        </div>
                    </a>
                </div>
            </div>
            <?php } ?>
            </div>
            <?php }else{ echo 'No Data found!'; } ?>
            </div>

           
            <div class="col-md-3">
            <?php if(count($blogs)>0){ ?>
            <div class="owl-blog">
            <?php foreach($blogs as $blog){ ?>
            <div class="owl-item-blog">
                <div class="new-training-box">
                    <a href="<?php echo site_url('pages/blog_details/').$blog['id']; ?>">
                        <div class="training-box_overlay"></div>
                        <div class="training-box-image blog_images">
                            <img src="<?php echo ASSETS_URL."upload/blog/".$blog['image']; ?>" onError="this.onerror=null;this.src='<?php echo ASSETS_URL."images/dummy-profile.jpg"; ?>';" alt="">
                        </div>
                        <div class="training-box-caption">
                            <h5 class="training-box_title"><?php echo $blog['title']; ?></h5>
                            <!-- <div class="training-box_text"><?php echo $blog['st_desc']; ?></div> -->
                            <a href="<?=base_url('pages/blog_details/'.$b['image'])?>" class="read-button">Read More</a>
                        </div>
                    </a>
                </div>
            </div>
            <?php } ?>
            </div>
            <?php }else{ echo '<center><b>No Data found!</b></center>'; } ?>
            </div>

            <div class="col-md-7 pb-3">
                <h3 class="border-title border-title-h text-left">Latest CE Providers</h3>
                <?php 
                $provider = $this->user->getProviders(array('country'=>$current_country));  ?>
                <button class="btn btn-primary pull-right"><a class="text-white" href="<?php echo base_url('pages/ceprovider'); ?>" >View All CE Providers</a></button>

                <div class="training-semi-slider-6 pagi-above">
                <?php if(count($provider)>0){ 
                 foreach ($provider as $key => $value) { 
                    $country = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name']; ?>
                    <div class="item">
                        <div class="training-semi">
                            <div class="new-training-box">
                                <a href="<?php echo base_url('share/viewprofile/').$value['id'];?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image provider_images">

                                        <?php if($value['image']=="")
                                                {
                                                    $img = "placeholder.jpg";
                                                }else{
                                                    $img = $value['image'];
                                                } ?>

                                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$img; ?>" alt="<?php echo $img;?>" title="<?php echo $img; ?>">
                                    </div>
                                    <div class="training-box-caption">
                                        <h5 class="training-box_title"><?php echo $value['name']; ?></h5>
                                        <div class="training-box_text"><?php echo $value['address'].' '.$country; ?></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } }else{ echo 'No Data Found!'; } ?>  
              </div>


            <!-- <h3 class="border-title border-title-h text-left">Latest Authors</h3>
            <button class="btn btn-danger pull-right"><a class="text-white" href="<?php echo base_url('pages/authors'); ?>"  >View All Authors</a></button>
              <div class="training-semi-slider-6 pagi-above">
                <?php if(count($authors) > 0 ){ 
                 foreach ($authors as $key => $value) { 
                    $country = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name'];?>
                    <div class="item">
                        <div class="training-semi">
                            <div class="new-training-box">
                                <a href="<?php echo base_url('share/viewprofile/').$value['id']; ?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image author_images">

                                        <?php 
                                        if($value['image']==""){
                                            $img = "placeholder.jpg";
                                        } else {
                                            $img = $value['image'];
                                        } ?>

                                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$img;?>" alt="<?php echo $img;?>" title="<?php echo $img;?>">
                                    </div>
                                    <div class="training-box-caption">
                                        <h5 class="training-box_title"><?php echo $value['name']; ?></h5>
                                        <div class="training-box_text"><?php echo $value['address'].' '.$country; ?></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } }else{ echo 'No Data Found!'; } ?>  
              </div> -->
              
            </div>

            <div class="col-md-5 pb-3">
                <h3 class="border-title border-title-h text-left">Latest Institutions</h3>
                <?php // $instite = $this->user->get_record_by_field_name_all_record('tbl_user','role',5);
                      $instite = $this->user->getInstitutions(array('country'=>$country_id)); ?>
                <button class="btn btn-success pull-right"><a class="text-white" href="<?php echo base_url('pages/Institutionspage'); ?>" >View All Institutions</a></button> 

                <div class="training-semi-slider-7 pagi-above">
                <?php 
                    if(count($instite)>0){
                    foreach ($instite as $key => $value) {   ?>
                    <div class="item">
                        <div class="training-semi training-semi-big">
                            <div class="new-training-box">
                                <a href="<?php echo site_url('web/').$value['insititution_id']; ?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image ins_images">

                                        <?php    if($value['backimage']==""){
                                                    $img = "placeholder.jpg";
                                                 } else {
                                                    $img = $value['backimage'];
                                                }  ?>
                                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$img; ?>" alt="<?php echo $img;?>" title="<?php echo $img;?>">
                                    </div>
                                    <div class="training-box-caption">
                                        <h5 class="training-box_title"><?php echo $value['name']; ?></h5>
                                        <div class="training-box_text"><?php echo $value['address']; ?></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php  }  ?>
                <?php  }else{ echo 'No Data Found!'; } ?>
                </div>
            </div>
            
            <div class="">
            <div class="col-md-7">
                <h3 class="border-title border-title-h text-left">Latest Authors</h3>
                <button class="btn btn-danger pull-right"><a class="text-white" href="<?php echo base_url('pages/authors'); ?>">View All Authors</a></button>
                <div class="training-semi-slider-6 pagi-above">
                    <?php if(count($authors) > 0 ){ 
                 foreach ($authors as $key => $value) { 
                 $profileimg = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['image']; 
                 $country = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name'];?>
                    <div class="item">
                        <div class="training-semi">
                            <div class="new-training-box">
                                <?php if(date('Y-m-d') >=$value['featured_from'] and date('Y-m-d')<=$value['featured_to']) { ?>
                                <div class="corner"></div>
                                <span class="corner-text">featured</span>
                                <?php } ?>
                                <a href="<?php echo base_url('share/viewprofile/').$value['id'];?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image author_images">

                                        <?php if($value['image']==""){
                                            $img = "dummy-profile.jpg";
                                        } else {
                                            $img = $value['image'];
                                        }?>

                                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$img;?>"
                                            alt="<?php echo $img;?>" title="<?php echo $img;?>">
                                    </div>
                                    <div class="training-box-caption">
                                        <h5 class="training-box_title">
                                            <?php echo $value['name']; ?>
                                        </h5>
                                        <div class="training-box_text">
                                            <?php echo $country; ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } }else{ echo 'No Data Found!'; } ?>
                </div>
            </div>
            <div class="col-md-5">
                <h3 class="border-title border-title-h text-left">Regulatory Boards</h3>
                <button class="btn btn-warning pull-right"><a class="text-white" href="<?php echo base_url('pages/rboards'); ?>">View All Regulatory Boards</a></button>
                <div class="accredited-schools-slider">
                    <?php
                        if(!empty($rboards)){ 
                        foreach($rboards as $value){ ?>
                    <div class="item">
                        <div class="training-semi">
                            <div class="new-training-box">
                                <a href="<?php echo base_url('pages/rboards');?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image author_images">
                                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$value->image; ?>" alt="">
                                    </div>
                                    <div class="training-box-caption">
                                        <h5 class="training-box_title">
                                            <?=$value->name; ?>
                                        </h5>
                                        <div class="training-box_text">
                                            <?=$value->country_name; ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } }else{ echo 'No Data Found!'; } ?>
                </div>
            </div>
        </div>

            <!-- <div class="col-md-12">
                <h3 class="text-left">Advertisement:</h3>
                    <div class="footer-add">
                        <div class="main-addspace">
                                    <div class="">  
                                        <div class="main-addspace-box">
                                        <?php 
                        if(!empty($current_country)){$this->db->where('tbl_adv_package_purchased.country',$current_country);}
                                    $bottombanner = $this->advertiseads->getAdvertiserBanner('Bottom Body');                        
                                    if(count($bottombanner))
                                    {
                                    $i=1;
                                    foreach($bottombanner as $banner)
                                    {
                                    if($i>4)
                                    {
                                    break;
                                    }
                                    $i++;
                                   $this->advertiseads->updateCount($banner['id']);
                                  $size=explode('x',$banner['size']);
                                  ?>
                                    <div class="item">
                                        <div class="main-addspace-iner-box">
                                            <a href="<?php if($banner['website_url']){ echo $banner['website_url'];}else{ echo "#";}?>">
                                            <img src="<?php echo ASSETS_URL.'upload/'.$banner['banner_image']; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>" alt=""></a>
                                        </div>
                                    </div>
                        <?php     }
                                }else { ?>
                                        <div class="item">
                                            <div class="main-addspace-iner-box">
                                                <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="main-addspace-iner-box">
                                                <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="main-addspace-iner-box">
                                                <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="main-addspace-iner-box">
                                                <img src="<?php echo ASSETS_URL.'images/advertise/new-300-x-50.jpg'; ?>" alt="">
                                            </div>
                                        </div>
                                        <?php } ?>
                                        </div>
                            
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
</div>

<div class="newsletter-section">
    <div class="container">
        <div id="newsletter">

            <h3 class="text-white">Renewing your Professional License? </h3>
            <h3 class="text-white">Ready for you Job Performance Appraisal?</h3>
            <h2>GET CE UNITS OR CONTACT HOURS NOW!</h2>
            
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/courses'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/online.jpg'); ?>" alt="Online Courses">
                            </div>
                            <div class="online-text">
                                <p>ONLINE COURSE</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/training'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/traning.jpg'); ?>" alt="Training">
                            </div>
                            <div class="online-text">
                                <p>TRANING / SEMINARS</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="online-box">
                         <a href="javascript:void(0)" onclick="checklogin();">
                        <!--<a href="<?php echo site_url('pages/cfvalidation'); ?>">-->
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/certificates.jpg'); ?>" alt="Certificates">
                            </div>
                            <div class="online-text">
                                <p>UPLOAD CERTIFICATES</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/Institutionspage'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/institute.jpg'); ?>" alt="Institutes">
                            </div>
                            <div class="online-text">
                                <p>INSTITUTION CE WEBPAGE</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <!-- <h2>Track your Professional License? Get CE Units online!</h2>
            <h6>Choose Online CE Courses anytime, anywhere at any device!</h6> 
            <a href="<?php echo site_url('pages/courses');?>" class="btn btn-default btn-lg"><i class="fa fa-thumbs-o-up"></i>  VIEW ONLINE CE COURSES!</a> -->

        </div>
    </div>
</div>

<!-- <div id="homepopup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            /* Modal content */
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align: center;">ADD CE UNITE OR COUNTACT HOURS</h4>
                </div>
                <div class="modal-body">
                      <div class="row">
                <div class="col-md-3">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/courses'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/online.jpg'); ?>" alt="Online Courses">
                            </div>
                            <div class="online-text-pop">
                                <p>Online Courses</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/training'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/traning.jpg'); ?>" alt="Training">
                            </div>
                            <div class="online-text-pop">
                                <p>Training</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/cfvalidation'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/certificates.jpg'); ?>" alt="Certificates">
                            </div>
                            <div class="online-text-pop">
                                <p>Certificates</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/Institutionspage'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/institute.jpg'); ?>" alt="Institutes">
                            </div>
                            <div class="online-text-pop">
                                <p>Institutes</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>  
                </div>
            </div>
        </div>
    </div>-->
<style>
    .owl-blog {
    height: 300px;
    overflow-y: scroll;
    overflow-x: hidden;
    }
    .owl-item-blog .training-box_title {
    -webkit-transform: translate3d(0, 10px, 0);
    transform: translate3d(0, 10px, 0);
    }
    .owl-item-blog .training-box-caption {
    height: 83%;
    }
    /*.owl-carousel-blog{
      transform: rotate(90deg);
      width: 270px; 
      margin-top:100px;
    } 
    .item-blog{
      transform: rotate(-90deg);
    }
    .owl-carousel-blog .owl-nav{
      display: flex;
      justify-content: space-between;
      position: absolute;
      width: 100%;
      top: calc(50% - 33px);
    }
    div.owl-carousel-blog .owl-nav .owl-prev, 
    div.owl-carousel-blog .owl-nav .owl-next{
        font-size:36px;
        top:unset;
        bottom: 15px; 
    }*/
</style>

<script type="text/javascript">
  /* function homepopup(){
      $('#homepopup').modal('show');
      return false;
    } */
    $( document ).ready(function() {
        $(".owl-carousel-blog").owlCarousel({
            items: 2,
            loop: false,
            mouseDrag: true,
            touchDrag: false,
            pullDrag: false,
            rewind: true,
            autoplay: true,
            margin: 1,
            dots: false
            // nav: true
        });
    });
</script>
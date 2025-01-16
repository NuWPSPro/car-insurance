<?php 
$uid = $this->session->userdata('logged_in')['id'];
$userdata = $this->db->get_where('tbl_user',array('id'=>$uid))->row_array(); 
$uemail = $userdata['username'];
$uname = $userdata['name'];
$this->load->model('professional_model','professional_model'); 
$currentplan = $currentplanArr->version_type;
if($currentplan==3){
	$activetab = '#nav-premium-tab';
	$activeplan = '#nav-premium';
}elseif($currentplan==2){
	$activetab = '#nav-premium-tab';
	$activeplan = '#nav-premium';
	// $activetab = '#nav-pro-tab';
	// $activeplan = '#nav-pro';
}else{
	$activetab = '#nav-pro-tab';
	$activeplan = '#nav-pro';
	// $activetab = '#nav-basic-tab';
	// $activeplan = '#nav-basic';
}
?>   
<section class="iceproject-herobaner cetracker-herobaner">
  <div class="ice-project" style="background-image: url(<?php echo ASSETS_URL.'images/cetracker-herobanner.png';?>);">
      <div class="container">
          <div class="iiceproject-herobaner-contentbox">
              <div class="ice-project-content">
                  <!-- <h1>PCE Platform</h1> -->
                  <h1 style="font-size: 49px;">Ready for License Renewal <br>Or Job Performance Appraisal? </h1>
                  <p>Use PCE Platform 
                    <br>(Professional Continuing Education Platform) 
                    and be Ready!
                  </p>
                    
                    <div class="professionals-trio-register">
                        <div class="video-icon-popup">
                        <a href="#" data-toggle="modal" data-target="#videoModal" data-thevideo="http://www.youtube.com/embed/loFtozxZG0s"><i class="fa fa-play" aria-hidden="true"></i></a>
                        </div>
                        <a href="<?php echo base_url('users/signup/professional'); ?>" target="_blank" class="professionals-trio-btn">Register Now for FREE!</a>
                    </div>
              </div>
          </div>
      </div>
  </div>
    <div class="container">
        <div class="ice-componentspanel our-quadpanel">
                    <h2>5 Components of PCE Platform</h2>
                    <p>Get the 5 Components for <span>FREE</span>. <br>Upgrade to Pro Version of software for more features. </p>
                    <p></p>
            <div class="ice-components-box">
                    <a href="#cetracker-coursepanel">
                        <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img4.jpg'; ?>">
                        <div class="ice-components-boxinfo">
                        <span>Global <br> CE COURSES </span>
                        </div>
                    </a>
                    <a href="#latest-cetrackerpanel">
                        <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/offer-2.jpg'; ?>">
                        <div class="ice-components-boxinfo">
                        <span>Institution <br> CE Courses</span>
                        </div>
                    </a>
                    <a href="#pcs-ms-box">
                        <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img5.png'; ?>">
                        <div class="ice-components-boxinfo">
                        <span>professional ce <br> mng't. software</span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#quadMobile">
                        <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img1.png'; ?>">
                        <div class="ice-components-boxinfo">
                        <span>MOBILE <br> APP</span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#quadWebpage" >
                        <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/webpages/img6.png'; ?>">
                        <div class="ice-components-boxinfo">
                        <span>professional  <br>  WEBPAGE</span>
                        </div>
                    </a>
            </div>  
        </div>
   
    </div>
</section>

<section class="cetracker-coursepanel" id="cetracker-coursepanel">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="border-title text-center mb-0">GLOBAL CE COURSES</h3>
                <div class="onlinecourse-box ">
                    <div class="panel panel-default btn-strip" style="margin-bottom:0;">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="or-text">or</div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <a class="btn active showSingle" id="active"  target="1">Online courses</a>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <a class="btn onlinecourse showSingle" target="2">Training/Seminars</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="online-latest targetDiv" id="div1">
                  <h3 class="border-title text-center">LATEST ONLINE COURSES</h3>

                 <div class="online-latest-bttn-box">
                    <form id="courseform" class="searchform" action="<?php echo base_url('pages/courses')?>">
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
                                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo'];?>" alt="">
                                <?php } else { ?>
                                    <img src="<?php echo ASSETS_URL.'images/uploads/IMG_1560995024.png';?>" alt="">
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
                                                if($i<=$value['rating']){
                                                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                                }else{
                                                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                                    } 
                                                } ?>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <?php  } ?>   
                </div>
                <?php  }else{ echo '<div class="center">No Data Found!</div>'; } ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="online-latest targetDiv" id="div2" style="display:none;">
                <h3 class="border-title text-center">LATEST TRAINING/SYMPOSIUM/CONVENTION</h3>
                <div class="online-latest-bttn-box">
                    <form id="trainingform" class="searchform" action="<?php echo base_url('pages/training')?>">
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
                                    <input type="month"  name="start_date" class="form-control" id="start_date" placeholder="TRAINING DATE" autocomplete="off" >
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
                            <img style="height:298px" src="<?php echo ASSETS_URL.'images/uploads/'.$value['image'];?>" alt="" onError="this.onerror=null;this.src='<?php echo ASSETS_URL; ?>images/uploads/IMG_1560995024.png';" >
                           </a>
                            <div class="dt-sc-course-details">

                                <div class="course-price">$<?php echo $value['price'];?></div>

                                <h5><a href="<?php echo site_url('pages/training_details/').$value['id'];?>" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></a></h5>

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
                                <!-- <p><?php echo substr(strip_tags($value['description']),0,35);?>...</p> -->
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
                <?php }else{ echo '<center>No Data found!</center>'; }  ?>

             </div>
            </div>
        </div>
    </div>
</section>


<section class="ice-software pcs-ms-box" id="pcs-ms-box">
        <div class="container">
            <div class="streamline-content">
                <h2>pce-ms </h2>
                <h4>Professional Continuing Education Management Software</h4>
                <p>Helping professionals to make it easier to prepare for<br>License renewal and job performance appraisa;?</p>
                 <h5>MAJOR CAPABILITIES OF PEC-MS</h5>
                <a href="#" class="web-creat-site">
                    GET YOUR PCE-MS FOR FREE!
                </a>
                <div class="ice-soft-streamline-lin">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-xs-6">
                            <div class="ice-professionals-icons">
                                <a href="#">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/administrtor-img.png';?>">
                                    <span>Access to unlimited ce courses</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-6">
                            <div class="ice-professionals-icons">
                                <a href="#">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/ce-provider-img.png';?>">
                                    <span>Store unlimited certificates</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-6">
                            <div class="ice-professionals-icons">
                                <a href="#">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/author-presenter-img.png';?>">
                                    <span>Track ce units compliance</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-6">
                            <div class="ice-professionals-icons">
                                <a href="#">
                                    <img class="ice-register_pro" src="<?php echo ASSETS_URL.'images/staff-img.png';?>">
                                    <span>Digital reporting of certificates</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                
                <div class="modal-body">
					<div class="planstabssection">
						<?php $uesrrole = $this->session->userdata('logged_in')['role'];
						$purchageuser = ($uesrrole==1)?'planstabs':'loginusers'; ?>
						<nav>
						  <div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active in planstabs" id="nav-basic-tab" data-toggle="tab" href="#nav-basic" role="tab" aria-controls="nav-basic" aria-selected="true">Basic</a>
							<a class="nav-item nav-link active in planstabs" id="nav-pro-tab" data-toggle="tab" href="#nav-pro" role="tab" aria-controls="nav-pro" aria-selected="false">Pro</a>
							<a class="nav-item nav-link active in planstabs" id="nav-premium-tab" data-toggle="tab" href="#nav-premium" role="tab" aria-controls="nav-premium" aria-selected="false">Premium</a>
						  </div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
						  <div class="tab-pane fade active in" id="nav-basic" role="tabpanel" aria-labelledby="nav-basic-tab">
							<div class="basicplansecttion"><button class="planstabs btn btn-primary">BASIC FREE VERSION - LIMITED FEATURES<br>NO COST</button></div>
							<?php
							foreach($basicplansArr as $bplns){
								$plnsdesarr = $this->professional_model->plandetails($bplns['pro_plan_features']);
									if(count($plnsdesarr) > 0){
										echo '<ul>';
										foreach($plnsdesarr as $basicf){
											echo '<li>'.$basicf['features_name'].'</li>';
										}
										echo '</ul>';
										//if($plns['plan_id'] == 1){ 
										echo '<div class="text-center"><img src="'.ASSETS_URL.'images/basicfeatures.jpg" style="border: 1px solid #000;"></div>';
										//}
									}
							}
							?>
						  </div>
						  <div class="tab-pane fade" id="nav-pro" role="tabpanel" aria-labelledby="nav-pro-tab">
							<?php
							//print_r($plansArr);
							$planbuttons = '';
							$btncount = 1;
							$plandescriptions = '';
							foreach($plansArr as $plns){
								if($plns['propla_id'] == 1){
									$planbuttonsbtn = '<div class="basicplansecttion"><button id="plan'.$plns['propla_id'].'" data-id="'.$plns['propla_id'].'" data-name="'.$plns['pro_package_name'].'" data-amount="'.$plns['pro_package_amount'].'" class="'.$purchageuser.' btn btn-primary">$'.$plns['pro_package_amount'].'<br/>'.$plns['pro_package_name'].'</button></div>';
								}else{
									
									$saveprice = ($plns['pro_package_save_amt'] > 0)?'<br><div style="border:1px solid #000;background:yellow;color:red;" >Save $'.$plns['pro_package_save_amt'].'</div>':'';
									$planbuttonsbtn = '<button id="plan'.$plns['propla_id'].'" data-id="'.$plns['propla_id'].'" data-name="'.$plns['pro_package_name'].'" data-amount="'.$plns['pro_package_amount'].'" class="'.$purchageuser.' btn btn-primary">$'.$plns['pro_package_amount'].'<br/>'.$plns['pro_package_name'].$saveprice.'</button>';
								}
								$opendiv = ($btncount == 2)?'<div class="plancenter text-center">':'';
								$closediv = ($btncount == 3)?'</div>':'';
								$planbuttons .= $opendiv.$planbuttonsbtn.$closediv;
								
								// if($plns['pro_plan_features'] != ""){
									$plandescriptions .= '<div id="plandescription'.$plns['propla_id'].'" class="plansdescr" style="display:none;">';
									$plnsdesarr = $this->professional_model->plandetails($plns['pro_plan_features']);
									if(count($plnsdesarr) > 0){
										$plandescriptions .= '<ul>';
										foreach($plnsdesarr as $sdf){
											$plandescriptions .= '<li>'.$sdf['features_name'].'</li>';
										}
										$plandescriptions .= '</ul>';
									}
									// if($plns['plan_id'] == 1){ 
										$plandescriptions .= '<div class="text-center"><img src="'.ASSETS_URL.'images/profeatures.jpg" style="border: 1px solid #000;"></div>';
									// }
									$plandescriptions .= '</div>';
								//}
								$btncount++;	
							}
							echo $planbuttons.$plandescriptions;
						   ?>
						  
						  </div>
						  <div class="tab-pane fade" id="nav-premium" role="tabpanel" aria-labelledby="nav-premium-tab">
						  
						  <!-- <p>Comming Soon!</p> -->
							<?php
							foreach($premiumplansArr as $bplns){
                                
                                if($connected_rboard->rboard_name ==''){
									echo '<div class="basicplansecttion"><button style="width:100%;" onclick = "alert(\'You are not connected with any Regularity Board\')"; class="btn btn-primary">$'.$bplns['pro_package_amount'].'<br/>'.$bplns['pro_package_name'].'</button></div>'; 
								}else{
									echo '<div class="basicplansecttion"><button id="plan'.$bplns['propla_id'].'" data-id="'.$bplns['propla_id'].'" data-name="'.$bplns['pro_package_name'].'" data-amount="'.$bplns['pro_package_amount'].'" class="'.$purchageuser.' btn btn-primary">$'.$bplns['pro_package_amount'].'<br/>'.$bplns['pro_package_name'].'</button></div>';	
								}
								$plnsdesarr = $this->professional_model->plandetails($bplns['pro_plan_features']);
									if(count($plnsdesarr) > 0){
										echo '<ul>';
										foreach($plnsdesarr as $basicf){
											echo '<li>'.$basicf['features_name'].'</li>';
										}
										echo '</ul>';
										echo '<p style="color:red;">3 STEPS PROCESS REQUIRED TO GET THIS FEATURES</p>
											  <ul>
												<li>Check if your Regulatory Board is partner with ceopoint</li>
												<li>Verify your Professional Registration</li>
												<li>Pay the PREMIUM plan</li>
											  </ul>';
										//if($plns['plan_id'] == 1){ 
										echo '<img src="'.ASSETS_URL.'images/profeatures.jpg" style="border: 1px solid #000;">';
										//}
									}
							}
							?>
						  </div>
						</div>
					</div>
					
					
				
                   
					</div> 
                
            </div>
        </div>
</section>

<section class="latest-Professionals latest-cetrackerpanel" id="latest-cetrackerpanel">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="border-title border-title-h text-left">Institution CE Courses</h3>
                <button class="btn btn-warning pull-right"><a class="text-white" href="<?php echo base_url('pages/Institutionspage'); ?>"  >View All Institution</a></button>
            </div>   
                    
            <div class="col-md-12">
            <?php if(count($institutions)>0){ ?>
            <div class="owl-carousel-3">
            <?php foreach($institutions as $key => $value){ 
                 $country = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name']; ?>
                    <div class="item">
                        <div class="training-semi training-semi-big">
                            <div class="new-training-box">
                                <a href="<?php echo site_url('web/').$value['insititution_id']; ?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image ins_images">

                                        <?php    if($value['backimage']==""){
                                                    $img = "dummy-profile.jpg";
                                                 } else {
                                                    $img = $value['backimage'];
                                                }  ?>
                                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$img;?>" alt="<?php echo $img;?>" title="<?php echo $img;?>">
                                    </div>
                                    <div class="training-box-caption">
                                        <h5 class="training-box_title"><?php echo $value['name']; ?></h5>
                                        <div class="training-box_text"><?php echo $country; ?></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php } ?>
            </div>
            <?php }else{ echo 'No Data found!'; } ?>
            </div>
      
        </div>
    </div>
</section>
<section class="latest-Professionals latest-cetrackerpanel" id="latest-cetrackerpanel">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="border-title border-title-h text-left">Latest Professionals</h3>
                <button class="btn btn-warning pull-right"><a class="text-white" href="<?php echo base_url('pages/latestprofessional'); ?>"  >View All Professionals</a></button>
            </div>   
                    
            <div class="col-md-12">
            <?php if(count($professionals)>0){ ?>
            <div class="owl-carousel-3">
            <?php foreach($professionals as $latpro){ 
                $profileimg = $this->db->get_where('tbl_user',array('id'=>$latpro['user_id']))->row_array()['image']; 
                $country = $this->db->get_where('countries',array('countries_id'=>$value['country_id']))->row_array()['countries_name'];?>
            <div class="item">
                <div class="new-training-box">
                    <?php if(date('Y-m-d') >=$latpro['featured_from'] and date('Y-m-d')<=$latpro['featured_to']){ ?>
                        <div class="corner"></div>
                        <span class="corner-text">featured</span>
                    <?php } ?> 
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
      
        </div>
    </div>
</section>
<a href="#" id="scroll"><span></span></a>  

<!-- The ICE Webpage Modal -->
<div class="modal fade icecomponents-modal" id="quadMobile">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="ice-professionals-icons">
                <h1>MOBILE APP</h1>
            </div>           
        </div>
        <!-- Modal body -->
        <div class="modal-body">
        <p>Contains the following sections:</p>
          <ul>
                <li>Your CE Records and tracker</li>
                <li>Online course listing</li>
                <li>Training/Seminars listing</li>
                <li>Institution CE Webpages</li>

          </ul>
          <a href="https://play.google.com/store/apps/details?id=com.ceonpoint.com" target="_blank" class="web-creat-site">
                DOWNLOAD CEONPOINT<br> MOBILE APP<br>
                1. Go play.google.com<br>
                2. Search Ceonpont<br>
                3. Click Install
          </a>
          <img src="<?php echo ASSETS_URL.'images/webpages/img1.png'; ?>">
        </div>
      </div>
    </div>
  </div>

  <!-- The ICE Webpage Modal -->
  <div class="modal fade icecomponents-modal" id="quadWebpage">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="ice-professionals-icons">
                <h1>PROFESSIONAL WEBPAGE</h1>
                <p>For your professional services/business or for employment purposes.</p>
            </div>           
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <p><strong>Contains the following sections:</strong></p>
          <ul>
                <li>Profile photo and background</li>
                <li>Name and profession</li>
                <li>Shows your professional information</li>
                <li>Shows your portfolios or services</li>
                <li>Share your page to social media</li>

          </ul>
          <a href="https://www.ceonpoint.com/users/signup/professional" class="web-creat-site">
                Create your page now!
          </a>
          <img src="<?php echo ASSETS_URL.'images/webpages/img6.png'; ?>">
        </div>
      </div>
    </div>
  </div>


 <script>
    $('.ice-components-box a').click(function(){
        $('html, body').animate({
            scrollTop: $( $(this).attr('href') ).offset().top
        }, 800);
        return false; 
    });
   
</script>

<script type="text/javascript">
	function paynow(id,amount) {

$('#item_name').val(id);
$('#amount').val(amount);
document.getElementById("frmPayPal1").submit();
}


$(".planstabs").click(function() {
var pcems       = '<?php echo $uname.' - PCE-MS'; ?>';
var planId 		= $(this).data("id");
var planName 	= $(this).data("name");
var tax         = $(this).data("tax");
var basePrice   = $(this).data("base");
var planAmount 	= $(this).data("amount");
// alert(planId+'_'+tax+'_'+basePrice);
if(planAmount > 0){
    $('#paypalPlanId').val(planId);
    $('#paypalPlannane').val(planName);
    $('#paypalTax').val(tax);
    $('#paypalBase').val(basePrice);
    $('#paypalAmount').val(planAmount);

    $('#stripePlanId').val(planId);
    $('#stripePlannane').val(pcems+' '+planName);
    $('#stripeAmount').val(planAmount);
    $('#stripeTax').val(tax);
    $('#stripeBase').val(basePrice);
    $("#payby").modal("show");   
    $("#planlistingmodal").modal("hide");   
    // $('#frmPaypalBuyPlan').submit();
}
//alert(planId+planName+planAmount);		
//$(".plansdescr").hide();
//$("#plandescription"+planid).show();
$("#plandescription3").show();
});

$("#plandescription3").show();

$('#freetoprobtn').on('click', function() {
$("#professionalNopaymentmodal").modal("hide");
$("#planlistingmodal").modal("show");	
/* $('#professionalNopaymentmodal').modal({
    show: false
}); 
$('#planlistingmodal').modal({
    show: true
});  */
});

$('.planstabs').on('click', function() {
$('.planstabs').removeClass('active in');
$(this).addClass('active in');
});
$(document).ready(function(){
$('.planstabs,.tab-pane').removeClass('active in');
$('<?=$activetab?>').addClass('active in');
$('<?=$activeplan?>').addClass('active in');
});
$(".loginusers").click(function() {
alert('Please login with your professional\'s account and Purchase it.');
return false;
});


function paybypaypal() {
$("#frmPaypalBuyPlan").submit();
}

function paybystrip() {
$("#frmStripeBuyPlan").submit();
}

</script>
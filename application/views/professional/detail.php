<?php
//$profuserdata 			= $this->db->get_where('tbl_professionals',array('user_id'=>$this->uri->segment(3)))->row_array();
$citationsgetdata 		= $this->db->get_where('tbl_citations_list',array('pro_id'=>$profuserdata['pro_id']))->result_array();
$practicegetdata 		= $this->db->get_where('tbl_practice_list',array('pro_id'=>$profuserdata['pro_id']))->result_array();
$affiliationgetdata 	= $this->db->get_where('tbl_affiliation_list',array('pro_id'=>$profuserdata['pro_id']))->result_array();
$professionfiles	 	= $this->db->get_where('tbl_user_docutments',array('user_id'=>$this->uri->segment(3)))->result_array();
// echo $this->db->last_query();
// print_r($uid);
// exit;

/*echo '<pre>';
print_r($profuserdata);
die;*/
?>
<div class="banner-profile" style="<?php if (!empty($profuserdata['background_photo'])) { echo "background-image:url(". ASSETS_URL ."images/uploads/". $profuserdata['background_photo'] .")"; ?>">
	<?php } else { ?>
        <img class="banner-profile" src="<?php echo ASSETS_URL;?>images/dummy-banner.jpg">
        <?php } ?>
		
</div>

<div class="innerContent">
    <div class="container">
        <div class="row profile-dashboard">
		
            <div class="col-sm-3">
                <div class="user-profile-thumb">
                    <?php if ($profuserdata['profile_photo']) { ?>
                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$profuserdata['profile_photo'];?>" alt="<?php echo $profuserdata['name'];?>">
                    <?php }else { ?>
                    <img src="<?php echo ASSETS_URL.'images/dummy-profile.jpg'; ?>">
                    <?php } ?>
                </div>
					
				<table class="table table-striped">
                	<p><strong><?php echo ucfirst($profuserdata['name']);?></strong>
	                    <br>
	                    <?php echo $profuserdata['profession'];?>
	                    <br> <?php echo $profuserdata['years_of_practice'];?>yrs in Practice
	                </p>
					
				<?php $country_name = $this->db->get_where('countries',array('countries_id'=>$profile['location']))->row_array()['countries_name'];
                    if(!empty($profuserdata['location'])){ ?>
                    <tr>
                        <td>Location</td> 
                        <td><?php echo $country_name; ?></td>
                    </tr>
                    <?php } 
                    if(!empty($profuserdata['added_on'])){ ?>
                    <tr>
                        <td>Registered Date</td>
                        <td><?php echo $profuserdata['added_on'];?></td>
                    </tr>
                    <?php } 
                    if(!empty($profuserdata['prc_acceditation_number'])){ ?>
                    <tr>
                        <td>Accreditation number</td>
                        <td><?php echo $profuserdata['prc_acceditation_number'];?></td>
                    </tr>
                    <?php }
                    if(!empty($profuserdata['validity']) && $profuserdata['validity'] !== '0000-00-00'){ ?>
                    <tr>
                        <td>Validity</td>
                        <td><?php if($profuserdata['validity']!='1001-01-01'){echo $profuserdata['validity'];}else{echo 'Life Time';}?></td>
                    </tr>
                    <?php }
                    if(!empty($profuserdata['company_email'])){ ?>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $profuserdata['company_email'];?></td>
                    </tr>
                    <?php }
                    if(!empty($profuserdata['representative'])){ ?>
                    <tr>
                        <td>Contact Person</td>
                        <td><?php echo $profuserdata['representative'];?></td>
                    </tr>
                    <?php }
                    if(!empty($profuserdata['position'])){ ?>
                    <tr>
                        <td>Position</td>
                        <td><?php echo $profuserdata['position'];?></td>
                    </tr>
                    <?php } 
                    if(!empty($profuserdata['mobile'])){?>
                    <tr><td>Tel Number</td>
                        <td><?php echo $profuserdata['mobile'];?></td></tr>
                    <?php } ?>
                  </table>
                <p>
                		<!-- Contact Number: 9876543210 
                			 <br> CP: 123456
	                    	 <br> Landline: 123456
	                    	 <br> Skype: maryann -->
                </p>
				
				
				<!--<a href="<?=$profuserdata['fb_url']; ?>">
                <img src="<?php echo ASSETS_URL;?>images/fb-share.png" alt="<?=$profuserdata['fb_url']; ?>"></a>-->
                </div>
                <div class="col-sm-9 user-profile-detail">
                    <div class="profile-name">
                        <h1><?php echo ucfirst($profuserdata['name']);?></h1>
                        <?php echo $profuserdata['profession'];?>
                    </div>
					<div style="right: 0;top: 0;" class="mob-social">
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
						<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
						<a class="a2a_button_facebook"></a>
						<a class="a2a_button_twitter"></a>
						<a class="a2a_button_google_plus"></a>
					</div>
					<script async src="https://static.addtoany.com/menu/page.js"></script>
				</div></br>
				
                    <ul class="nav 	nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#step1">Education</a></li>
                        <?php if(count($practicegetdata) > 0){
				echo '<li><a data-toggle="tab" href="#step2">Professional Practice / Employment Record</a></li>';
				}
			?>
                        <?php if(count($citationsgetdata) > 0){
				echo '<li><a data-toggle="tab" href="#step3">Awards/Citations/ Books</a></li>';
			} ?>
                        <?php if(count($affiliationgetdata) > 0){
				echo '<li><a data-toggle="tab" href="#step4">Professional Affiliation</a></li>';
			} ?>
                        <?php if(count($professionfiles) > 0){
				echo '<li><a data-toggle="tab" href="#step5">Awards</a></li>';
				} ?>
                        <li><a data-toggle="tab" href="#step6">Portfolio</a></li>
                    </ul>
                    <div class="tab-content steps-detail">
                        <div id="step1" class="tab-pane fade in active">
                            <h3 class="border-title text-left">Education</h3>
                            <?php 
					if($profuserdata['edu_elementary'] !=""){
						echo '<p>Elementary: '.$profuserdata['edu_elementary'].'</p>';
					}if($profuserdata['edu_high_school'] !=""){
						echo '<p>High School: '.$profuserdata['edu_high_school'].'</p>';
					}if($profuserdata['edu_college'] !=""){
						echo '<p>College: '.$profuserdata['edu_college'].'</p>';
					}if($profuserdata['edu_masteral'] !=""){
						echo '<p>Masteral: '.$profuserdata['edu_masteral'].'</p>';
					}if($profuserdata['edu_doctoral'] !=""){
						echo '<p>Doctoral: '.$profuserdata['edu_doctoral'].'</p>';
					}
					if($profuserdata['years_of_practice'] !=""){
					echo '<p>year: '.$profuserdata['years_of_practice'].'</p>';
					}
				?>
                        </div>
                        <div id="step2" class="tab-pane fade">
                            <h3 class="border-title text-left">Professional Practice / Employment Record</h3>
                            <?php
				if(count($practicegetdata) > 0){
					
					foreach($practicegetdata as $prac){
						echo '<div style="border:1px solid #f3f3f3;padding:10px;margin-bottom:10px;" ><div class="row" >
				<div class="col-sm-12 form-group">
					<label>Title: <b>'.$prac['practice_title'].'</b></label>
					
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 form-group">
					<label> Start Year: <b>'.$prac['practice_year_s'].'</b></label>
				</div>
				<div class="col-sm-6 form-group">
					<label> End Year: <b>'.$prac['practice_year_e'].'</b></label>
				</div>
					
				<div class="col-sm-6 form-group">
					<label>Name of Institution: <b>'.$prac['practice_highlights'].'</b></label>
					
				</div>
			</div></div>';
					}
				}
				?>
                        </div>
                        <div id="step3" class="tab-pane fade">
                            <h3 class="border-title text-left">Awards/Citations/ Books</h3>
                            <?php
					if(count($citationsgetdata) > 0){
					
					foreach($citationsgetdata as $citat){
						echo '<div style="border:1px solid #f3f3f3;padding:10px;margin-bottom:10px;" ><div class="row" >
							<div class="col-sm-12 form-group">
								<label>Title: <b>'.$citat['citations_title'].'</b></label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Start Year: <b>'.$citat['cit_year_s'].'</b></label>
							</div>
							<div class="col-sm-6 form-group">
								<label>End Year: <b>'.$citat['cit_year_e'].'</b></label>
							</div>
								
							<div class="col-sm-6 form-group">
								<label>Name of Institution: <b>'.$citat['cit_highlights'].'</b></label>
								
							</div>
						</div></div>';
					}
				}
				?>
                        </div>
                        <div id="step4" class="tab-pane fade">
                            <h3 class="border-title text-left">Professional Affiliation</h3>
                            <?php
					if(count($affiliationgetdata) > 0){
					
					foreach($affiliationgetdata as $aff){
						echo '<div style="border:1px solid #f3f3f3;padding:10px;margin-bottom:10px;" ><div class="row" >
							<div class="col-sm-12 form-group">
								<label>Title: <b>'.$aff['aff_title'].'</b></label>
								
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>Start Year: <b>'.$aff['aff_year_s'].'</b> </label>
							</div>
							<div class="col-sm-6 form-group">
								<label>End Year: <b>'.$aff['aff_year_e'].'</b> </label>
							</div>
								
							<div class="col-sm-6 form-group">
								<label>Name of Institution: <b>'.$aff['aff_highlights'].'</b></label>
								
							</div>
						</div></div>';
					}
				}
				?>
                        </div>
                        <div id="step5" class="tab-pane fade">
                            <h3 class="border-title text-left">Awards</h3>
                            <?php
					if(count($professionfiles) > 0){
					
					foreach($professionfiles as $docts){
						if($docts['filetype'] == 'img'){
							if(file_exists('./assets/images/uploads/'.$docts['filename'])){
								echo '<div class="col-sm-3">
										<img src="'.ASSETS_URL.'images/uploads/'.$docts['filename'].'">
									</div>
								';
							}	
						}
					}
				}
				?>
                        </div>
                        <div id="step6" class="tab-pane fade">
                            <h3 class="border-title text-left">Portfolio</h3>
                             <?php
					if(count($professionfiles) > 0){
					
					foreach($professionfiles as $docts){
						if($docts['filetype'] == 'vid'){
							if(file_exists('./assets/images/uploads/'.$docts['filename'])){
								echo '<div class="col-sm-3">
										<img src="'.ASSETS_URL.'images/uploads/'.$docts['filename'].'">
									</div>
								';
							}	
						}
					}
				}
				?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    jQuery(document).ready(function($) {
        var events = $('.owl-events');
        events.owlCarousel({
            loop: true,
            nav: false,
            dots: false,
            smartSpeed: 450,
            autoplay: true,
            autoplayTimeout: 5000,
            margin: 30,
            responsive: {
                320: { items: 1 },
                480: { items: 1 },
                600: { items: 1 },
                960: { items: 2 },
                1200: { items: 2 }
            }
        });
    });
    </script>
    <script src="js/owlcarousel/owl.carousel.js"></script>
    <script type="text/javascript" src="js/plugin.js"></script>
    </body>

    </html>
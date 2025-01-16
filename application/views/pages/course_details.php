<?php $this->load->view('template/search'); ?>
<div class="innerContent">
    <div class="container">
        <div class="row displayflex">
            <div class="col-md-8">
                <?php $this->load->view('template/coursemenu'); ?>
               <!-- <p><strong>Credit Units/Contact Hours : </strong><?php echo $course[0]['units'];?></p> -->


                <p><img src="<?php echo ASSETS_URL.'images/uploads/'.$course[0]['course_photo']; ?>" alt="<?=$course[0]['course_photo'];?>"></p>
 
                <p><strong>Units : </strong><?php echo $course[0]['units'];?></p>
				<?php if(empty($course[0]['insititution_id']) ){ ?>
                <p><strong>Price : </strong><?php echo '$'.floatval($course[0]['total']);?></p>
                <?php } ?>
				
				<p><strong>Accreditation No : </strong><?php echo $course[0]['course_acceditation_number'];?></p>
                <p><strong>Course Validity : </strong><?php echo ($course[0]['course_validity'] != '0000-00-00')?date( 'F j, Y', strtotime($course[0]['course_validity'])):'N/A';?></p>
                <?php $stringddata = "";
				if($course[0]['profession'] != ''){
					$profession  = $this->user->get_professions($course[0]['profession']); 
					// print_r("working".$course[0]['profession']);
					
					$count = 1;
					foreach ($profession as $key => $value) {
						$commsa = ($count > 1)?', ':'';
						$stringddata .= $commsa.$value['cat_name'];
						$count++;
					}
				}else{
					$stringddata = "N/A";
				} ?>
                <p><strong>Other professions who can use this course : </strong><?php echo $stringddata;?></p>



                <p><strong>Course Description</strong></p>
                <p>
                    <?php echo $course[0]['course_description'];?>
                </p>

                <?php 
                if($course[0]['objective']){
                ?>
                <p><strong>Course Objectives</strong></p>
                 <p>
                    <?php echo $course[0]['objective'];?>
                </p>

                <?php if($course[0]['course_video']){ ?>
                <p><video width="700" height="300" controls="controls" preload="auto" autoplay poster="path-to-poster.jpg">
                <source src="<?php echo BASE_URL.'assets/images/uploads/'.$course[0]['course_video'];?>" type="video/mp4" />
                <source src="path-to-webm.webm" type="video/webm" />
                <source src="path-to-ogv.ogv" type="video/ogg" />
                </video></p>    
                <?php } ?>    
                <?php } ?>

                <?php   $provider_id = $course[0]['author_reference_id']!="" ? $course[0]['author_reference_id']:$course[0]['user_id'];
                        $udata = $this->user->get_record_by_field_name_all_record('tbl_user','id',$provider_id); ?>
                <h3 class="border-title text-left">CE Provider</h3>

                <div class="row">
                    <div class="bolghome col-md-4">
                        <div class="new-training-box">
                            <a href="<?php echo site_url('share/viewprofile/'.$udata[0]['id'].'');?>">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image">
                                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$udata[0]['image'];?>" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title"><?php echo $udata[0]['name'];?></h5>
                                    <div class="training-box_text"><?php echo $udata[0]['profession'];?></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


                <!-- <div class="row staff-team">
                    <div class="col-md-3 col-xs-6 text-center">
                        <div class="staff-item">
                            <a target="_blank" href="<?php echo site_url('users/profile/'.$udata[0]['id'].'');?>">
                            <div class="thumb"><img src="<?php echo ASSETS_URL; ?>images/uploads/<?php echo $udata[0]['image'];?>" alt=""></div>
                        </a>
                            <div class="team-details">
                                <a target="_blank" href="<?php echo site_url('users/profile/'.$udata[0]['id'].'');?>">
                                <h5><?php echo $udata[0]['name'];?></a></h5>
                                <h6><?php echo $udata[0]['profession'];?></h6>
                                <div class="social-icons">
                                    <a href="<?php echo $udata[0]['fb_url'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                    <a href="<?php echo $udata[0]['gpus_url'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
                                    <a href="<?php echo $udata[0]['tw_url'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="<?php echo $udata[0]['insta_url'];?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <?php $this->load->view('pages/sidebar'); ?>
        </div>
    </div>
</div>
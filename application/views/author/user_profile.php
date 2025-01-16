<?php $uid = $this->session->userdata('logged_in')['id']; ?>


<?php 
// $profuserdata = $this->db->get_where('tbl_professionals',array('user_id'=>$this->session->userdata('logged_in')['id']))->row_array();
$profuserdata = $this->db->get_where('tbl_professionals',array('user_id'=>$uid))->row_array();
$citationsgetdata = $this->db->get_where('tbl_citations_list',array('pro_id'=>$profuserdata['pro_id']))->result_array();

$certificate = $this->db->get_where('tbl_existing_certificate')->result_array();

$practicegetdata = $this->db->get_where('tbl_practice_list',array('pro_id'=>$profuserdata['pro_id']))->result_array();
$affiliationgetdata = $this->db->get_where('tbl_affiliation_list',array('pro_id'=>$profuserdata['pro_id']))->result_array();
$uploadedimg = $this->db->get_where('tbl_user_docutments',array('user_id'=>$this->session->userdata('logged_in')['id'],'filetype'=>'img'))->result_array();
$uploadedvideo = $this->db->get_where('tbl_user_docutments',array('user_id'=>$this->session->userdata('logged_in')['id'],'filetype'=>'video'))->result_array();
$where = array('tbl_user_subscription_buy.user_id'=>$this->session->userdata('logged_in')['id'],'tbl_user_subscription_buy.sub_status'=>'1');
$join = array('tbl_user_subscription_packages', 'tbl_user_subscription_packages.subs_id=tbl_user_subscription_buy.subs_id');
//$subscription = $this->join($join[0], $join[1])->get_where('tbl_user_subscription_buy', $where)->result_array();
$subscriptionimg = $this->db->join($join[0], $join[1])->get_where('tbl_user_subscription_buy',$where)->row_array();
//print_r($subscription);
//echo count($uploadedimg);
$dailyprices = $this->user->get_record_by_field_name_all_record('tbl_misc','status',1);
if($subscriptionimg['sub_status'] == '1'){
    $uploadnophoto = $subscriptionimg['subs_no_photo'];
    $uploadnovideo = $subscriptionimg['subs_no_video'];
    if(is_array($uploadedimg) && count($uploadedimg) >0){
        $uploadnophoto = $subscriptionimg['subs_no_photo']-count($uploadedimg);
        $uploadnovideo = $subscriptionimg['subs_no_video']-count($uploadedvideo);
    }
    if(is_array($uploadedvideo) && count($uploadedvideo) >0){
        $uploadnovideo = $subscriptionimg['subs_no_video']-count($uploadedvideo);
    }
}else{
    $uploadnophoto = 4;
    $uploadnovideo = 4;
}
?>



<?php $profile = $this->db->get_where('tbl_user',array('id'=>$this->uri->segment(3)))->row_array(); ?>
    <div class="banner-profile back-img">
    	<?php if ($profuserdata['background_photo']!='') { ?>
        <img src="<?php echo ASSETS_URL.'images/uploads/'.$profuserdata['background_photo'];?>" alt="<?php echo $profuserdata['background_photo'];?>">
        <?php } else { ?>
        <img src="<?php echo ASSETS_URL.'images/dummy-banner.jpg';?>" alt="dummy-profile">
        <?php } ?>
    </div>
        
    <div class="innerContent author-user-profile">
        <div class="container">
            <div class="row profile-dashboard author-profile">
                <div class="col-sm-3">
                    <div class="user-profile-thumb">
                        <?php if ($profuserdata['profile_photo']) { ?>
                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$profuserdata['profile_photo'];?>" alt="<?php echo $profuserdata['profile_photo'];?>">
                        <?php } elseif($profile['image']) {
                        ?>
                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$profile['image'];?>" alt="<?php echo $profuserdata['profile_photo'];?>">
                        <?php     
                        } else { ?>
                        <img src="<?php echo ASSETS_URL.'images/dummy-profile.jpg';?>" alt="dummy-profile">
                        <?php } ?>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                <tr>
                    <th width="30%">Name</th>
                    <td><?php echo $profile['name'];?></td>
                </tr>
                <tr>
                    <th>Profession</th>
                    <td><?php echo $profile['profession'];?></td>
                </tr>
               <!--  <tr>
                    <td>Username</td>
                    <td><?php //echo $profile['username_email'];?></td>
                </tr> -->
				<?php if(!empty($profile['location'])){ ?>
                <tr>
                    <th>Location</th> <?php $country_name = $this->db->get_where('countries',array('countries_id'=>$profile['location']))->row_array()['countries_name'] ;?>
                    <td><?php echo $country_name; ?></td>
                </tr>
				<?php } ?>
                <tr>
                    <th>Registered Date</th>
                    <td><?php echo $profile['added_on'];?></td>
                </tr>

                <tr>
                    <th>CP</th>
                    <td><?php echo $profile['under_provider'];?></td>
                </tr>
				<?php if(!empty($profile['mobile'])){ ?>
                <tr>
                    <th>Landline</th>
                    <td><?php echo $profile['mobile']; ?></td>
                </tr>
				<?php } ?>

                <?php if(!empty($profile['skype'])){ ?>

                 <tr>
                    <th>Skype</th>
                    <td><?php echo $profile['skype'];?></td>
                </tr>
                <?php } ?>

                            
            </table> 
        </div>
                </div>





                <div class="col-sm-9 user-profile-detail">
                    <div class="profile-name">
                        <h1><?php echo $profile['name'];?></h1>
                        <p><?php echo $profile['profession'];?></p>
                        <div class="mob-social">
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_google_plus"></a>
                            </div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                        </div>
                    </div>
                    <?php echo $this->session->flashdata('response');?> 
                    <ul class="nav 	nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#step1">Online Courses</a></li>
                        <li><a data-toggle="tab" href="#step3">Reviews</a></li>
                        <li><a data-toggle="tab" href="#education">Education</a></li>
                        <li><a data-toggle="tab" href="#professional_practics">Professional Practice / Employment Record</a></li>
                        <li><a data-toggle="tab" href="#award">Award/Citations/Books</a></li>
                        <li><a data-toggle="tab" href="#professional_affiliation">Professional Affiliation</a></li>
                       <!--  <li><a data-toggle="tab" href="#portfolio">Portfolio</a></li> -->
                       
                    </ul>
                    <div class="tab-content steps-detail">

                        <div id="step1" class="tab-pane fade in active">
                        <h3 class="border-title text-left">Online Courses</h3>
                        <div id="products" class="row view-group">

                <?php 
                //for ($i=0; $i<10; $i++) { 
                foreach ($allcourse as $key => $value) {
                $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
                $Lessons = $this->db->get_where('tbl_lesson',array('course_id'=>$value['id']))->result_array(); 
                $category_name = $this->db->get_where('tbl_category',array('id'=>$value['course_category']))->row_array()['cat_name'];
                $resa=$this->db->query("SELECT SUM(star_mark) AS one_s  FROM tbl_course_review where star_mark = 1 and course_id='".$value['id']."'")->row_array();
                $resb=$this->db->query("SELECT SUM(star_mark) AS two_s  FROM tbl_course_review where star_mark = 2 and course_id='".$value['id']."'")->row_array();
                $resc=$this->db->query("SELECT SUM(star_mark) AS three_s  FROM tbl_course_review where star_mark = 3 and course_id='".$value['id']."'")->row_array();
                $resd=$this->db->query("SELECT SUM(star_mark) AS four_s  FROM tbl_course_review where star_mark = 4 and course_id='".$value['id']."'")->row_array();
                $rese=$this->db->query("SELECT SUM(star_mark) AS five_s  FROM tbl_course_review where star_mark = 5 and course_id='".$value['id']."'")->row_array();
                  
                $ss=$rese['five_s'] + $resd['four_s']+ $resc['tthree_s'] + $resb['two_s']+ $resa['one_s'];
                    if($ss)
                    {                       
                        $avg=round(((5 * $rese['five_s']) + (4*$rese['four_s'])  + (3*$rese['three_s']) + (2*$rese['two_s']) + (1*$rese['one_s'])) / ($ss));
                    }else
                    {
                        $avg=0;
                    }
                ?>    
                <div class="item col-xs-4 col-lg-4">
                    <div class="thumbnail card">
                        <div class="img-event">
                           <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>" class="course-image"><img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo'];?>" alt=""><!-- <span class="badge-featured red">Featured</span> --></a>
                        </div>
                        <div class="caption card-body">
                            <h5><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>">bhy</a></h5>
                        <div class="clear-line"> </div>
                                    <p>By : <?php echo $providername['name'];?></p>
                                    <ul class="course-meta">
                                        <li style="list-style-type: none;"><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $category_name; ?></a> | <?php echo count($Lessons);?> Lessons</li>
                                    </ul>
                                <div class="course-data">
                                    <div class="course-duration"><i class="fa fa-list-ol"> </i> CPD Unit <?php echo $value['units'];?></div>
                                    <div class="post-ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="price-btn">
                                    <?php 
                                         if($this->session->userdata('logged_in')['id']==""){
                                            ?>
                                    <a href="<?php echo site_url('users');?>">
                                        <input type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW">
                                    </a>
                                    <?php 
                                         } else {
                                        ?>
                                    <input onclick="paynow('<?php echo $value['id']; ?>','<?php echo $value['price']; ?>')" type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW">
                                    <?php 
                                        }
                                        ?>
                                </div>

                        </div>
                    </div>
                </div>
                <?php } ?> 
            </div>    

                        </div>

          

            <div id="step3" class="tab-pane fade in">
            <h3 class="border-title text-left">Reviews</h3>
                <div class="well well-sm">
                    <div class="row" id="post-review-box">

                        <div class="col-md-6">
                        <?php echo validation_errors(); ?>
                            <form enctype="multipart/form-data" class="jNice" accept-charset="utf-8" method="post" action="<?php echo site_url('users/index1');?>">  
                                <input id="ratings-hidden" name="rating" type="hidden"> 
                                <input id="idd" name="idd" type="hidden" value="<?php echo $this->uri->segment(3);?>"> 
                                <textarea required class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
                                    <div class="text-right">
                                        <div class="stars starrr" data-rating="0"></div>
                                <?php $uid = $this->session->userdata('logged_in')['id'];     
                                    if($uid ==""){  ?>
                                    <a href="<?php echo site_url('users');?>">
                                    <button class="btn btn-success btn-lg" type="button">Save</button>
                                    </a>
                                <?php } else { ?> 
                                    <button class="btn btn-success btn-lg" type="submit">Save</button>
                                <?php } ?>
                                    </div>

                            </form>
                        </div>

                        <div class="col-md-6">
                        <?php foreach ($review as $key => $value) { ?>
                        <span style="font-weight: bold;">By Deepak <?php echo  date("l jS \of F Y",strtotime($value['added_on'])) ?></span>
                        <p><?php echo $value['review'];?></p>   
                        <?php  } ?>
                        </div>
                    </div>
                </div> 
            </div>


             <div id="education" class="tab-pane fade in">
                <h3 class="border-title text-left">Education</h3>
                <div class="table-responsive">
                <table class="table table-striped">
 


                    <tr>
                        <td width="30%">Elementary</td>
                        <td><?php echo $profuserdata['edu_elementary'];?></td>
                    </tr>
                    <tr>
                        <td>High School</td>
                        <td><?php echo $profuserdata['edu_high_school'];?></td>
                    </tr>
                    <tr>
                        <td>College</td>
                        <td><?php echo $profuserdata['edu_college'];?></td>
                    </tr>


                      <tr>
                        <td>Masteral</td>
                        <td><?php echo $profuserdata['edu_masteral'];?></td>
                    </tr>


                    
                    <tr>
                        <td>Doctoral</td>
                        <td><?php echo $profuserdata['edu_doctoral'];?></td>
                    </tr>                           
                </table> 
              </div>
            </div>



            <div id="professional_practics" class="tab-pane fade in">
                <h3 class="border-title text-left">Professional Practice / Employment Record</h3>
                <div class="table-responsive">
                <table class="table table-striped"> 
                
                <?php 
                if(count($practicegetdata) > 0){
                    ?>
                     <tr style="font-weight: bold !important;">
                        <td>Title</td>
                         <td>Start Year</td>
                         <td>End Year</td>
                         <td>Highlights</td>
                     </tr>
                    <?php  foreach($practicegetdata as $prac){ ?>
                    <tr>
                        <td><?php echo $prac['practice_title'];?></td> 
                        <td><?php echo $prac['practice_year_s'];?></td> 
                        <td><?php echo $prac['practice_year_e'];?></td> 
                        <td><?php echo $prac['practice_highlights'];?></td>
                    </tr>
                <?php  } 
                    } ?>
                </table> 
                </div>
            </div>


             <div id="award" class="tab-pane fade in">
                <h3 class="border-title text-left">Award/Citations/Books</h3>
                <div class="table-responsive">
                <table class="table table-striped"> 

                <?php 
                if(count($citationsgetdata) > 0){
                    ?>
                     <tr style="font-weight: bold !important;">
                        <td>Title</td>
                         <td>Start Year</td>
                         <td>End Year</td>
                         <td>Highlights</td>
                     </tr>
                    <?php 
                    foreach($citationsgetdata as $citat){
                    ?>
                        <tr>
                        <td><?php echo $citat['citations_title'];?></td> 
                        <td><?php echo $citat['cit_year_s'];?></td> 
                        <td><?php echo $citat['cit_year_e'];?></td> 
                        <td><?php echo $citat['cit_highlights'];?></td>
                        </tr>
                <?php 
                } 
                }
                ?>                          
                </table> 
            </div>
            </div> 


            <div id="professional_affiliation" class="tab-pane fade in">
                <h3 class="border-title text-left">Professional Affiliation</h3>
                <div class="table-responsive">
                <table class="table table-striped">

            <?php 
                if(count($affiliationgetdata) > 0){
                    ?>
                     <tr style="font-weight: bold !important;">
                        <td>Title</td>
                         <td>Start Year</td>
                         <td>End Year</td>
                         <td>Highlights</td>
                     </tr>
                    <?php 
                    foreach($affiliationgetdata as $aff){
                    ?>
                        <tr>
                        <td><?php echo $aff['aff_title'];?></td> 
                        <td><?php echo $aff['aff_year_s'];?></td> 
                        <td><?php echo $aff['aff_year_e'];?></td> 
                        <td><?php echo $aff['aff_highlights'];?></td>
                        </tr>
                <?php 
                } 
                }
                ?>                                
                </table> 
            </div>
            </div>  






            <div id="portfolio" class="tab-pane fade in">
                <h3 class="border-title text-left">Portfolio</h3>
                <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <td width="30%">Name</td>
                        <td><?php echo $profile['name'];?></td>
                    </tr>
                    <tr>
                        <td>Profession</td>
                        <td><?php echo $profile['profession'];?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><?php echo $profile['username_email'];?></td>
                    </tr>
                    <tr>
                        <td>Location</td><?php $country_name = $this->db->get_where('countries',array('countries_id'=>$profile['location']))->row_array()['countries_name'] ;?>
                        <td><?php echo $country_name; ?></td>
                    </tr>
                    <tr>
                        <td>Registered Date</td>
                        <td><?php echo $profile['added_on'];?></td>
                    </tr>                           
                </table> 
            </div>
            </div>

            



    </div>
</div>




            </div>
        </div>
    </div>


 

  
<a href="#" id="scroll" style="display: block;"><span></span></a>
<style type="text/css">
    .profile-dashboard .user-profile-detail .nav>li>a{
        font-size: 18px;
    }
</style>

    </body>

    </html>
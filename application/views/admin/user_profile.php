<?php ///$this->load->view('admin/picture'); ?>
    <div class="banner-profile back-img">
    	<?php if ($profile['backimage']!='') { ?>
        <img src="<?php echo ASSETS_URL.'images/uploads/'.$profile['backimage'];?>" alt="">
        <?php } else { ?>
        <img src="<?php echo ASSETS_URL.'images/dummy-banner.jpg'; ?>">
        <?php } ?>
    </div>
        
    <div class="innerContent">
        <div class="container">
            <div class="row profile-dashboard author-profile">
                <div class="col-sm-3">
                    <div class="user-profile-thumb">
                        <?php if ($profile['image']) { ?>
                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$profile['image'];?>" alt="<?php echo $profuserdata['name'];?>">
                        <?php } else { ?>
                        <img src="<?php echo ASSETS_URL.'images/dummy-profile.jpg'; ?>">
                        <?php } ?>
                    </div>
                    <table class="table table-striped">
                        <?php //echo '<pre>'; print_r($profile); ?>
                    <tr>
                        <td width="30%">Name</td>
                        <td><?php echo $profile['name'];?></td>
                    </tr>
                    <tr>
                        <td>Profession</td>
                        <td><?php echo $profile['profession'];?></td>
                    </tr>
                   <!--  <tr>
                        <td>Username</td>
                        <td><?php //echo $profile['username_email'];?></td>
                    </tr> -->
                    <tr>
                        <td>Location</td> <?php $country_name = $this->db->get_where('countries',array('countries_id'=>$profile['location']))->row_array()['countries_name'] ;?>
                        <td><?php echo $country_name; ?></td>
                    </tr>
                    <tr>
                        <td>Registered Date</td>
                        <td><?php echo $profile['added_on'];?></td>
                    </tr>
                    <?php if(!empty($profile['accreditation_web'])){ ?>
                    <tr>
                        <td>Accreditation number</td>
                        <td><?php echo $profile['accreditation_web'];?></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if(!empty($profile['validity'])){ ?>
                    <tr>
                        <td>Validity</td>
                        <td><?php if($profile['validity']!='1001-01-01'){echo $profile['validity'];}else{echo 'Life Time';}?></td>
                    </tr>
                    <?php } ?>

                    <?php if(!empty($profile['company_email'])){ ?>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $profile['company_email'];?></td>
                    </tr>
                    <?php } ?>
                    
                    <?php if(!empty($profile['representative'])){ ?>
                    <tr>
                        <td>Contact Person</td>
                        <td><?php echo $profile['representative'];?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($profile['position'])){ ?>
                    <tr>
                        <td>Position</td>
                        <td><?php echo $profile['position'];?></td>
                    </tr>
                    <?php } ?>
                    <?php if(!empty($profile['mobile'])){ ?>
                    <tr>
                        <td>Tel Number</td>
                        <td><?php echo $profile['mobile'];?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                    <td colspan="2" class="fbbutton-viewmypage">
                        <a href="<?php echo $profile['fb_url'];?>">Facebook</a>
                    </td>
                    </tr>
                    </table> 
                </div>





                <div class="col-sm-9 user-profile-detail">
                    <div class="profile-name">
                        <h1><?php echo ucwords($profile['name']);?></h1>
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
                        <?php if($profile['role']!=6){ ?>
                        <li><a data-toggle="tab" href="#step2">Trainings/Seminars</a></li>
                        <?php } ?>
                        <li><a data-toggle="tab" href="#step3">Reviews</a></li>
                        <li><a data-toggle="tab" href="#step4">Company Profile</a></li>
                       
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
                ?>    
                <div class="item col-xs-4 col-lg-4">
                    <div class="thumbnail card">
                        <div class="img-event">
                           <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>" class="course-image"><img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo'];?>" alt=""><!-- <span class="badge-featured red">Featured</span> --></a>
                        </div>
                        <div class="caption card-body">
                            <h5><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"><?php echo $value['course_title'];?></a></h5>
						
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
                                        <input type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW $<?php echo $value['price']; ?>">
                                    </a>
                                    <?php 
                                         } else {
                                        ?>
                                    <input onclick="buycoursenow('<?php echo $value['id']; ?>','<?php echo $value['price']; ?>')" type="button" class="btn btn-primary col-xs-12" name="buynow" value="BUY NOW $<?php echo $value['price']; ?>">
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

            <div id="step2" class="tab-pane fade in">
            <h3 class="border-title text-left">Trainings/Seminars</h3>
            <?php foreach ($seminar as $key => $value) {
                //echo '<pre>'; print_r($value); die;    ?>
                <div class="traning-seminar-wrap">
                    <div class="row">
                        <div class="col-sm-4 traning-seminar-profiles">
                            <a href="<?php echo site_url('pages/training_details/').$value['id']; ?>"><img src="<?php echo ASSETS_URL.'images/uploads/'.$value['image']; ?>" alt=""></a>
                        </div>
                        <div class="col-sm-8">
                            <div class="splms-event-details">
                                <h3><a href="<?php echo site_url('pages/training_details/').$value['id']; ?>"><?php echo ucfirst($value['title']);?></a></h3>
                                <ul class="event-info-list">
                                    <li><i class="fa fa-calendar"></i>
                                        <?php echo $value['start_date'];?> @
                                        <?php echo $value['start_time'];?>
                                    </li>
                                    <li><i class="fa fa-map-marker"></i>
                                        <?php echo $value['location'];?>
                                    </li>
                                </ul>
                                <p>
                                    <?php 
                                        $description =  substr(strip_tags($value['description']),0,150);
                                          echo wordwrap($description,15,"<br>\n");  
                                        ?>...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
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


            <div id="step4" class="tab-pane fade in">
                <h3 class="border-title text-left">Company Profile</h3>
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

 <form action="<?php echo PAYAPAL_URL; ?>" method="post" name="coursebuyformPayPal1" id="coursebuyformPayPal1">
        <input type="hidden" name="business" value="<?php echo PAYAPAL_ID; ?>">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="item_name" id="item_name" value="">
        <input type="hidden" name="item_number" value="1">
        <input type="hidden" name="credits" value="510">
        <input type="hidden" name="userid" value="<?php echo $this->session->userdata('logged_in')['id']; ?>">
        <input type="hidden" name="amount" id="amount" value="">
        <input type="hidden" name="tax" value="0"> 
        <input type='hidden' name='rm' value='2'>
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="handling" value="0">
        <input type="hidden" name="cancel_return" value="<?php echo site_url('pages/cancelpayment');?>">
        <input type="hidden" name="return" value="<?php echo site_url('pages/success');?>"> 
    </form> 

  

<style type="text/css">
    .profile-dashboard .user-profile-detail .nav>li>a{
        font-size: 18px;
    }
</style>
<script type="text/javascript">
	function buycoursenow(caurse_id,amount) {
		$('#item_name').val(caurse_id);
		$('#amount').val(amount);
		document.getElementById("coursebuyformPayPal1").submit();
	}
</script>
    </body>

    </html>
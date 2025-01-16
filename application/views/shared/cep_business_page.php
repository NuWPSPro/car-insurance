
<?php  if (!empty($userdetails['backimage'])) { $bgurl = ASSETS_URL."images/uploads/".$userdetails['backimage']; }else{ $bgurl = ASSETS_URL.'images/dummy-banner.png'; } 
$cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
$country = $userdetails['country'];
$country_name = $this->db->get_where('countries',array('countries_id'=>$country))->row_array()['countries_name']; ?>

<div id="slider">
    <div id="slider-container" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="item">
                <img src="<?php echo $bgurl; ?>" alt="Back-Image">
            </div>
        </div>
    </div>
    <div id="slider-search-container">
        <div class="slider-search">
            <h4 style="font-style: normal; font-size: 60px;">
                <?php echo ucfirst($userdetails['name']);?>
            </h4>
            <h4 style="font-style: normal;">
                <?php echo $userdetails['tag_line'];?>
            </h4>

            <a href="#div1" class="commonBttn bg-blue">online courses</a>
            <a href="#newsletter" class="commonBttn bg-white">training/seminars</a>
        </div>

        <div style="position: absolute;right: 46%;top: 284px;" class="row pt-5 mob-social">
            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                <a class="a2a_button_facebook"></a>
                <a class="a2a_button_twitter"></a>
                <a class="a2a_button_google_plus"></a>
            </div>
            <script async src="https://static.addtoany.com/menu/page.js"></script>
        </div>
    </div>
</div>


<section class="speaking">
    <div class="container">
        <div class="speakingslider">
            <?php 
            if(isset($authors) && !empty($authors)){ 
                foreach ($authors as $key => $value) { 
                    $img = ($value['image']=="")?"dummy-profile.jpg":$value['image']; ?>
                        
                <div class="item">
                    <div class="speakings-box">
                        <div class="speakings-imgbox">
                            <img src="<?=ASSETS_URL.'images/uploads/'.$img;?>" alt="<?php echo $value['name']; ?>" title="<?php echo $img;?>">
                        </div>
                        <div class="speakings-namebox">
                            <?php echo $value['name']; ?>
                        </div>
                        <a href="javascript:void(0);" class="author_detail" data-id="<?=$value['id']?>">Profile</a>
                        <a href="<?php echo base_url('share/viewprofile/').$value['id']; ?>">Page</a>
                    </div>
                </div>

            <?php } }else{ ?>
            <div class="item">
                <div class="speakings-box">
                    <div class="speakings-imgbox">
                        <img src="<?php echo base_url('assets/images/dummy-profile.jpg'); ?>" alt="">
                    </div>
                    <div class="speakings-namebox" id="bg-coler2">
                        Author 1
                    </div>
                    <a href="#">Profile</a>
                    <a href="#">Page</a>
                </div>
            </div>
            <div class="item">
                <div class="speakings-box">
                    <div class="speakings-imgbox">
                        <img src="<?php echo base_url('assets/images/dummy-profile.jpg'); ?>" alt="">
                    </div>
                    <div class="speakings-namebox" id="bg-coler2">
                        Author 2
                    </div>
                    <a href="#">Profile</a>
                    <a href="#">Page</a>
                </div>
            </div>
            <div class="item">
                <div class="speakings-box">
                    <div class="speakings-imgbox">
                        <img src="<?php echo base_url('assets/images/dummy-profile.jpg'); ?>" alt="">
                    </div>
                    <div class="speakings-namebox" id="bg-coler3">
                        Author 3
                    </div>
                    <a href="#">Profile</a>
                    <a href="#">Page</a>

                </div>
            </div>
            <div class="item">
                <div class="speakings-box">
                    <div class="speakings-imgbox">
                        <img src="<?php echo base_url('assets/images/dummy-profile.jpg'); ?>" alt="">
                    </div>
                    <div class="speakings-namebox" id="bg-coler4">
                        Author 4
                    </div>
                    <a href="#">Profile</a>
                    <a href="#">Page</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
        
<section style="background: #d0720d;">
    <div class="container">
        <h3 class="text-white text-center text-uppercase">Author/s of countinuing education courses</h3>
    </div>
</section>

<div class="weOffer py-2">
    <div class="container">
        <div class="row" id="div1">
            <div class="online-latest targetDiv">
                <h3 class="border-title text-center title-heading">ONLINE COURSES</h3>
                <div class="search-date  text-center" style="display:block;">
                    <form id="courseform" class="searchform" action="<?php echo current_url(); ?>">
                        <div class="input-box-select">
                            <input type="text" class="form-control" name="course_title" id="course_title"
                                placeholder="ENTER COURSE TITLE" value="<?php echo $_REQUEST['course_title']; ?>">
                            <!-- <input type="hidden" class="form-control" name="method" id="method" value="<?php echo $userdetails['insititution_id']; ?>"> -->
                        </div>
                        <div class="input-box-select">
                            <select name="category" class="form-control dropDown">
                                <option value="" selected="">PROFESSION</option>
                                <?php foreach ($cat as $key => $value) { ?>
                                <option <?php if($value['id']==$param['course_category']){ echo "selected" ; } ?>
                                    value="
                                    <?php echo $value['id']?>">
                                    <?php echo $value['cat_name'];?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="input-box-select">
                            <a href="javascript:void(0)" onclick="jQuery('#courseform').submit();" class="btn search"><i
                                    class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
                        </div>
                    </form>
                </div>

                <?php  if(isset($allcourse) && !empty($allcourse)){ ?>
                <div class="owl-carousel-3 nav-button">
                    <?php   foreach ($allcourse as $key => $value) {
                   $providername = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array();
                   $Lessons = $this->db->get_where('tbl_lesson',array('course_id'=>$value['id']))->result_array(); ?>
                    <div class="item">
                        <div class="course-item">
                            <div class="course-double">
                                <?php if($value['course_validity']>= date('Y-m-d')) { ?>
                                <?php if($value['paid_status']==2) { ?>
                                <div class="corner"></div>
                                <span class="corner-text">Featured</span>
                                <?php  } }else{ ?>
                                <div class="corner" style="border-top: 100px solid #9c27b0;"></div>
                                <span class="corner-text">Finished</span>
                                <?php } ?>
                                <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"
                                    class="course-image">
                                    <img src="<?php echo ASSETS_URL.'images/uploads/'.$value['course_photo'];?>"
                                        alt=""></a>
                                <div class="dt-sc-course-details">
                                    <a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>">
                                        <!--<div class="course-price">$<?php echo $value['price']; ?></div>-->
                                    </a>
                                    <h5><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>"
                                            title="<?php echo $value['course_title'];?>">
                                            <?php echo $value['course_title'];?>
                                        </a></h5>

                                    <div class="clear-line"></div>
                                    <p>By :
                                        <?php echo $providername['name'];?>
                                    </p>
                                    <ul class="course-meta">
                                        <li><a href="<?php echo site_url('pages/course_details/'.$value['id'].'');?>">
                                                <?php echo $value['cat_name']; ?>
                                            </a></li>
                                        <li>
                                            <?php echo count($Lessons);?> Lessons
                                        </li>
                                    </ul>

                                    <div class="course-data">
                                        <div class="course-duration"><i class="fa fa-list-ol"> </i> CE Units
                                            <?php echo $value['units'];?>
                                        </div>
                                        <div class="post-ratings">
                                            <?php for($i=1;$i<=5;$i++){
											if($i<=$value['rating']){ 
                                                echo'<i class="fa fa-star" aria-hidden="true"></i>';
                                            }else{ 
                                                echo'<i class="fa fa-star" aria-hidden="true"></i>';
                                            } 
                                           } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                </div>
                <?php }else { echo '<p><center><b>No Record Found!!!</b></center></p>'; } ?>
            </div>
        </div>
    </div>
</div>




<div class="newsletter-section">
    <div class="container">
        <div id="newsletter">
            <h2>Get On Point In your Continuing Education <br>For Quality Service!</h2>
            <h6>Register Now or Log-in to get started</h6>
            <a href="<?php echo base_url('users'); ?>" class="btn btn-default btn-lg">
                <i class="fa fa-thumbs-o-up">login</i></a>

            <a href="javascript:void(0);" onclick="register_now()" class="btn btn-default btn-lg">
                <i class="fa fa-thumbs-o-up">Register</i></a>
        </div>
    </div>
</div>



<div class="weOffer py-2">
    <div class="container">
        <div class="row">
            <div class="online-latest targetDiv" id="div11">
                <h3 class="border-title text-center title-heading">TRAINING</h3>
                <div class="online-latest-bttn-box search-date text-center" style="display:block;">
                    <form id="traingform" class="searchform" action="<?php echo current_url(); ?>">
                        <div class="input-box-select">
                            <input type="text" class="form-control" name="training_title" id="traing_title"
                                placeholder="ENTER TRAINING TITLE" value="<?php echo $_REQUEST['training_title']; ?>">
                        </div>
                        <div class="input-box-select">
                            <select name="training_category" class="form-control dropDown">
                                <option value="" selected="">PROFESSION</option>
                                <?php foreach ($cat as $key => $value) { ?>
                                <option <?php if($value['id']==$param['training_category']){ echo "selected" ; } ?>
                                    value="
                                    <?php echo $value['id']?>">
                                    <?php echo $value['cat_name'];?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-box-select">
                            <div class="text-box ">
                                <input type="month" name="start_date" class="form-control" id="start_date"
                                    placeholder="TRAINING DATE" autocomplete="off"
                                    value="<?=$_REQUEST['start_date'];?>">
                            </div>
                        </div>

                        <div class="input-box-select">
                            <select name="training_location" class="form-control" id="specificLocation">
                                <option value="">SPECIFIC LOCATION</option>
                                <?php foreach ($seminar as $key => $value) { ?>
                                <option <?php if($value['location']==$param['training_location']){ echo "selected" ; }
                                    ?> value="
                                    <?php echo $value['id']?>">
                                    <?php echo $value['location'];?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-box-select">
                            <a href="javascript:void(0)" onclick="jQuery('#traingform').submit();" class="btn search"><i
                                    class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
                        </div>
                    </form>
                </div>

                <?php if(isset($seminar) && !empty($seminar)){ ?>
                <div class="owl-carousel-3 nav-button">
                    <?php foreach ($seminar as $key => $value){  ?>
                    <div class="item">
                        <div class="course-item">
                            <div class="course-double">
                                <?php if($value['end_date']>= date('Y-m-d')) { ?>
                                <?php if($value['paid_status']==2) { ?>
                                <div class="corner"></div>
                                <span class="corner-text">Featured</span>
                                <?php  } }else{ ?>
                                <div class="corner" style="border-top: 100px solid #9c27b0;"></div>
                                <span class="corner-text">Finished</span>
                                <?php } ?>
                                <a href="<?php echo site_url('pages/training_details/').$value['id'];?>"
                                    class="course-image">
                                    <img style="height:298px"
                                        src="<?php echo ASSETS_URL.'images/uploads/'.$value['image'];?>" alt=""
                                        onError="this.onerror=null;this.src='<?php echo ASSETS_URL.'images/uploads/IMG_1560995024.png'; ?>">
                                </a>
                                <div class="dt-sc-course-details">

                                    <h5><a href="<?php echo site_url('pages/training_details/').$value['id'];?>"
                                            title="<?php echo $value['title'] ?>">
                                            <?php echo $value['title'] ?>
                                        </a></h5>

                                    <div class="clear-line"> </div>

                                    <ul class="course-meta">
                                        <li><i class="fa fa-calendar"></i>
                                            <?php echo $value['start_date'];?> @
                                            <?php echo $value['start_time'];?>
                                        </li>
                                    </ul>
                                    <ul class="course-meta pb-10">
                                        <li>
                                            <i class="fa fa-map-marker"></i>
                                            <?php echo $value['location'];?>
                                        </li>
                                    </ul>
                                    <p>
                                        <?php echo substr(strip_tags($value['description']),0,35);?>...
                                    </p>


                                    <div class="course-data">
                                        <div class="course-duration"><i class="fa fa-list-ol"> </i> CE Units
                                            <?php echo $value['units'];?>
                                        </div>
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
                <?php }else { echo '<p><center><b>No Record Found!!!</b></center></p>'; } ?>
            </div>
        </div>
    </div>
</div>


<div class="pb-5 pt-0 web-ce-provid">
    <div class="container">
        <div class="row pb-3">

            <div class="col-md-12">
                <h3 class="border-title border-title-h text-left">NEWS/BLOG</h3>
                <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
            </div>

            <div class="col-md-12">
                <?php if(count($blogs)>0){ ?>
                <div class="owl-blog">
                    <?php foreach($blogs as $blog){ ?>
                    <div class="owl-item-blog">
                        <div class="new-training-box">
                            <a href="<?php echo site_url('pages/blog_details/').$blog['id']; ?>">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image blog_images">
                                    <img src="<?php echo ASSETS_URL." upload/blog/".$blog['image']; ?>"
                                    onError="this.onerror=null;this.src='
                                    <?php echo ASSETS_URL."images/dummy-profile.jpg"; ?>';" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title">
                                        <?php echo $blog['title']; ?>
                                        <p class="newdate"><span><i class="fa fa-calendar-o"
                                                    aria-hidden="true"></i></span>
                                            <?php echo date('F d, y',strtotime($blog['date'])); ?>
                                        </p>

                                    </h5>
                                    <!-- <div class="training-box_text"><?php echo $blog['st_desc']; ?></div> -->
                                    <a href="<?=base_url('pages/blog_details/').$blog['id'];?>" class="read-button">Read
                                        More</a>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php }else{ echo 'No Data Found!'; } ?>
            </div>
        </div>

        <!-- <div class="row pb-3 web-auhter">
                <div class="col-md-8 ">
                    <h3 class="border-title border-title-h text-left">Authors</h3>
                    <div class="training-semi-slider-6 pagi-above">
                        <?php if(isset($authorlist) && !empty($authorlist)){ 
                            foreach ($authorlist as $key => $value) { 
                                $up = end(explode('-', $value['under_provider']));
                                $cep = $this->db->get_where('tbl_user',array('id'=>$up))->row_array()['name']; ?>
                        <div class="item">
                            <div class="training-semi">
                                <div class="new-training-box">
                                    <a href="<?php echo base_url('share/viewprofile/').$value['id']; ?>">
                                        <div class="training-box_overlay"></div>
                                        <div class="training-box-image author_images">
                                            <?php if($value['image']==""){  
                                                        // $img = "placeholder.jpg";
                                                        $img = "dummy-profile.jpg";
                                                    } else {
                                                        $img = $value['image'];
                                                    } ?>
                                            <img src="<?php echo ASSETS_URL.'images/uploads/'.$img;?>"
                                                alt="<?php echo $img;?>" title="<?php echo $img;?>">
                                        </div>
                                        <div class="training-box-caption">
                                            <h5 class="training-box_title">
                                                <?php echo $value['name']; ?>
                                            </h5>
                                            <div class="training-box_text">
                                                <?php echo 'CEP : '.$cep; ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php } }else{ echo 'No Data Found!'; } ?>
                    </div>
                </div>
                <div class="col-md-4">
                <h3 class="border-title border-title-h text-left">Sub Institutions</h3>
                <div class="training-semi-slider-7 pagi-above">
                    <?php 
                            if(isset($subinss) && !empty($subinss)){
                            foreach ($subinss as $key => $value) {   
                            $country = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name']; ?>
                    <div class="item">
                        <div class="training-semi training-semi-big">
                            <div class="new-training-box">
                                <a href="<?php echo site_url('share/viewprofile/').$value['id']; ?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image ins_images">

                                        <?php    if($value['backimage']==""){
                                                            $img = "dummy-profile.jpg";
                                                        } else {
                                                            $img = $value['backimage'];
                                                        }  ?>
                                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$img;?>" alt="<?php echo $img;?>"
                                            title="<?php echo $img;?>">
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
                    <?php  }  ?>
                    <?php  }else{ echo 'No Data Found!'; } ?>
                </div>
            </div> -->
    </div>
</div>



<section class="footer_map">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Country</td>
                            <td><?php echo $country_name; ?></td>
                        </tr>
                        <tr>
                            <td>Registered Date</td>
                            <td><?php echo date('jS F Y',strtotime($userdetails['added_on']));?></td>
                        </tr>
                        <?php if($userdetails['prc_acceditation_number']){?>
                        <tr>
                            <td>Accreditation number</td>
                            <td><?php echo $userdetails['prc_acceditation_number'];?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>Validity</td>
                            <td><?php if($userdetails['validity']!='1001-01-01'){ echo date('jS F Y',strtotime($userdetails['validity'])); }else{ echo 'Life Time'; }?>
                            </td>
                        </tr>
                        <tr>
                            <td>Contact Person</td>
                            <td><?php echo $userdetails['representative'];?></td>
                        </tr>
                        <tr>
                            <td>Position</td>
                            <td><?php echo $userdetails['position'];?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $userdetails['company_email'];?></td>
                        </tr>
                        <tr>
                            <td>Tel Number</td>
                            <td><?php echo $userdetails['mobile'];?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="map_bag">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.1257047704908!2d77.31873301508178!3d28.59600548243221!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce4f07f8c2613%3A0xa2555285fdd5842f!2sG-13%2C%20G%20Block%2C%20Sector%206%2C%20Noida%2C%20Uttar%20Pradesh%20110096!5e0!3m2!1sen!2sin!4v1635150658935!5m2!1sen!2sin"
                        width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                   
                    <div class="speakings-box">
                        <a href="javascript:void(0);" class="accModal" data-id="<?=$userdetails['accreditation_doc'];?>">Accreditation Certificate</a>
                        <a href="<?=base_url('pages/cfvalidation'); ?>">Digital Certificate Validation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="authorProfleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel">Author Profile</h5>
      </div>

        <div class="modal-body text-center">
            <p id="authdetails"></p>
        </div>

      <div class="modal-footer">
        <a href="javascript:void(0);" id="moreDetailsAuthor" target="_blank" class="btn btn-primary">More Details</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="accModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel">Accreditation Certificate</h5>
      </div>

        <div class="modal-body text-center">
            <!-- <p id="authdetails"></p> -->
            <iframe src="" id="accCertificatePath" frameborder="0" width="780" height="600"></iframe>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<style type="text/css">
   .input-box-select{width:195px}.owl-item-blog .training-box_title{-webkit-transform:translate3d(0,10px,0);transform:translate3d(0,10px,0)}.owl-item-blog .training-box-caption{height:83%}body{font-family:Arial,Helvetica,sans-serif;font-size:20px}#myBtn{display:none;position:fixed;bottom:20px;right:30px;z-index:99;font-size:18px;border:none;outline:0;background-color:#2f5597;color:#fff;cursor:pointer;padding:15px;border-radius:4px}#myBtn:hover{background-color:#555}
</style>

<script>
   $(document).ready(function(){$(".speakingslider").owlCarousel({center:true,loop:!0,margin:10,nav:!0,dots:!1,autoplay:!0,autoplaySpeed:2e3,dotsSpeed:2e3,responsive:{320:{items:1},360:{items:2},580:{items:2},768:{items:2},1000:{items:3}}})});var mybutton=document.getElementById("myBtn");function scrollFunction(){document.body.scrollTop>20||document.documentElement.scrollTop>20?mybutton.style.display="block":mybutton.style.display="none"}function topFunction(){document.body.scrollTop=0,document.documentElement.scrollTop=0}window.onscroll=function(){scrollFunction()},$(document).ready(function(){$(".owl-carousel-blog").owlCarousel({items:2,loop:!1,mouseDrag:!0,touchDrag:!1,pullDrag:!1,rewind:!0,autoplay:!0,margin:1,dots:!1})});

    $('.accModal').on('click', function(){
        var acc_doc = $(this).attr('data-id');
        var path ="<?php echo base_url('assets/images/uploads/'); ?>"+acc_doc;
        $('#accCertificatePath').attr('src',path+'#toolbar=0');
        $('#accModalView').modal('show');
    });

    $('.author_detail').on('click', function(){
        var author_id = $(this).attr('data-id');
        var path = "<?php echo base_url('share/viewprofile/');?>"+author_id;
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("provider/author_details");?>',
            data: { author_id : author_id },
            beforeSend: function(){
                $('#Preview_button').val('Please wait...');
            },
            success: function(result){
                $('#authdetails').html(result);
                $('#moreDetailsAuthor').attr('href',path);
                $('#authorProfleModal').modal('show');
            }
            
        });

    });
</script>
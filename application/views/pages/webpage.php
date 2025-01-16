<style type="text/css">
    .input-box-select{width:195px}.owl-item-blog .training-box_title{-webkit-transform:translate3d(0,10px,0);transform:translate3d(0,10px,0)}.owl-item-blog .training-box-caption{height:83%}body{font-family:Arial,Helvetica,sans-serif;font-size:20px}#myBtn{display:none;position:fixed;bottom:20px;right:30px;z-index:99;font-size:18px;border:none;outline:0;background-color:#2f5597;color:#fff;cursor:pointer;padding:15px;border-radius:4px}#myBtn:hover{background-color:#555}
</style>
<?php 
    $uid = $this->session->userdata('logged_in')['id'];
    $user_insid = $this->session->userdata('logged_in')['insititution_id'];
    $iid = $this->uri->segment(2);
    $parent_id = explode('-',$iid); 
    $userdetails = $this->user->get_record_by_field_name_all_record('tbl_user','insititution_id',$iid);
    $idd   = $userdetails[0]['id'];
    $where = array('role'=>2,'parent_insititution'=>$idd);
    $providers = $this->user->get_record_by_multi_field_name('tbl_user',$where);
    
	/* **************Course**************** */
	if($_REQUEST['category']){
		$where1   = array('course_category'=>$_REQUEST['category']);	
	}
    if($_REQUEST['course_title']){
		$where1   = $this->db->like('course_title', $_REQUEST['course_title']);
	}
	if($_REQUEST['method']){
		$where1   = array('insititution_id'=>$_REQUEST['method']);
	}else{
		$where1   = array('insititution_id'=>$iid, 'status'=>'1');
	}
    // $this->db->where('course_validity >=',date('Y-m-d'));
    $cources = $this->user->get_record_by_multi_field_name('tbl_course',$where1);  	
	//echo $this->db->last_query(); exit;
	//print_r($cources); exit;

	/***************Training**************** */
	
    if($_REQUEST['location']){
	 $where2   = array('location'=>$_REQUEST['location']);	 
	}
    if($_REQUEST['training_title']){
	 $where2   = $this->db->like('title', $_REQUEST['training_title']);
	}
	 if($_REQUEST['training_location']){
	 $where2   = $this->db->where('country_id', $_REQUEST['training_location']);
	} 
	if($_REQUEST['training_category']){
	 $where2   = $this->db->where('category_id', $_REQUEST['training_category']);
	}
    if($_REQUEST['start_date'])     {   
        $date = explode('-',$_REQUEST['start_date']);
        $this->db->where('YEAR(tbl_training.start_date) =',$date[0]); 
        $this->db->where('MONTH(tbl_training.start_date) =',$date[1]);  
    }
	$insititutionId = ($_REQUEST['method'])?$_REQUEST['method']:$iid;
   // $where2   = array('insititution_id'=>$_REQUEST['method'],'start_date >='=>date('Y-m-d'));
    $where2   = array('insititution_id'=>$insititutionId,'status'=>'2');
	
	$seminar = $this->user->get_record_by_multi_field_name('tbl_training',$where2);	
	//echo $this->db->last_query(); 
	?>

<?php $cat = $this->user->get_record_by_field_name_all_record_order_by_title_asc('tbl_category','status',1);
	  $sub_ins_list = $this->db
      ->get_where('tbl_user', array('role'=>5,'under_insititution'=>1,'parent_insititution'=>$user_insid,'status'=>1))
      ->result_array();
	  $countries = $this->user->get_countries();	?>
<div id="slider">
    <div id="slider-container" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="item"><img src="<?php echo ASSETS_URL.'images/uploads/'.$certificateData[0]['backimage']; ?>"
                    alt="Back-Image"></div>
        </div>
        <ol class="carousel-indicators">
            <li data-target="#slider-container" data-slide-to="0" class="active"></li>
        </ol>
    </div>
    <div id="slider-search-container">
        <div class="slider-search">
            <h4 style="font-style: normal; font-size: 60px;">
                <?php echo $certificateData[0]['name']; ?>
            </h4>
            <h4 style="font-style: normal;">
                <?php echo $certificateData[0]['tag_line']; ?>
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
                            <input type="hidden" class="form-control" name="method"
                                value="<?php echo $certificateData[0]['insititution_id']; ?>">
                        </div>
                        <div class="input-box-select">
                            <!-- <div class="selection-box "> -->
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
                            <!-- </div> -->
                        </div>

                        <div class="input-box-select">
                            <select name="category" class="form-control dropDown">
                                <option value="" selected="">Please select sub-instituition</option>
                                <?php if(isset($subinss) && !empty($subinss)){
									foreach ($subinss as $key => $value) { ?>
                                <option <?php if($value['id']==$param['ins_id']){ echo "selected" ; } ?> value="
                                    <?php echo $value['id']?>">
                                    <?php echo $value['name'];?>
                                </option>
                                <?php } }else{ ?>
                                <option value="">No Sub Instituition Found</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-box-select">
                            <a href="javascript:void(0)" onclick="jQuery('#courseform').submit();" class="btn search"><i
                                    class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
                        </div>
                    </form>
                </div>

                <?php  if(isset($course_list) && !empty($course_list)){ ?>
                <div class="owl-carousel-3 nav-button">
                    <?php   foreach ($course_list as $key => $value) {
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
                            <input type="hidden" class="form-control" name="method"
                                value="<?php echo $certificateData[0]['insititution_id']; ?>">
                        </div>
                        <div class="input-box-select">
                            <!-- <div class="selection-box "> -->
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
                            <!-- </div> -->
                        </div>
                        <div class="input-box-select">
                            <div class="text-box ">
                                <input type="month" name="start_date" class="form-control" id="start_date"
                                    placeholder="TRAINING DATE" autocomplete="off"
                                    value="<?=$_REQUEST['start_date'];?>">
                            </div>
                        </div>
                        <div class="input-box-select">
                            <select name="category" class="form-control dropDown">
                                <option value="" selected="">Please select sub-instituition</option>
                                <?php if(isset($subinss) && !empty($subinss)){
									foreach ($subinss as $key => $value) { ?>
                                <option <?php if($value['id']==$param['ins_id']){ echo "selected" ; } ?> value="
                                    <?php echo $value['id']?>">
                                    <?php echo $value['name'];?>
                                </option>
                                <?php } }else{ ?>
                                <option value="">No Sub Instituition Found</option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php  
                    $where2   = array('insititution_id'=>end($parent_id));
                    $t_location  = $this->user->get_record_by_multi_field_name('tbl_training',$where2); ?>
                        <div class="input-box-select">
                            <select name="training_location" class="form-control" id="specificLocation">
                                <option value="">SPECIFIC LOCATION</option>
                                <?php foreach ($t_location as $key => $value) { ?>
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

                <?php if(isset($trainin_list) && !empty($trainin_list)){ ?>
                <div class="owl-carousel-3 nav-button">
                    <?php foreach ($trainin_list as $key => $value){  ?>
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
                                        src="<?php echo ASSETS_URL.'images/uploads/'.$value['thumb_img'];?>" alt=""
                                        onError="this.onerror=null;this.src='https://ceonpoint.com/assets/images/dummy-profile.jpg'">
                                </a>
                                <div class="dt-sc-course-details">

                                    <h5><a href="<?php echo site_url('pages/training_details/').$value['id'];?>"
                                            title="<?=strtoupper($value['title']);?>">
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
            <div class="col-md-8">
                <h3 class="border-title border-title-h text-left">CE Providers</h3>
                <div class="training-semi-slider-6 pagi-above">
                    <?php if(isset($ceproviders) && !empty($ceproviders)){ 
                            foreach ($ceproviders as $key => $value) { 
                            $ins = end(explode('-', $value['parent_insititution']));
                            $institution = $this->db->get_where('tbl_user',array('id'=>$ins))->row_array()['name'];?>
                    <div class="item">
                        <div class="training-semi">
                            <div class="new-training-box">
                                <a href="<?php echo base_url('share/viewprofile/'.$value['id']);?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image provider_images">

                                        <?php if($value['image']==""){
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
                                            <?php echo 'Instituition : '.$institution; ?>
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
                <h3 class="border-title border-title-h text-left">NEWS/BLOG</h3>
                <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
            </div>

            <div class="col-md-4">
                <?php if(count($blogs)>0){ ?>
                <div class="owl-blog">
                    <?php foreach($blogs as $blog){ ?>
                    <div class="owl-item-blog">
                        <div class="new-training-box">
                            <a href="<?php echo site_url('pages/blog_details/').$blog['id']; ?>">
                                <div class="training-box_overlay"></div>
                                <div class="training-box-image blog_images">
                                    <img src="<?php echo ASSETS_URL."upload/blog/".$blog['image']; ?>"
                                    onError="this.onerror=null;this.src='
                                    <?php echo ASSETS_URL."images/dummy-profile.jpg"; ?>';" alt="">
                                </div>
                                <div class="training-box-caption">
                                    <h5 class="training-box_title">
                                        <?php echo $blog['title']; ?>
                                        <p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
                                        <?php echo date('F d, y',strtotime($blog['date'])); ?></p>
												
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

        <div class="row pb-3 web-auhter">
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
        </div>
        </div>

       

    </div>
</div>
</div>
<script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function redirect() {
        var path = "<?php echo base_url('pages/courses'); ?>";
        var dropDownValue = document.getElementsByClassName("dropDown").value;
        window.location.href = path + dropDownValue;
    }

    $(document).ready(function () {
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


    $('#countryDropDown').change(function () {
        var id = $(this).val();
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('pages/trainingcountry/'); ?>" + id,
            data: { 'id': id },
            success: function (result) {
                // alert(result);
                $("#specificLocation").html(result);
            }
        });
    });
</script>
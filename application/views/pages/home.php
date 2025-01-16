<style type="text/css"> .input-box-select .form-control { width: 220px; } </style>

<?php $current_country = $this->session->userdata('current_country'); ?>
<div class="service-process" style=" background: #e5e5e5;">
    <div class="container">

        <div class="row">

            <div class="col-sm-4 d-flex">
                <div class="service-icons">
                    <img src="https://png.pngtree.com/png-vector/20191027/ourmid/pngtree-car-insurance-vector-icon-png-image_1872330.jpg">
                </div>
                <div class="item-content">
                    <h3>2,043 <br>
                        Digital Certificates Issued
                    </h3>
                </div>
            </div>

            <div class="col-sm-4 d-flex">
                <div class="service-icons">
                    <img src="https://png.pngtree.com/png-vector/20191027/ourmid/pngtree-car-insurance-vector-icon-png-image_1872330.jpg">
                </div>
                <div class="item-content">
                    <h3>1,212 <br>
                        Car Owner Registered
                    </h3>
                </div>
            </div>

            <div class="col-sm-4 d-flex">
                <div class="service-icons">
                    <img src="https://png.pngtree.com/png-vector/20191027/ourmid/pngtree-car-insurance-vector-icon-png-image_1872330.jpg">
                </div>
                <div class="item-content">
                    <h3>1,191 <br>
                        Insurance Companies
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="weOffer">
    <div class="container">
        <div class="mt-4">
            <h3 class="text-center text-uppercase border-title mb-0">CAR INSURANCE</h3>
            <p class="text-center ">“Ensuring public safety and quality service through car insurance.”</p>
        </div>

        <div class="row">
            <div class="col-md-8 text-left">
                <form class="form-inline" action="<?php echo base_url('pages/courses'); ?>" method="get">
                    <select name="insurance_type" id="toins" class="form-control">
                        <option value="" selected>Type of Insurance:</option>
                        <option value="1" <?php if($_REQUEST['insurance_type']==1){ echo 'selected'; } ?> >Comprehensive</option>
                        <option value="0" <?php if(isset($_REQUEST['insurance_type']) && $_REQUEST['insurance_type']==0){ echo 'selected'; } ?> >Third Party</option>
                    </select>
                    
                    <select name="range" id="prange" class="form-control">
                        <option value="">Price Range:</option>
                        <option value="lt10" <?php if($_REQUEST['range']=='lt10'){ echo 'selected'; } ?> >Less than $10</option>
                        <option value="gt10" <?php if($_REQUEST['range']=='gt10'){ echo 'selected'; } ?> >Greater than $10</option>
                    </select>
                    
                    <select name="company" id="inscomp" class="form-control">
                        <option  value="">Insurance Comapanies:</option>
                        <?php if($company):
                            foreach($company as $comp): ?>
                            <option value="<?=$comp['id']; ?>" <?php if($_REQUEST['company']==$comp['id']){ echo 'selected'; } ?> ><?=$comp['name']; ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                    
                    <button type="submit" class="btn btn-primary"> Search </button>
                </form>
            </div>
            <div class="col-md-4 text-right">
                <a href="<?=base_url('pages/courses'); ?>" class="btn btn-primary" >View All</a>
            </div>

            <div class="col-md-12">
                <div class="onlinecourse-box ">
                    <div class="owl-carousel-3 nav-button">
                        <?php if(!empty($insurance)):
                            foreach($insurance as $insu): ?>
                        <div class="item">
                            <div class="course-item">
                                <div class="course-double">
                                    <?php if(0) { ?>
                                    <!-- <div class="corner"></div>
                                    <span class="corner-text">featured</span> -->
                                    <?php } ?>
                                    <a href="javascript:void(0)" data-id="<?=$insu['company_id']?>" data-value="<?=$insu['insur_id']; ?>"
                                    data-broker="<?=$insu['broker_id']; ?>" class="buyCarInsurance-modal course-image">
                                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$insu['course_photo'];?>" alt="">
                                    </a>
                                    <div class="dt-sc-course-details">
                                        <div class="course-price">$<?php echo $insu['price']; ?></div>
                                        <h5><a data-id="<?=$insu['user_id']?>" data-value="<?=$insu['insur_id']; ?>" class="buyCarInsurance-modal" title="Car Isurance"><?=$insu['course_title']?></a></h5>
                                        <div class="clear-line"> </div>
                                        <p> Broker :  <?php echo ucwords($insu['fname'].' '.$insu['name'].' '.$insu['lname']); ?><br>
                                            By : <?php echo $insu['company_name']; ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; 
                        else: ?>
                        <div class="item">
                            <div class="course-item">
                                <div class="course-double">
                                    <?php if(1) { ?>
                                    <div class="corner"></div>
                                    <span class="corner-text">featured</span>
                                    <?php } ?>
                                    <a href="<?php echo site_url();?>" class="course-image">
                                        <img src="<?php echo ASSETS_URL.'images/uploads/IMG_1560995024.png';?>" alt="">
                                    </a>
                                    <div class="dt-sc-course-details">
                                        <div class="course-price">$10.00</div>
                                        <h5><a href="<?php echo site_url();?>" title="Car">Car Compay</a></h5>
                                        <div class="clear-line"> </div>
                                        <p> By :  <?php echo 'Comapny Name' ;?><br>
                                            Country : <?php echo 'India'; ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="course-item">
                                <div class="course-double">
                                    <?php if(1) { ?>
                                    <div class="corner"></div>
                                    <span class="corner-text">featured</span>
                                    <?php } ?>
                                    <a href="<?php echo site_url();?>" class="course-image">
                                        <img src="<?php echo ASSETS_URL.'images/uploads/IMG_1560995024.png';?>" alt="">
                                    </a>
                                    <div class="dt-sc-course-details">
                                        <div class="course-price">$10.00</div>
                                        <h5><a href="<?php echo site_url();?>" title="Car">Car Compay</a></h5>
                                        <div class="clear-line"> </div>
                                        <p> By :  <?php echo 'Comapny Name' ;?><br>
                                            Country : <?php echo 'India'; ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="course-item">
                                <div class="course-double">
                                    <?php if(1) { ?>
                                    <div class="corner"></div>
                                    <span class="corner-text">featured</span>
                                    <?php } ?>
                                    <a href="<?php echo site_url();?>" class="course-image">
                                        <img src="<?php echo ASSETS_URL.'images/uploads/IMG_1560995024.png';?>" alt="">
                                    </a>
                                    <div class="dt-sc-course-details">
                                        <div class="course-price">$10.00</div>
                                        <h5><a href="<?php echo site_url();?>" title="Car">Car Compay</a></h5>
                                        <div class="clear-line"> </div>
                                        <p> By :  <?php echo 'Comapny Name' ;?><br>
                                            Country : <?php echo 'India'; ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="course-item">
                                <div class="course-double">
                                    <?php if(1) { ?>
                                    <div class="corner"></div>
                                    <span class="corner-text">featured</span>
                                    <?php } ?>
                                    <a href="<?php echo site_url();?>" class="course-image">
                                        <img src="<?php echo ASSETS_URL.'images/uploads/IMG_1560995024.png';?>" alt="">
                                    </a>
                                    <div class="dt-sc-course-details">
                                        <div class="course-price">$10.00</div>
                                        <h5><a href="<?php echo site_url();?>" title="Car">Car Compay</a></h5>
                                        <div class="clear-line"> </div>
                                        <p> By :  <?php echo 'Comapny Name' ;?><br>
                                            Country : <?php echo 'India'; ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  endif; ?>
                    </div>
                </div>
            </div>
        </div>


        
    </div>
</div>

<section class="product-slid">
    <div class="container">
        <h1 class="border-title text-center text-uppercase mb-0 pb-0 text-white">INSURANCE COMPANIES</h1>
            <h4 class="mb-2 text-center text-white">Providing coverage in times of need.</h4>
            
            <div class="mb-5 text-center">
                <form class="form-inline" action="<?php echo base_url(''); ?>">
                    <select name="" id="inscompp" class="form-control">
                        <option value="">Insurance Comapanies:</option>
                        <?php foreach($company as $com): ?>
                        <option value="<?=$com['id']?>"><?php echo $com['fname'].' '.$com['name'].' '.$com['lname']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    
                    <button type="button" class="btn btn-primary">
                        Search
                    </button>
                </form>
            </div>
            <div class="owl-carousel-3 nav-button">
                
            <?php if($company !=''):
            foreach($company as $com): 
                if($com['image']==""){ $image = ASSETS_URL.'images/uploads/dummy-profile.jpg'; } else { $image = ASSETS_URL.'images/uploads/'.$com['image']; }?>
                <div class="item">
                    <div class="jet-banner-wrapper">
                        <a href="#">
                            <img src="<?php echo $image; ?>" alt="insurance comapny"
                                class="jet-banner_img">
                            <div class="jet-banner_content ">
                                <h5 class="jet-banner_title text-uppercase"><?php echo $com['fname'].' '.$com['name'].' '.$com['lname']; ?></h5>
                                <div class="jet-banner_text"><?php echo $com['profession']; ?></div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; 
            else: ?>

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
                <?php endif; ?>
            </div>
    </div>
</section>



<section class="pb-3 latest-Professionals">

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="border-title border-title-h text-left">ACCREDITED DRIVING SCHOOLS: </h3>
                <a class="btn btn-warning pull-right text-white" href="">View All</a>
            </div>
            <div class="col-md-12">
                <div class="onlinecourse-box ">
                    <div class="owl-carousel-3 nav-button">
                        <?php if(!empty($brokers)):
                            foreach($brokers as $bro):
                                if($bro['image']==""){ $image = ASSETS_URL.'images/uploads/dummy-profile.jpg'; } else { $image = ASSETS_URL.'images/uploads/'.$bro['image']; } ?>
                                <div class="item">
                                    <div class="course-item">
                                        <div class="course-double">
                                            <?php if(date('Y-m-d') >=$bro['featured_from'] and date('Y-m-d')<=$bro['featured_to']) { ?>
                                                <div class="corner"></div>
                                                <span class="corner-text">featured</span>
                                            <?php } ?>
                                            <a href="javascript:void(0)">
                                                <img src="<?php echo $image;?>" alt="broker-image" width="150" height="200">
                                            </a>
                                            <div class="dt-sc-course-details">
                                                <p><?php echo ucwords($bro['fname'].' '.$bro['name'].' '.$bro['lname']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; 
                        else: echo 'No Data Found!'; endif; ?>
                    </div>
                </div>
            </div>
        </div>
     
    </div>
    </div>
</section>

<section class="pb-3 latest-Professionals">

    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="border-title border-title-h text-left">ACCREDITED DRIVING INSTRUCTOR: </h3>
                <a class="btn btn-warning pull-right text-white" href="">View All</a>
            </div>
            <div class="col-md-12">
                <div class="onlinecourse-box ">
                    <div class="owl-carousel-3 nav-button">
                        <!-- /* this section is dummy */ -->
                        <?php if(!empty($brokers)):
                            foreach($brokers as $bro):
                                if($bro['image']==""){ $image = ASSETS_URL.'images/uploads/dummy-profile.jpg'; } else { $image = ASSETS_URL.'images/uploads/'.$bro['image']; } ?>
                                <div class="item">
                                    <div class="course-item">
                                        <div class="course-double">
                                            <?php if(date('Y-m-d') >=$bro['featured_from'] and date('Y-m-d')<=$bro['featured_to']) { ?>
                                                <div class="corner"></div>
                                                <span class="corner-text">featured</span>
                                            <?php } ?>
                                            <a href="javascript:void(0)">
                                                <img src="<?php echo $image;?>" alt="broker-image" width="150" height="200">
                                            </a>
                                            <div class="dt-sc-course-details">
                                                <p><?php echo ucwords($bro['fname'].' '.$bro['name'].' '.$bro['lname']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endforeach; 
                        else: echo 'No Data Found!'; endif; ?>
                    </div>
                </div>
            </div>
        </div>
     
    </div>
    </div>
</section>

<!-- <div class="newsletter-section">
    <div class="container">
        <div id="newsletter">

            <h3 class="text-white">Renewing your Professional License? </h3>
            <h3 class="text-white">Ready for you Job Performance Appraisal?</h3>
            <h2>GET CE UNITS OR CONTACT HOURS NOW!</h2>

            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/courses');?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/online.png'); ?>" alt="Online Courses">
                            </div>
                            <div class="online-text">
                                <p>ONLINE COURSES</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/training'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/traning.png'); ?>" alt="Training">
                            </div>
                            <div class="online-text">
                                <p>TRANING / SEMINARS</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="online-box">
                        <a href="javascript:void(0)" onclick="checklogin();">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/certificates.png'); ?>" alt="Certificates">
                            </div>
                            <div class="online-text">
                                <p>UPLOAD CERTIFICATES</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="online-box">
                        <a href="<?php echo site_url('pages/Institutionspage'); ?>">
                            <div class="online-img">
                                <img src="<?php echo base_url('assets/images/institute.png'); ?>" alt="Institutes">
                            </div>
                            <div class="online-text">
                                <p>INSTITUTION CE WEBPAGE</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div> -->

<!-- Country Popup -->
<div id="countryPopUp" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center" style="background-image:url(<?php echo base_url('assets/images/dummy-banner.png');?>)">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="countryPopUp-info">
            <h4 class="text-white mb-1">Welcome To</h4> 
            <span class="d-block text-white mb-4">ceonpoint.com</span>
            <h5 class="text-white mb-1">Please choose country to navigate:</h5>
            <?php $ccid = $this->session->userdata('current_country');
            $ccseleted = $this->db->get_where('countries',array('countries_id'=>$ccid,'display'=>'Yes'))->row_array();
            if(empty($ccid) && !empty($ccseleted)):
                $ccimage = strtolower($ccseleted['countries_iso_code']);  
            else:
                $ccimage = strtolower($ipdata->geoplugin_countryCode); 
            // unset($_SESSION['current_country']); 
            endif;
            $cci = ($ccimage!='')?$ccimage:'gloab';
            $ccCountryCode = $this->db
            ->get_where('countries',array('countries_iso_code'=>$ipdata->geoplugin_countryCode))->row_array();
            $ccpopup = $this->db
            ->get_where('countries',array('display'=>'Yes'))->result_array(); ?>
            <div class="country-chooes">
                <div class="form-check">
                    <input class="form-check-input countrylist" type="radio" name="ccpopup" id="ccPopUpRadios1" onchange="filter(this)" value="<?php echo $ccCountryCode['countries_id']; ?>">
                    <label class="form-check-label" for="ccPopUpRadios1"><span><img src="<?php echo ASSETS_URL.'country_icon/'.$cci.'.png'; ?>"></span><?=$ipdata->geoplugin_countryName;?></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input countrylist" type="radio" name="ccpopup" id="ccPopUpRadios2" onchange="filter(this)" value="home">
                    <label class="form-check-label" for="ccPopUpRadios2"><span><img src="<?php echo ASSETS_URL.'country_icon/gloab.png'; ?>"></span>International</label>
                </div>
            </div>

            <div class="row justify-content-md-center" style="z-index: 2; position: relative;">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <select name="country" class="form-control countrylist" onchange="filter(this)">
                    <option value="">Select other country</option>
                    <option value="home" <?php if($ccid == 'home'){ echo "selected";} ?>>International</option>
                    <?php foreach( $ccpopup as $cc){ ?>
                        <option value="<?=$cc['countries_id']?>" <?php if($ccid==$cc['countries_id']){ echo "selected" ;} ?>><?=$cc['countries_name']?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="bg-vactorbox" style="z-index: 1;">
                <img class="vactor-left" src="<?php echo base_url('assets/images/bg-vactor.png');?>" alt="">
                <img class="vactor-right" src="<?php echo base_url('assets/images/bg-vactor-right.png');?>" alt="">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


<style type="text/css">
   .owl-carousel-blog{transform:rotate(90deg);width:270px;margin-top:100px}.item-blog{transform:rotate(-90deg)}.owl-carousel-blog .owl-nav{display:flex;justify-content:space-between;position:absolute;width:100%;top:calc(50% - 33px)}div.owl-carousel-blog .owl-nav .owl-next,div.owl-carousel-blog .owl-nav .owl-prev{font-size:36px;top:unset;bottom:15px}
</style>

<script>
    $(document).ready(function () {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('pages/viewer_counter'); ?>",
            success: function (result) {
            }
        });

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
        });

        // var query = ''
    });



    $('.buyCarInsurance-modal').click(function(){

        if(islogin()==true){
            var role = '<?php echo $this->session->userdata('logged_in')['role']; ?>';
            if(role == 1){
                var compid = $(this).attr('data-id');
                var insid = $(this).attr('data-value');
                var broid = $(this).attr('data-broker');
                $('#companyId').val(compid);
                $('#insurance_id').val(insid);
                $('#broker_id').val(broid);
                $('#buyCarInsurance').modal('show');
            }else{
                alert('Please login with car owner\'s account to buy this!');
            }
        }else{
            var x = confirm('Please login first to fill the form!');

            if(x==true){
                var path = "<?php echo base_url();?>";
                window.location.href=path + "users";
            }
        }
    });

    function islogin(){
        var session = '<?php echo $this->session->userdata('logged_in')['id']; ?>';
        if(session != '')
        return true; 
    }
   
</script>

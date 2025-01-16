<?php  $this->load->view('template/header_home'); ?>

    <div class="banner_slider">
        <div class="item">
            <banner class="professional_banner" style="background-image: url(<?php echo ASSETS_URL; ?>images/transfer.jpg);">
                <div class="container">
                    <div class="banner_platform_content">
                        <div class="regu-bord">
                            <h1 class="font-weight-normal"><span class="h2 text-white">Professional</span> <br> Regulatory Board</h1>
                            <h3 class="font-weight-bold m-0 text-white text-uppercase">Online platform</h3>
                            <p class="text-white">“Professional services 24/7, worldwide.”</p>
                        </div>
                       <div class="pl-4">
                                <a href="<?php echo base_url('RBoard/');?>" target="_blank" class="banner_link_btn">Live Demo</a>
                                <a href="#" class="banner_icon_link video_link"><i class="fa fa-play" aria-hidden="true"></i></a>
                                <a href="<?php echo base_url('users/signup/rboard'); ?>" target="_blank" class="banner_link_btn">Subscribe
                                    Now</a>
                       </div>
                    </div>
                </div>
            </banner>
        </div>
    </div>
    <section class="professional_profile py-4">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-3">
                    <a href="#" data-toggle="modal" data-target="#website">
                        <div class="text-center">
                            <img class="img_div" src="<?php echo ASSETS_URL; ?>images/website.png"
                                alt="">
                            <p class="text-light mt-1 mb-0">WEBSITE</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" data-toggle="modal" data-target="#software">
                        <div class="text-center">
                            <img class="img_div" src="<?php echo ASSETS_URL; ?>images/software.png"
                                alt="">
                            <p class="text-light mt-1 mb-0">SOFTWARE</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" data-toggle="modal" data-target="#prb-database">
                        <div class="text-center">
                            <img class="img_div"
                                src="<?php echo ASSETS_URL; ?>images/databas.png" alt="">
                            <p class="text-light mt-1 mb-0">Database</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" data-toggle="modal" data-target="#prb-personnel">
                        <div class="text-center">
                            <img class="img_div"
                                src="<?php echo ASSETS_URL; ?>images/professional-icon.png" alt="">
                            <p class="text-light mt-1 mb-0">PRB PERSONNEL</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" data-toggle="modal" data-target="#prb-users">
                        <div class="text-center">
                            <img class="img_div"
                                src="<?php echo ASSETS_URL; ?>images/circle-user-prb.png" alt="">
                            <p class="text-light mt-1 mb-0">USERS</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" data-toggle="modal" data-target="#prb-online-services">
                        <div class="text-center">
                            <img class="img_div"
                                src="<?php echo ASSETS_URL; ?>images/circle-online-services.png" alt="">
                            <p class="text-light mt-1 mb-0">ONLINE SERVICES</p>
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
    </section>
    <section class="com_box">
        <div class="container">
            <h1>Components Of prb platform</h1>
        </div>
    </section>



    <section class="website_temp">
        <div class="container">
            <div class="web_temp_heading text-center py-lg-4 py-3">
                <h3>WEBSITE TEMPLATES</h3>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="website_temp_box"style="background-image: url(<?php echo ASSETS_URL; ?>images/temp-1.png);">
                        <a href="<?php echo base_url('RBoard/');?>" target="_blank"
                            class="web_tem_btn bg-primary">Live Demo</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="website_temp_box" style="background-image: url(<?php echo ASSETS_URL; ?>images/temp-2.png);">
                        <!--<a href="https://ceonpoint.com/RBoard/license/rboarddemo/demo2" target="_blank"
                            class="web_tem_btn bg-primary">Live Demo</a>-->
                            <a href="<?php echo base_url('RBoard/template_two');?>" target="_blank"
                            class="web_tem_btn bg-primary">Live Demo</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="website_temp_box" style="background-image: url(<?php echo ASSETS_URL; ?>images/temp-3.png);">
                        <!--<a href="https://ceonpoint.com/RBoard/license/rboarddemo/demo1" target="_blank" class="web_tem_btn bg-primary">Live Demo</a>-->
                        <a href="<?php echo base_url('RBoard/template_three');?>" target="_blank" class="web_tem_btn bg-primary">Live Demo</a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section class="web_num mt-lg-4 mt-3 py-lg-4 py-3">
        <div class="container">
            <div class="row w-50 mx-auto">
                <div class="col-md-3 text-center">
                    <h1 class="font-weight-bold"><?php echo isset($rboards)?count($rboards):0;?></h1>
                    <p>PR BOARDS</p>
                </div>
                <div class="col-md-6 text-center">
                    <h1 class="font-weight-bold"><?php echo isset($professionals)?count($professionals):0;?></h1>
                    <p>PROFESSIONALS</p>
                </div>
                <div class="col-md-3 text-center">
                    <h1 class="font-weight-bold"><?php echo isset($countries)?count($countries):0;?></h1>
                    <p>COUNTRIES</p>
                </div>
            </div>
        </div>
    </section>

    <section class="regulatory_bord_box">
        <div class="container">
            <div class="web_temp_heading text-center py-lg-4 py-3">
                <h3>REGULATORY BOARD</h3>
            </div>
            <div class="regulatory_bord_slider">
                <?php if(!empty($regulatoryboard)){
                    foreach($regulatoryboard as $list){
                ?>
                <div class="item">
                    <div class="regulatory_bord_logo text-center">
                        <a href="<?php echo $list->website; ?>" target="_blank">
                            <img src="<?=base_url('assets/images/uploads/'.$list->image);?>" alt="<?php echo $list->name; ?>">
                            <div class="jet-banner_content ">
                                <div class="jet-banner_text"><?php echo $list->name; ?></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } }else{ ?>
                    <span class="text-danger text-center">Record Not Found</span>
                <?php } ?> 
            </div>
            <div class="subscrib_btn text-center">
                <a href="<?php echo base_url('users/signup/rboard'); ?>" target="_blank">Subscribe Now</a>
            </div>
        </div>
    </section>

    <!-- <section class="video_panel">
            <div class="container">
                <div class="web_temp_heading py-lg-4 py-3">
                    <h3>REGULATORY BOARD VIDEOS</h3>
                </div>
                <div class="row">
                    <div class="col-md-8">
                    <div class="d_video_img" style="background-image: url(<?php echo ASSETS_URL; ?>images/rbors-video.jpg);">
                        <a href="#" onclick="yvideopopup();"> <img src="<?php echo ASSETS_URL; ?>images/youtube-icon.png" alt=""></a>
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d_video_img_detal">
                            <img src="<?php echo ASSETS_URL; ?>images/rbors-video.jpg" alt="">
                        </div>
                        <div class="d_video_img_detal">
                            <img src="<?php echo ASSETS_URL; ?>images/rbors-video.jpg" alt="">
                        </div>
                        <div class="d_video_img_detal">
                            <img src="<?php echo ASSETS_URL; ?>images/rbors-video.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
    </section> -->
    <section class="video_panel pb-4">
            <div class="container">
                <div class="web_temp_heading py-lg-4 py-3">
                    <h3>REGULATORY TUTORIAL VIDEOS</h3>
                </div>
                <div class="regulatory_bord_slider">
                    <?php if(!empty($regtutorials)){
                    foreach($regtutorials as $value){ 
                        if(strpos($value['url'], 'youtube') > 0){
                            $explodeurl = explode('=',$value['url']);
                            $url = $explodeurl[1];
                          }else{
                            $url = 'Not a Youtube Url';
                          }?>
                    <div class="item">
                        <div class="regulatory_bord_logo text-center">
                            <iframe title="youtube" width="100%" height="260" src="https://www.youtube.com/embed/<?=$url;?>" frameborder="0" allowfullscreen ></iframe>
                        </div>
                        <div class="subscrib_btn text-center pt-4">
                            <a href="javascript:void(0)" onclick="playvideo('<?php echo $url;?>')" class="btn btn-primary">Play Now</a>
                        </div>
                    </div>
                    <?php } }else{ ?>
                        <span class="text-danger text-center">Record Not Found</span>
                    <?php } ?> 
                </div>
            </div>
    </section>
    <section class="regulatory_bord_box">
            <div class="container">
                <div class="web_temp_heading py-lg-4 py-3">
                    <h3>Frequently Asked Questions?</h3>
                </div>
                  <div class="row">
                    <div class="col-md-12">
                      <?php if(isset($faq_rb_list) && count($faq_rb_list)>0){ 
                          foreach($faq_rb_list as $key => $value){ ?>
                      <div class="panel-group" id="accordions<?=$key?>">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordions<?=$key?>" href="#collapses<?=$key?>" class="" aria-expanded="true">  
                              Q<?=$key+1?>. <?=$value['question'];?></a></h4>
                          </div>
                            
                          <div id="collapses<?=$key?>" class="panel-collapse collapse" aria-expanded="true" style="">
                              <div class="panel-body"> 
                                <div class="lesson-details">
                                <?=$value['answer']; ?>
                                </div> 
                              </div>
                          </div>
                        </div>
                      </div>

                      <?php } 
                      } else { ?>
                      <div class="pagi-above">Record not found.</div>
                      <?php } ?>
                    </div>
                  </div>
            </div>
    </section>


    <!-- website Modal -->
    <div class="modal fade platform_modal" id="website" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        
            <div class="modal-content">
            
                <div class="modal-header">
                <h3 class="text-center text-white mb-4"><strong>WEBSITE CONTENTS</strong></h3>
                    <!--<img src="images/transfer.jpg" alt="">-->
                    
                </div>
                <div class="modal-body">
                    <!--<h3 class="text-center mb-4">SOFTWARE CAPABILITIES</h3>-->
                    <ul class="platform_list">
                        <li>Photo Slider section</li>
                        <li>Online Services
                        <ul>
                            <li>Professional Registration</li>
                            <li>Professional Licence Renewal</li>
                            <li>Foreign Professional Review for professional Registration</li>
                            <li>Foreign Professional Review for Online Examination</li>
                            <li>Continuing Education Provider (CEP) Accreditation</li>
                            <li>Online Course Accreditation</li>
                            <li>Training Course Accreditation</li>
                            <li>School Accreditation</li>
                            <li>Submission of graduate for Licensure Examination</li>
                            <li>Online Licensure Examination</li>
                            <li>Booking for Online Licensure Examination (Local Graduates)</li>
                            <li>Booking for Online Licensure Examination (Foreign Professional)</li>
                        </ul>
                        </li>
                        <li>Accredited Online Courses</li>
                        <li>Accredited Training Courses</li>
                        <li>Registered Professionals</li>
                        <li>Accredited Continuing Education Providers</li>
                        <li>Accredited Schools</li>
                        <li>Online verification of CEPs. Online Courses, Training Courses, Schools and Digital Certificates</li>
                        <li>Check application status</li>
                        <li>Media Publications</li>
                        <li>About us page</li>
                        <li>Contact us page</li>
                        <li>Downloadable Forms</li>
                    </ul>
                    
                    <div class="subscrib_btn text-center">
                        <a href="<?php echo base_url('users/signup/rboard'); ?>">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- End website Modal -->
<!-- software Modal -->
<div class="modal fade platform_modal" id="software" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        
            <div class="modal-content">
            
                <div class="modal-header">
                <h3 class="text-center text-white mb-4"><strong>SOFTWARE CAPABILITIES</strong></h3>
                    <!--<img src="images/transfer.jpg" alt="">-->
                    
                </div>
                <div class="modal-body">
                    <!--<h3 class="text-center mb-4">SOFTWARE CAPABILITIES</h3>-->
                    <ul class="platform_list">
                        <li>Process selected Online Services at 100% automation</li>
                        <li>Process selected Online Services with PRB personnel verification</li>
                        <li>One page daily status report at Admin Dashboard</li>
                        <li>Create accounts for PRB Online Personal
                            <ul>
                                <li>Reviewers for documents</li>
                                <li>Reviewers for continuing education courses</li>
                                <li>Examiner</li>
                                <li>Proctor</li>
                                <li>Cashier</li>
                                <li>Media</li>
                            </ul>
                        </li>
                        <li>Daily Income Report from different income sources:
                            <ul>
                                <li>Professional Registration</li>
                                <li>Renewal of Professional License</li>
                                <li>School Accreditation</li>
                                <li>Renewal of School Accreditation</li>
                                <li>Submission of Graduates</li>
                                <li>Booking for online Licensure Examination by Graduates</li>
                                <li>Foreign Professional Review for Licensure Examination</li>
                                <li>Booking for Online Licensure Examination by foreign professionals</li>
                                <li>foreign professional review for Registration</li>
                                <li>Continuing Education Provider (CEP) Accreditation</li>
                                <li>Renewal of CEP Accreditation</li>
                                <li>Accreditation of online courses</li>
                                <li>Accreditation of Training Courses</li>
                            </ul>
                        </li>
                        <li>Database of the following
                            <ul>
                                <li>All Online Application</li>
                                <li>Registered Professional</li>
                                <li>Candidates for Professional Registration</li>
                                <li>List of submitted graduates and exam codes</li>
                                <li>List of Foreign professionals and exam codes</li>
                                <li>List of accredited schools</li>
                                <li>List of accredited CEPs</li>
                                <li>List of accredited online courses</li>
                                <li>List of accredited training courses</li>
                                <li>List of digital certificates</li>
                                <li>List of Licensure exam questions</li>
                                <li>List of Presently registered professionals</li>
                                <li>List of Local and foreign examinees</li>
                            </ul>
                        </li>
                        <li>Settings for Price and tax of online services</li>
                        <li>Media Publications</li>
                        <li>Create automated account for professionals, schools and CEPs</li>
                        <li>Upload terms of services to website users (for professionals, schools and CEPs)</li>
                        <li>Send and received notifications from users</li>
                    </ul>
                    <div class="subscrib_btn text-center">
                        <a href="<?php echo base_url('users/signup/rboard'); ?>">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end software Modal -->

<!-- prb-personnel Modal -->
<div class="modal fade platform_modal" id="prb-personnel" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        
            <div class="modal-content">
            
                <div class="modal-header">
                <h3 class="text-center text-white mb-4"><strong>PRB PERSONNEL</strong></h3>
                    <!--<img src="images/transfer.jpg" alt="">-->
                    
                </div>
                <div class="modal-body">
                    <!--<h3 class="text-center mb-4">SOFTWARE CAPABILITIES</h3>-->
                    <ul class="platform_list">
                    <li>Administrator</li>
                    <li>Reviewer for Documents</li>
                    <li>REviewer for CE courses</li>
                    <li>Examiners</li>
                    <li>Proctor for Local Graduates</li>
                    <li>Proctor for Foreign professionals</li>
                    <li>Media</li>
                    <li>Finance</li>
                        <!-- <li>Professional Registration</li>
                        <li>Professional License Renewal</li>
                        <li>Foreign Professional Review</li>
                        <li>Online Licensure Examination</li>
                        <li>University Accreditation</li>
                        <li>Renewal of University Accreditation</li>
                        <li>Submission of Graduates for Licensure Examination</li>
                        <li>CE Provider Accreditation</li>
                        <li>Renewal of CE Provider Accreditation</li>
                        <li>Online Course Accreditation</li>
                        <li>Training Course Accreditation</li> -->
                    </ul>
                    <div class="subscrib_btn text-center">
                        <a href="<?php echo base_url('users/signup/rboard'); ?>">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- end PRB-PERSONNEL Modal -->

<!-- database Modal -->
<div class="modal fade platform_modal" id="prb-database" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        
            <div class="modal-content">
            
                <div class="modal-header">
                <h3 class="text-center text-white mb-4"><strong>DATABASE</strong></h3>
                    <!--<img src="images/transfer.jpg" alt="">-->
                    
                </div>
                <div class="modal-body">
                    <!--<h3 class="text-center mb-4">SOFTWARE CAPABILITIES</h3>-->
                    <ul class="platform_list">
                        <li>Registered Professional Data</li>
                        <li>Income Report</li>
                        <li>Licensure Examination</li>
                        <li>Continuing Education</li>
                        <li>Digital Certificates</li>
                        <li>Notifications</li>
                        <li>Online Applications</li>
                        <li>Settings</li>
                    </ul>
                    <div class="subscrib_btn text-center">
                        <a href="<?php echo base_url('users/signup/rboard'); ?>">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- prb-users Modal -->
<div class="modal fade platform_modal" id="prb-users" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        
            <div class="modal-content">
            
                <div class="modal-header">
                <h3 class="text-center text-white mb-4"><strong>USERS</strong></h3>
                    <!--<img src="images/transfer.jpg" alt="">-->
                    
                </div>
                <div class="modal-body">
                    <!--<h3 class="text-center mb-4">SOFTWARE CAPABILITIES</h3>-->
                    <ol class="platform_list">
                    <li>College Graduates</li>
                    <li>Local and Foreign Professionals</li>
                    <li>CE Providers</li>
                    <li>Universities/colleges</li>
                    </ol>
                    <div class="subscrib_btn text-center">
                        <a href="<?php echo base_url('users/signup/rboard'); ?>">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- prb-online-services Modal -->
<div class="modal fade platform_modal" id="prb-online-services" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        
            <div class="modal-content">
            
                <div class="modal-header">
                <h3 class="text-center text-white mb-4"><strong>ONLINE SERVICES</strong></h3>
                    
                </div>
                <div class="modal-body">
                    <ul class="platform_list">
                    <li>Professional Registration </li>
                    <li>License Renewal </li>
                    <li>Verification of Registration </li>
                    <li>Certificate of Good Standing </li>
                    <li>School Accreditation </li>
                    <li>Renewal of School Accreditation </li>
                    <li>Submission of Graduates </li>
                    <li>Booking for Examination - Graduates </li>
                    <li>Online Licensure Examination - Graduates </li>
                    <li>CE Provider Accreditation </li>
                    <li>Renewal of CE Provider Accreditation </li>
                    <li>Online course Accreditation </li>
                    <li>Training Course Accreditation </li>
                    <li>Foreign Professionals for Registration </li>
                    <li>Foreign Professionals for Examination </li>
                    <li>Booking for Exam – Foreign Professionals </li>
                    <li>Online Licensure Examination – Foreign Professionals</li>
                    </ul>
                    <div class="subscrib_btn text-center">
                        <a href="<?php echo base_url('users/signup/rboard'); ?>">Subscribe Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- end PRB-PERSONNEL Modal -->


<div class="modal fade video_panel" id="yvideopopup" tabindex="-1" role="dialog" aria-labelledby="yvideopopupTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <iframe width="800" height="570" src="https://www.youtube.com/embed/djcKX6shZRg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

        </div>
    </div>
</div>

<div class="modal fade firstvideo_link" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
        <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div> 
        <div class="modal-body">-->
        <iframe width="800" height="570" src="https://www.youtube.com/embed/djcKX6shZRg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <!-- </div> -->
        
        </div>
    </div>
</div>

<div id="playurlvideo" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ceonpoint Video</h4>
            </div>
            <div class="modal-body text-center" id="videotutorial">
            
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('template/footer_home'); ?>
    <script>
        $('.video_link').on('click', function(){
            $('.firstvideo_link').modal('show');
        });
        function yvideopopup(){
            $('#yvideopopup').modal('show');
        }

        $('.regulatory_bord_slider').owlCarousel({
            center: true,
            loop: true,
            margin: 20,
            nav: true,
            dots: false,
            autoplayHoverPause: true,
            autoplay: true,
            autoplaySpeed: 2000,
            dotsSpeed: 2000,
            responsive: {
                320: {
                    items: 1
                },

                360: {
                    items: 2
                },

                580: {
                    items: 2
                },
                768: {
                    items: 5
                },
                1000: {
                    items: 5
                }
            }
        });
      
    $('.banner_slider').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        dots: false,
        autoplayHoverPause: true,
        autoplay: true,
        autoplaySpeed: 2000,
        dotsSpeed: 2000,
        responsive: {
            320: {
                items: 1
            },

            360: {
                items: 1
            },

            580: {
                items: 1
            },
            768: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

    function playvideo(url){
		$('#videotutorial').html('<iframe width="100%" height="315" src="https://www.youtube.com/embed/'+url+'" frameborder="0" allowfullscreen ></iframe>');
		$('#playurlvideo').modal('show');
    }
    </script>

    
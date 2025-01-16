<section class="iceproject-herobaner support-herobanner">
        <div class="ice-project" style="background-image: url(<?php echo ASSETS_URL.'images/support-herobanner.jpg';?>);">
            <div class="container">
                <div class="iiceproject-herobaner-contentbox">
                    <div class="ice-project-content">
                        <h1>Share your expertise</h1>
                        <p class="ice-page-content">EARN PASSIVE INCOME.</p>
                        <p><strong>A CE PROVIDER'S OFFER USING CEP PLATFORM.</strong></p>
                        <div class="elementor-widget-button pl-0">
                                <a href="https://www.ceonpoint.com/users/signup/provider">create free account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        <div class="ice-componentspanel support-focuspanel">
          <div class="row">
            <div class="col-md-12">
                <h2>your focus</h2>
                <p>Devote your time and energy to share your professional expertise thorugh<br>
                        continuing education ( CE ).</p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div class="support-focusbox">
                <div class="support-focusinfo" style="background-image: url(<?php echo ASSETS_URL.'/images/webpages/support-focusimg-1.png';?>);">
                    <h3>CREATE<br>ONLINE COURSE</h3>
                    <p>Publish your accredited online courses at ceonpoint.com and be available to professionals in your country and international.</p>
                </div>   
                <a class="blue-bgbtn" href="https://www.ceonpoint.com/pages/courses/">view online courses</a>   
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <div class="support-focusbox">
              <div class="support-focusinfo" style="background-image: url(<?php echo ASSETS_URL.'/images/webpages/support-focusimg-2.png';?>);">
                    <h3>UPLOAD<br>TRAINING/SEMINARS</h3>
                    <p>Publish your accredited training/seminar(in-person or virtual) at ceonpoint.com and be available to professionals in your country and international.</p>
                </div>  
                <a class="blue-bgbtn" href="https://www.ceonpoint.com/pages/training">view training</a> 
                <a class="blue-bgbtn" href="https://ceonpoint.com/pages/training_management/">TMS</a> 
              </div>
            </div>
          </div>
        </div>
    </div>
</section>

<section class="iceproject-herobaner support-rewardpanel">
        <div class="ice-project" style="background-image: url(<?php echo ASSETS_URL.'images/support-rewardbanner.png';?>);">
            <div class="container">
                <div class="iiceproject-herobaner-contentbox">
                    <div class="ice-project-content">
                        <h1>YOUR REWARD</h1>
                        <h4>PASSIVE INCOME</h4>
                        <p>Once your online course is published at ceonpoint.com
It will be available for sale to all professionals in your country and international.

We will handle the financial aspect of your online courses
and transfer the sales income to your account on a monthly basis.</p>
                            
                           <div class="revenmus-sharingbox">
                            <p>Revenu sharing applies. <br>Click here<br> for the "<a href="<?php echo base_url('pages/terms'); ?>">Terms of Services</a>".</p>
                            <a href="<?php echo base_url('users/signup/provider'); ?>">Create your free account now!</a>
                           </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        <div class="ice-componentspanel our-quadpanel">
                    <h2>5 components of CEP Platform</h2>
                    <h3 class="text-center mt-0">Our Free Support</h3>
                    <p>Ceonpoint provide you with the tools and platform to achieve your goal<br>
                      the share expertise and earn passive income <span>FOR FREE</span>.<br>
                      We only earn when you earn form the sale of your online courses.</p>
            <div class="ice-components-box">
                    <a href="#" data-toggle="modal" data-target="#Cep-ms-software">
                        <img class="ice-register_pro" src="https://www.ceonpoint.com/assets/images/webpages/img5.png">
                        <div class="ice-components-boxinfo">
                        <span>Cep-ms <br> software </span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#cepwebpage">
                        <img class="ice-register_pro" src="https://www.ceonpoint.com/assets/images/webpages/img4.jpg">
                        <div class="ice-components-boxinfo">
                        <span>cep <br> webpage</span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#globalplatform">
                        <img class="ice-register_pro" src="https://www.ceonpoint.com/assets/images/webpages/img2.png">
                        <div class="ice-components-boxinfo">
                        <span>Local & global  <br>  platform</span>
                        </div>
                   </a>
                    <a href="#" data-toggle="modal" data-target="#supportMobile">
                        <img class="ice-register_pro" src="https://www.ceonpoint.com/assets/images/webpages/img1.png">
                        <div class="ice-components-boxinfo">
                        <span>MOBILE <br> APP</span>
                        </div>
                    </a>
                    <a href="#" data-toggle="modal" data-target="#passiveIncome">
                        <img class="ice-register_pro" src="https://www.ceonpoint.com/assets/images/webpages/img7.jpg">
                        <div class="ice-components-boxinfo">
                        <span>Passive <br> Income</span>
                        </div>
                    </a>
            </div>  
        </div>
    </div>
</section>

<section class="latest-Professionals support-latestpanel">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="support-latestbox">
                <h3 class="border-title border-title-h text-left">Latest CE Providers</h3>
                <?php 
                $this->db->where(array('under_insititution'=>0,'parent_insititution'=>0));
                $provider = $this->user->getProviders('');
                // print_r(count($provider));

                if(count($provider)>0){ ?><button class="btn btn-primary pull-right"><a class="text-white" href="<?php echo base_url('pages/ceprovider'); ?>"  >View All CE Providers</a></button><?php } ?>
         
                <div class="training-semi-slider-6 pagi-above">
                <?php if(count($provider)>0){ 
                 foreach ($provider as $key => $value) { 
                    $country = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name'];?>
                    <div class="item">
                        <div class="training-semi">
                            <div class="new-training-box">
                                <!-- <a href="<?php echo site_url('provider/viewmypage/'.$value['id'].'');?>"> -->
                                <a href="<?php echo site_url('share/viewprofile/'.$value['id'].'');?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image provider_images">

                                        <?php if($value['image']==""){
                                                $img = "dummy-profile.jpg";
                                            }else{
                                                $img = $value['image'];
                                            }?>

                                        <img src="<?php echo ASSETS_URL.'images/uploads/'.$img; ?>" alt="<?php echo $img;?>" title="<?php echo $img;?>">
                                    </div>
                                    <div class="training-box-caption">
                                        <h5 class="training-box_title"><?php echo $value['name']; ?></h5>
                                        <div class="training-box_text"><?php echo $country; ?></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } }else{ echo 'No Data Found!'; } ?>  
              </div>


            <h3 class="border-title border-title-h text-left">Latest CE Authors</h3>
            <?php if(count($authors) > 0 ){ ?><button class="btn btn-danger pull-right"><a class="text-white" href="<?php echo base_url('pages/authors'); ?>"  >View All Authors</a></button><?php } ?>
              <div class="training-semi-slider-6 pagi-above">
                <?php if(count($authors) > 0 ){ 
                 foreach ($authors as $key => $value) { 
                 $profileimg = $this->db->get_where('tbl_user',array('id'=>$value['user_id']))->row_array()['image']; 
                 $country = $this->db->get_where('countries',array('countries_id'=>$value['country']))->row_array()['countries_name'];?>
                    <div class="item">
                        <div class="training-semi">
                            <div class="new-training-box">
                                <a href="<?php echo base_url('share/viewprofile/').$value['id'];?>">
                                    <div class="training-box_overlay"></div>
                                    <div class="training-box-image author_images">

                                        <?php if($value['image']==""){
                                            $img = "dummy-profile.jpg";
                                        } else {
                                            $img = $value['image'];
                                        }?>

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
                <?php } }else{ echo 'No Data Found!'; } ?>  
              </div>
            </div>
              
            </div>
        </div>
    </div>
</section>

<a href="#" id="scroll"><span></span></a>    

<!-- The ICE Webpage Modal -->
<div class="modal fade icecomponents-modal" id="Cep-ms-software">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="ice-professionals-icons">
                <h1>SOFTWARE</h1>
                <h2>( CONTINUING EDUCATION PROVIDER MANAGEMENT SOFTWARE ( CEP-MS )</h2>
            </div>           
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            
          <ul>
                <li>Unlimited upload of Online courses and training details</li>
<li>Social Media marketing tool to promote online courses or training</li>
<li>Real time Income report & invoice system</li>
<li>Digital Certificate in all online courses and training</li>
<li>Training Management Software (FREE and PRO Version)</li>
<li>Automated reporting system of certificate, exam result and evaluation & other document to the government regulatory board or institution</li>
<li>NO monthly subscription fee, no hosting fee, no Maintenance fee</li>
<li>Receive monthly Sales Revenue</li>
<li>Approve unlimited authors under CEP</li>
<li>Receive unlimited Online Courses from authors</li>

          </ul>
          <img src="<?php echo ASSETS_URL.'images/webpages/img5.png'; ?>">
        </div>
      </div>
    </div>
  </div>

<!-- The ICE Webpage Modal -->
<div class="modal fade icecomponents-modal" id="cepwebpage">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="ice-professionals-icons">
                <h1>CEP WEBPAGE</h1>
            </div>           
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            
          <ul>
                <li>Title and subtitle with photo background</li>
                <li>Online course listing</li>
                <li>Log-in and register</li>
                <li>Training/Seminars listing</li>
                <li>CE providers section</li>
                <li>Authors/Presenters section</li>
                <li>News/Blog section</li>

          </ul>
          <img src="<?php echo ASSETS_URL.'images/webpages/img4.jpg'; ?>">
        </div>
      </div>
    </div>
  </div>

<!-- The ICE Webpage Modal -->
<div class="modal fade icecomponents-modal" id="supportMobile">
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
                <li>Online course listing</li>
                <li>Training/Seminars listing</li>

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
  <div class="modal fade icecomponents-modal" id="globalplatform">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="ice-professionals-icons">
                <h1>LOCAL AND GLOBAL PLATFORM</h1>
            </div>           
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          <p>Your online courses will be published in your country page and international page of ceonpoint.com <br> To go your country page, click the country filter at the left side of the main menu and select your country.</p>
          <img src="<?php echo ASSETS_URL.'images/webpages/img2.png'; ?>">
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade icecomponents-modal" id="passiveIncome">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="ice-professionals-icons">
                <h1>PASSIVE INCOME</h1>
            </div>           
        </div>
        <!-- Modal body -->
        <div class="modal-body">
        <ul>
                <li>Once your accredited online course is already published at ceonpoint.com, it will be available 24/7 to all professionals to purchase.in your country and international.</li>
        <li>You can share your online courses in different social media platforms (facebook, instagram etc.) for your marketing activities to increase more your sales.</li>
        <li>REvenue sharing between you and the admin applies.</li>
        <li>See more details on the Terms of Service for CE Providers.</li>
        <li>Create a button with text : Terms of Service , this will be linked the terms.</li>
        </ul>
        <div class="text-center">
            <a href="<?php echo base_url('pages/terms'); ?>" class="btn btn-primary mb-4">Terms</a>
        </div>
          <img src="<?php echo ASSETS_URL.'images/webpages/img77.jpg'; ?>">
        </div>
      </div>
    </div>
  </div>



<div id="playurlvideofaq" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Video</h4>
            </div>
            <div class="modal-body text-center" id='videotutorial'>
            </div>
        </div>
    </div>
</div>

<script>
    function play(url){
      $('#urlcevideo').html('<iframe width="100%" height="315" src="'+url+'" frameborder="0" allowfullscreen ></iframe>');
      $('#playurlvideofaq').modal('hide');
      $('#playceonpointvideo').modal('show');   
    }

    function playvideo(url){
    $('#videotutorial').html('<iframe width="100%" height="315" src="https://www.youtube.com/embed/'+url+'" frameborder="0" allowfullscreen ></iframe>');
    $('#playceonpointvideo').modal('show');
    }

   
</script>
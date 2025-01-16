<link rel="stylesheet" href="<?php echo ASSETS_URL.'css/selectize.css'; ?>">
<section class="iceproject-herobaner pb-0 cpaauthor">
    <div class="box-style" style="background-image: url(<?php echo ASSETS_URL.'images/cpda-banner.png';?>);">
        <div class="container">
            <div class="iiceproject-herobaner-contentbox">
                <div class="ice-project-content">
                    <h1 style="font-size: 57px" class="mb-0">Share your Professional Expertise!</h1>
                    <div class="text-center"><a class="youtubelink" href="javascript:void(0);" data-toggle="modal" data-target="#cpdAYoutube"><img src="<?php echo base_url('assets/images/green-play-btn.png'); ?>" alt="Youtube Link"> </a></div> 
                    <p>Become a CPD Author and Empower Professionals!</p>
                    <div class="elementor-widget-button pl-0">
                        <a data-toggle="modal" data-target="#cpdAGetStarted">Get Started</a>
                        <a class="btn btn-success cpafaq" data-toggle="modal" data-target="#cpaauthorfaq">Frequently Asked Questions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tms-featurespanel ocms">
    <div class="container">
        <div class="top-titlebox good_reasons">
            <h1><strong> Good reasons to share</strong></h1>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="tms-featuresbox">
                    <div class="tms-round-box">
                        <img src="<?php echo ASSETS_URL.'images/firstcpda.jpg'; ?>">
                    </div>
                    <h4 class="text-uppercase">Empower Professionals </h4>
                    <p>Sharing your expertise to your colleagues is also empowering them to deliver quality
                        professional service.</p>
                    <!--<a  data-toggle="modal" data-target="#iceMobile">view</a>-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="tms-featuresbox">
                    <div class="tms-round-box">
                        <img src="<?php echo ASSETS_URL.'images/secondcpda.jpg'; ?>">
                    </div>
                    <h4 class="text-uppercase">Nation Building</h4>
                    <p>A stronger country is built under the competence and expertise of professional workforce.
                    </p>
                    <!--<a  data-toggle="modal" data-target="#iceMobile">view</a>-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="tms-featuresbox">
                    <div class="tms-round-box">
                        <img src="<?php echo ASSETS_URL.'images/thirdcpda.jpg'; ?>">
                    </div>
                    <h4 class="text-uppercase">A Rewarding Career</h4>
                    <p>Reach out to professional in your country and overseas and get rewarded from your online
                        courses.</p>
                    <!--<a  data-toggle="modal" data-target="#iceMobile">view</a>-->
                </div>
            </div>



        </div>

    </div>
</section>


<section class="counter">
    <div class="container">

        <div class="row text-center">
            <div class="col-sm-3">
                <h2 class="mt-0" data-max="1200"></h2>
                <p class="mb-0">Professionals</p>
            </div>
            <div class="col-sm-3">
                <h2 class="mt-0" data-max="10"></h2>
                <p class="mb-0">Countries</p>
            </div>
            <div class="col-sm-3">
                <h2 class="mt-0" data-max="00"></h2>
                <p class="mb-0">Online Courses</p>
            </div>
            <div class="col-sm-3">
                <h2 class="mt-0" data-max="12" id="test"></h2>
                <p class="mb-0">Authors</p>
            </div>
        </div>
    </div>
</section>


<section class="steps_to_get">
    <div class="container">
        <div class="top-titlebox good_reasons">
            <h1><strong> Steps to get you started</strong></h1>
        </div>

        <div class="steps_to_get_tab">

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#signup">1</a>Sign up</li>
                <li><a data-toggle="tab" href="#authoraccount">2</a> Author's Account</li>
                <li><a data-toggle="tab" href="#onlinecourse">3</a> Online Courses</li>
                <li class="last"><a data-toggle="tab" href="#published">4</a> Accredited & Published</li>
            </ul>

            <div class="tab-content">
                <div id="signup" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="steps_to_get_cnt">
                                <div class="">
                                    <p>Sign up as Author Under CEonpoint.</p>
                                    <p>Accept the Terms of Aggreement as Author under CEonpoint.</p>
                                    <p>Please click <a href="<?=base_url('users/signup/authors'); ?>">HERE</a> To sign up.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <figure>
                                <img src="<?php echo ASSETS_URL.'images/signupcpda.jpg'; ?>" alt="signup">
                            </figure>
                        </div>
                    </div>
                </div>
                <div id="authoraccount" class="tab-pane fade">
                    <div class="col-md-6">
                        <figure>
                            <img src="<?php echo ASSETS_URL.'images/onlineaccountcpda.jpg'; ?>" alt="author_account">
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <div class="steps_to_get_cnt">
                            <div class="">
                                <p>CEonpoint will Review and approve Your application.</p>
                                <p>Once approved you will receive an email of approval and the link to log in to your account using your username and password.</p>
                                <p>Please click <a href="<?=base_url('users'); ?>">HERE</a> to log in.</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div id="onlinecourse" class="tab-pane fade">
                    <div class="col-md-6">
                        <div class="steps_to_get_cnt">
                            <div class="">
                                <p>You can now create unlimited Online Courses and submit to the CEonpoint.</p>
                                <p>CEonpoint will submit your online course/s for accreditation at Professional Regulation Commission.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <figure>
                            <img src="<?php echo ASSETS_URL.'images/onlinecoursecpda.jpg'; ?>" alt="dsf">
                        </figure>
                    </div>
                </div>
                <div id="published" class="tab-pane fade">
                    <div class="col-md-6">
                        <figure>
                            <img src="<?php echo ASSETS_URL.'images/publishedcpda.jpg'; ?>" alt="dsf">
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <div class="steps_to_get_cnt">
                            <div class="">
                                <p>Once your online course is accredited by the PRC, CEonpoint will Publish your Online Course to become availeble to professionals Locally and internationaly.</p>
                                <p>Please click <a href="<?=base_url('provider/dashboard'); ?>">HERE</a> To view Online Course.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</section>


<!-- <section class="testimonial">
    <div class="container">
        <div class="top-titlebox">
            <h1><strong> Testimonials </strong></h1>

        </div>
        <div class="tmstemplates-slider">
            <div class="item">
                <div class="row">
                    <div class="col-md-6">
                        <figure>
                            <img src="<?php echo ASSETS_URL.'images/uploads/123140625_2706183902952974_894464672389713929_n1636989630.jpg';?>"
                                alt="testimonial">
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <div class="about_clint">
                            <div class="">
                                <h3 class="client_name">Jake Noraj</h3>

                                <p class="profile_cnt">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Reiciendis hic quas minus harum modi blanditiis doloribus ratione quidem
                                    reprehenderit recusandae dignissimos praesentium asperiores ad rerum veniam odit
                                    perspiciatis, labore sed.</p>

                                <p class="cnt-dtl">CEO</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="row">
                    <div class="col-md-6">
                        <figure>
                            <img src="<?php echo ASSETS_URL.'images/uploads/123140625_2706183902952974_894464672389713929_n1636989630.jpg';?>"
                                alt="testimonial2">
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <div class="about_clint">
                            <div class="">
                                <h3 class="client_name">Jake Noraj</h3>

                                <p class="profile_cnt">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Reiciendis hic quas minus harum modi blanditiis doloribus ratione quidem
                                    reprehenderit recusandae dignissimos praesentium asperiores ad rerum veniam odit
                                    perspiciatis, labore sed.</p>

                                <p class="cnt-dtl">CEO</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="row">
                    <div class="col-md-6">
                        <figure>
                            <img src="<?php echo ASSETS_URL.'images/uploads/123140625_2706183902952974_894464672389713929_n1636989630.jpg';?>"
                                alt="testimonial3">
                        </figure>
                    </div>
                    <div class="col-md-6">
                        <div class="about_clint">
                            <div class="">
                                <h3 class="client_name">Jake Noraj</h3>

                                <p class="profile_cnt">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Reiciendis hic quas minus harum modi blanditiis doloribus ratione quidem
                                    reprehenderit recusandae dignissimos praesentium asperiores ad rerum veniam odit
                                    perspiciatis, labore sed.</p>

                                <p class="cnt-dtl">CEO</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section> -->


<section class="you_want" style="background-image: url(<?php echo ASSETS_URL.'images/cpabanner.jpg';?>);background-repeat: no-repeat;">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <figure>
                    <!-- <img src="<?=ASSETS_URL.'images/cpabanner.jpg'; ?>" alt="left-side-you-want"> -->
                </figure>
            </div>
            <div class="col-md-6">
                <div class="you_want_cnt">
                    <h3>We are here to support you!</h3>
                    <p><strong>CEonpoint</strong> team is here to answer your questions and technical needs.</p>
                    <a href="javascript:void(0);" class="btn faq text-uppercase" data-toggle="modal" data-target="#cpaauthorfaq">Frequently Asked Questions</a>
                    <a href="<?php echo site_url('pages/contactus');?>" target="_blank" class="btn register text-uppercase">Contact Us</a>
                </div>
            </div>
            <div class="col-md-3">
                <figure class="text-right">
                    <!-- <img src="<?=ASSETS_URL.'images/rsyouwant.png'; ?>" alt="right-side-you-want"> -->
                </figure>
            </div>
        </div>
    </div>
</section>

<section class="become_today">
    <div class="container">
        <div class="become_today_cnt">
            <h3>Become a CEP Author</h3>
            <p>Be one with the community of authors empowering professionals worldwide.</p>
            <a href="#" data-toggle="modal" data-target="#cpdAGetStarted" class="btn register text-uppercase">Get Started</a>
        </div>
    </div>
</section>

<div class="modal fade" id="cpaauthorfaq" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Frequently Asked Questions</h4>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <?php if(count($faq_author_list)>0){ 
                    foreach($faq_author_list as $key => $value){ ?>
                <div class="panel-group" id="accordion<?=$key?>">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion<?=$key?>" href="#collapse<?=$key?>" class="" aria-expanded="true">  
                        Q<?=$key+1?>. <?=$value['question'];?></a></h4>
                    </div>
                       
                    <div id="collapse<?=$key?>" class="panel-collapse collapse" aria-expanded="true" style="">
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
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>

<div class="modal fade" id="cpdAYoutube" role="dialog">
    <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Video</h4>
            </div>
            <div class="modal-body">
                <p><iframe width="420" height="320" src="https://ceonpoint.com/assets/images/cpda-banner.png" frameborder="0" allowfullscreen></iframe></p>
            </div>
            <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>
      
    </div>
</div>

<div class="modal fade" id="cpdAGetStarted" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h5 class="modal-title text-center" id="exampleModalLabel">Become a CPD Author</h5>
      </div>
      <div class="modal-body">
        <p>Choose the Accredited CPD Provider your are aligned with or you wish to be aligned</p>
        <form action="javascript:void(0);" name="cpdSelect" id="cpdSelectForm">
            <div class="form-group">
                <label class="sr-only" for="country">Country</label>
                <!-- <input type="text" id="select-country" class="demo-default" value="awesome,neat"> -->
                <select id="select-country" name="country">
                    <option>Choose any Country</option>
                    <?php foreach($countries as $value): ?>
                        <option value="<?=$value['countries_id'];?>"><?=$value['countries_name'];?></option>
                    <?php endforeach; ?>
                </select> 
            </div>
            <div class="form-group">
                <label class="sr-only" for="provider">Choose CPD Provider</label>
                <p id="ajaxcpdaProvider"></p>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success">Sign Up Now</button>
            </div>
        </form>
        
        <p><i>Note:</i> If the CPD Providers you are aligned or wish to align is not yet on the lst, you can request them to sign up here for <b>FREE</b> at ceonpoint.com</p>
            <div class="form-group text-center">
                <a class="btn btn-warning" href="<?php echo base_url('users/signup/provider'); ?>">CPD PROVIDER FREE ACCOUNT</a>   
            </div>
        
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
<style>
.modal { text-align: center; padding: 0!important; } 
.modal:before { content: ''; display: inline-block; height: 100%; vertical-align: middle; margin-right: -4px; } 
.modal-dialog { display: inline-block; text-align: left; vertical-align: middle; width:30%; }
</style>
<script src="<?php echo ASSETS_URL.'js/owlcarousel/owl.carousel.js'; ?>"></script>
<script src="<?php echo ASSETS_URL.'js/owlcarousel/owl.js'; ?>"></script>
<script src="<?php echo ASSETS_URL.'js/plugin.js'; ?>"></script>
<script src="<?php echo ASSETS_URL.'js/selectize.js'; ?>"></script>

<script>
    $('#select-country').selectize();
    $('#select-country').on('change', function(){
        var country = $('#select-country').val();
        // alert(country);
        if(country==''){
            $('#ajaxcpdaProvider').html('choose country');
        }else{
            $.ajax({
                type: 'POST',
                url: "<?=base_url('pages/ceplistbycountry'); ?>",
                data: { country : country },
            })
            .done(function( data ) {
                $('#ajaxcpdaProvider').html(data);
            });
        }
    });
    
    $('.tmstemplates-slider').owlCarousel({
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

    function openRegistration(val) {
        $('#register_nows').modal('show');
    }

    function inVisible(element) {
        var WindowTop = $(window).scrollTop();
        var WindowBottom = WindowTop + $(window).height();
        var ElementTop = element.offset().top;
        var ElementBottom = ElementTop + element.height();
        if ((ElementBottom <= WindowBottom) && ElementTop >= WindowTop)
            animate(element);
    }

    function animate(element) {
        //Animating the element if not animated before
        if (!element.hasClass('ms-animated')) {
            var maxval = element.data('max');
            var html = element.html();
            element.addClass("ms-animated");
            $({
                countNum: element.html()
            }).animate({
                countNum: maxval
            }, {
                //duration 5 seconds
                duration: 5000,
                easing: 'linear',
                step: function () {
                    element.html(Math.floor(this.countNum) + html);
                },
                complete: function () {
                    element.html(this.countNum + html);
                }
            });
        }
    }

    //When the document is ready
    $(function () {
        //This is triggered when the
        //user scrolls the page
        $(window).scroll(function () {
            //Checking if each items to animate are 
            //visible in the viewport
            $("h2[data-max]").each(function () {
                inVisible($(this));
            });
        })
    });

    $( "#cpdSelectForm" ).submit(function( event ) {
        var country = $(this).find('#select-country').val();
        var provider = $('#cpdaProvider').val();
        // alert(provider);
        var path = 'category=cpd&&country='+country+'&&provider='+provider;
        window.location.href="<?php echo base_url('users/signup/authors?');?>"+path;
    });

</script>
<?php $this->load->view('template/search'); ?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

<script type="text/javascript">

    $( document ).ready(function() {

        $("input").on("change", function() {

            this.setAttribute(

                "data-date",

                moment(this.value, "YYYY-MM-DD")

                .format( this.getAttribute("data-date-format") )

                )

        }).trigger("change")

    });

</script>





<div class="innerContent">

    <div class="container">

        <div class="row">

            <!-- New thumb slider Html Start 28.12.2018 -->
            <div class="col-md-12">
                 <div class="thumbSliders">
                    <div class="owl-carousel-thumslider">
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog15-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog16-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog17-420x295.jpg" alt=""></div>
                        <div class="item"><img src="<?php echo ASSETS_URL; ?>images/blog17-420x295.jpg" alt=""></div>
                    </div>
                </div>
            </div>
            <!-- New thumb slider Html Start 28.12.2018 -->

            <div class="col-sm-8">
                <h3 class="border-title text-left pull-left"><img src="">Jobs details</h3>
                <a href="#"><div class="training-price"> Apply Online</div></a>
                <div class="clear-line"></div>
                <div class="company-logo">
                    <img src="http://wps-dev.com/dev/mycpd/assets/images/companylogo/com-logo.png">
    			</div>
                <div class="company-descr">
                    <p><strong>Company : </strong>webpanelsolutions.com</p>
                    <p><strong>Country : </strong>India</p>
                    <p><strong>Salary : </strong>$20</p>
                    <p><strong>Interview Date : </strong>February 3, 2019</p>
                    <p><strong>Agency : </strong>Info Agency</p>
                </div>
                <div class="clear-line"></div>
                <ul class="page-nav">
                    <li class="active" ><a href="#">Qualification</a></li>
                    <li ><a href="#">Job Description</a></li>
                </ul>
                <div style="float: right; margin-top: -80px;" class="mob-social">
                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                        <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                        <a class="a2a_button_facebook"></a>
                        <a class="a2a_button_twitter"></a>
                        <a class="a2a_button_google_plus"></a>
                    </div>
                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                </div>
                <p><strong>3 years Experiences</strong></p>
                <ul class="job-desc-detail">
                    <li>Knowledge of designing</li>
                    <li>Knowledge of designing</li>
                    <li>Knowledge of designing</li>
                    <li>Knowledge of designing</li>
                    <li>Knowledge of designing</li>
                    <li>Knowledge of designing</li>
                </ul>
                <h3 class="border-title text-left"><img src="">Location</h3>
                <div class="map-location-job">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.4888947779823!2d77.3137664149222!3d28.58510668243652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce51edadb0685%3A0x9d2181794ec2f403!2sWeb+Panel+Solutions!5e0!3m2!1sen!2sin!4v1554451431238!5m2!1sen!2sin" width="600" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="producr-login">
                    <a href="javascript:void(0);" class="btn upload_certificate">UPLOAD CERTIFICATE</a>
                    <a href="javascript:void(0);" class="btn upload_certificate">UPLOAD CERTIFICATE</a>
                   
                </div>
                <div class="sidebar-box">
                    <h3 class="border-title text-left">Featured Courses</h3>
                    <ul class="product-categories">
                        <li>
                            <div class="thumb">
                                <a href="http://wps-dev.com/dev/mycpd/index.php/pages/course_details/7">
                                    <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/IMG_1534355368.jpg" alt="">
                                </a>
                            </div>
                            <div class="overflow-h">
                                <h5><a href="#">General Business Law1111</a></h5>
                                <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                </div>
                                <strong>$50</strong>
                            </div>
                        </li>
                        <li>
                            <div class="thumb">
                                <a href="http://wps-dev.com/dev/mycpd/index.php/pages/course_details/7">
                                    <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/IMG_1534355368.jpg" alt="">
                                </a>
                            </div>
                            <div class="overflow-h">
                                <h5><a href="#">General Business Law1111</a></h5>
                                <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                </div>
                                <strong>$50</strong>
                            </div>
                        </li>
                        <li>
                            <div class="thumb">
                                <a href="http://wps-dev.com/dev/mycpd/index.php/pages/course_details/7">
                                    <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/IMG_1534355368.jpg" alt="">
                                </a>
                            </div>
                            <div class="overflow-h">
                                <h5><a href="#">General Business Law1111</a></h5>
                                <div class="ratings">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                </div>
                                <strong>$50</strong>
                            </div>
                        </li>
                    </ul>
                    
                </div>
                <div class="sidebar-box">
                    <h3 class="border-title text-left">Advertise</h3>
                    <div class="owl-carousel-1">
                        <div class="item"><img src="http://wps-dev.com/dev/mycpd/assets/images/blog15-420x295.jpg" alt=""></div>
                        <div class="item"><img src="http://wps-dev.com/dev/mycpd/assets/images/blog16-420x295.jpg" alt=""></div>
                        <div class="item"><img src="http://wps-dev.com/dev/mycpd/assets/images/blog17-420x295.jpg" alt=""></div>
                    </div>
                </div>
                
            </div>      



        </div>

    </div>

</div>








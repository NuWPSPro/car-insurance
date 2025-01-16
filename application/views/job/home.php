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

                <div class="panel panel-default btn-strip">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" class="btn btn-primary">Jobs Overseas</a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="btn onlinecourse">Job in the Philippnes</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="selection_boxs">
                            <div class="col-md-3">
                                <div class="selection-box">
                                    <select class="form-control" id="dropDown">
                                        <option value="" selected="">LOCATION</option>
                                        <option value="7">Accountancy </option>s
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="selection-box">
                                    <select class="form-control" id="dropDown">
                                        <option value="" selected="">CATEGORY</option>
                                        <option value="7">Accountancy </option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="selection-box">
                                    <select class="form-control" id="dropDown">
                                        <option value="" selected="">SALERY RANGEt</option>
                                        <option value="7">Accountancy </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="selection-box">
                                    <select class="form-control" id="dropDown">
                                        <option value="" selected="">REGION</option>
                                        <option value="7">Accountancy </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="#" class="btn upload_certificate">SEARCH</a>
                    </div>
                </div>
                <h3 class="border-title text-left h3-margin">Latest Jobs</h3>
                <div id="products" class="row view-group">
                <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="course-item">
                            <div class="course-double">
                                <a href="<?php echo site_url('job/job_details'); ?>" class="course-image">
                                    <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/IMG_1551237644.png"alt="">
                                </a>
                                <div class="dt-sc-course-details">
                                    <h5><a href="<?php echo site_url('job/job_details'); ?>">Course Title</a></h5>

                                    <div class="clear-line"></div>
                                    <p>Bicol Regional Training &amp; Teaching Hospital </p>
                                    <ul class="course-meta">
                                        <li><a href="<?php echo site_url('job/job_details'); ?>">By : Law</a></li>
                                        <li>categories</li>
                                    
                                    </ul>
                                    <div class="course-data"> </div>
                                    <div class="price-btn">
                                        <a href="<?php echo site_url('job/job_details'); ?>">
                                            <input type="button" class="btn btn-primary col-xs-12" name="buynow" value="READ MORE">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     <div class="item col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="course-item">
                            <div class="course-double">
                                <a href="<?php echo site_url('job/job_details'); ?>" class="course-image">
                                    <img src="http://wps-dev.com/dev/mycpd/assets/images/uploads/IMG_1551237644.png"alt="">
                                </a>
                                <div class="dt-sc-course-details">
                                    <h5><a href="<?php echo site_url('job/job_details'); ?>">Course Title</a></h5>

                                    <div class="clear-line"></div>
                                    <p>Bicol Regional Training &amp; Teaching Hospital </p>
                                    <ul class="course-meta">
                                        <li><a href="<?php echo site_url('job/job_details'); ?>">By : Law</a></li>
                                        <li>categories</li>
                                    
                                    </ul>
                                    <div class="course-data"> </div>
                                    <div class="price-btn">
                                        <a href="<?php echo site_url('job/job_details'); ?>">
                                            <input type="button" class="btn btn-primary col-xs-12" name="buynow" value="READ MORE">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
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







